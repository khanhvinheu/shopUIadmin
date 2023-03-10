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
        try {

            $limit = $request->get('limit', 25);
            $ascending = (int) $request->get('ascending', 0);
            $orderBy = $request->get('orderBy', '');
            $search = $request->get('search', '');
            $betweenDate = $request->get('updated_at', []);
            $queryService = new QueryService(new Orders());
            $queryService->select = [];
            $queryService->columnSearch = 'order_code';
            $queryService->withRelationship = ['member','Detail','Detail.image'];
            $queryService->search = $search;
            $queryService->betweenDate = $betweenDate;
            $queryService->limit = $limit;
            $queryService->ascending = $ascending;
            $queryService->orderBy = $orderBy;
            $query = $queryService->queryTable();
            $query = $query->paginate($limit);
            $product = $query->toArray();
            return $this->jsonTable($product);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
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
                    return response()->json(['success'=>false, 'mess'=>'Sory, s???n ph???m ???? h???t h??ng, Vui l??ng quay l???i sau, ho???c li??n h??? tr???c ti???p shop']);
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
                return response()->json(['success'=>true, 'mess'=>'Th??m m???i th??nh c??ng!','order_code'=>$order->order_code]);
            }else{
                return response()->json(['success'=>false, 'mess'=>'Th??m m???i th???t b???i!']);
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
    }
}
