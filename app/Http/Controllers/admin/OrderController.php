<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\OptionsProduct;
use App\Services\QueryService;
use Illuminate\Http\Request;
use App\Models\admin\Orders;
use App\Models\admin\OrderMembers;
use App\Models\admin\OrderProducts;
use Illuminate\Support\Str;
use DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
//        try {
            $filter=[];
            $request->input('pack_status')&& array_push($filter,['pack_status','=',$request->input('pack_status')]);
            $limit = $request->get('limit', 25);
            $ascending = (int) $request->get('ascending', 0);
            $orderBy = $request->get('orderBy', '');
            $search = $request->get('search', '');
            $betweenDate = $request->get('updated_at', []);
            $queryService = new QueryService(new Orders());
            $queryService->select = [];
            $queryService->filter = $filter;
            $queryService->columnSearch = 'order_code';
            $queryService->withRelationship = ['member','Detail','Detail.image','Detail.color','Detail.size'];
            $queryService->search = $search;
            $request->input('phone_number') && $queryService->searchRelationship = $request->input('phone_number');
            $queryService->betweenDate = $betweenDate;
            $queryService->limit = $limit;
            $queryService->ascending = $ascending;
            $queryService->orderBy = $orderBy;
            $query = $queryService->queryTable();
            $query = $query->paginate($limit);
            $product = $query->toArray();
            return $this->jsonTable($product);
//        } catch (\Exception $e) {
//            return $this->jsonError($e);
//        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        DB::beginTransaction();
        try{

            $formData = $request->post();
            $paramMember=[
                'name'=>$formData['Name'],
                'phone_number'=>$formData['PhoneNumber'],
                'email'=>$formData['Email'],
                'location_text'=>$formData['LocationText'],
                'province'=>$formData['Province'],
                'district'=>$formData['District'],
                'commune'=>$formData['Commune'],
                'note'=>$formData['Note'],
            ];
            $orderMember= new OrderMembers();
            $orderMember->fill($paramMember);
            $orderMember->save();


            $paramOrder=[
                'order_code'=> 'HADO-'.Str::random(32),
                'payment_methods'=>$formData['PaymentMethods'],
                'payment_status'=>1,
                'pack_status'=>1,
                'pack_status'=>1,
                'check_status'=>1,
                'id_member'=>$orderMember->id,
            ];

            $order= new Orders();
            $order->fill($paramOrder);
            $order->save();

            $paramOrderDetail=[];

            $dataCart = json_decode($formData['dataCart'],true);
            foreach ($dataCart as $index=> $value){
                $dataPayment = $value['payment'];
                $param =[
                    'product_id'=>$value['id'],
                    'product_name'=>$value['name'],
                    'product_color'=>$dataPayment['id_color'],
                    'product_size'=>$dataPayment['id_size'],
                    'quantity'=>$dataPayment['total'],
                    'price'=>$dataPayment['price'],
                    'price_total'=>$dataPayment['total'] * $dataPayment['price'],
                    'id_order'=>$order->id
                ];
                $checkQuantity = OptionsProduct::where([
                    ['id_product','=',$value['id']],
                    ['id_color','=',$dataPayment['id_color']],
                    ['id_size','=',$dataPayment['id_size']]
                ])->first();

                if($dataPayment['total'] > $checkQuantity['total']){
                    DB::rollback();
                    return response()->json(['success'=>false, 'mess'=>'Sory, sản phẩm đã hết hàng, Vui lòng quay lại sau, hoặc liên hệ trực tiếp shop']);
                }else{
                    OptionsProduct::find($checkQuantity->id)->update([
                        'total'=> ($checkQuantity->total - $dataPayment['total'])
                    ]);;
                }
                array_push($paramOrderDetail,$param);
            }
            $orderProduct= new OrderProducts();
            $orderProduct->insert($paramOrderDetail);
            if($orderMember &&$order && $orderProduct){
                DB::commit();
                return response()->json(['success'=>true, 'mess'=>'Thêm mới thành công!','order_code'=>$order->order_code]);
            }else{
                return response()->json(['success'=>false, 'mess'=>'Thêm mới thất bại!']);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return $this->jsonError($e);
        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try{
            $formData = $request->post();
            $res = Orders::find($id)->update($formData);
            if($res){
                return response()->json(['success'=>true, 'mess'=>'Cập nhật dữ liệu thành công']);
            }else{
                return response()->json(['success'=>false, 'mess'=>'Cập nhật thất bại!']);
            }
        }catch(\Exception $e){
            return response()->json(['success'=>false, 'mess'=>$e]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try{
            $res = Orders::find($id)->delete();
            if($res){
                return response()->json(['success'=>true, 'mess'=>'Xóa dữ liệu thành công!']);
            }else{
                return response()->json(['success'=>false, 'mess'=>'Xóa dữ liệu thất bại!']);
            }
        }catch(\Exception $e){
            return response()->json(['success'=>false, 'mess'=>$e]);
        }
    }
}
