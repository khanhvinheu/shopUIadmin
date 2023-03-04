<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Products;
use App\Models\admin\OptionsProduct;
use App\Models\admin\ImagesProduct;
use DB;
use Illuminate\Http\JsonResponse;
use App\Services\QueryService;
use File;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {

            $limit = $request->get('limit', 25);
            $ascending = (int) $request->get('ascending', 0);
            $orderBy = $request->get('orderBy', '');
            $search = $request->get('search', '');
            $betweenDate = $request->get('updated_at', []);
            $queryService = new QueryService(new Products());
            $queryService->select = [];
            $queryService->columnSearch = 'name';
            $queryService->withRelationship = ['category','OptionsProduct','imagesProduct','OptionsProduct.color','OptionsProduct.size'];
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
            dd($e);
            return $this->jsonError($e);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $post = $request->post();
            $file = $request->file();
            $listPath=[];
            $product = new Products();
            $product->fill($post);
            $product->save();
            // image
            foreach($file as $index=>$value){
                 $dataImg = [
                    'id_product'=>$product->id,
                    'path'=>$this->upload($value),
                 ];
                 array_push($listPath, $dataImg);
            }
            $imageProduct= new ImagesProduct();
            $imageProduct->insert($listPath);
            //option
            $productOption= json_decode($post['option'],true);
            $dataOption=[];
            foreach ($productOption as $index =>$valueOption){
                $valueOption['id_product']=$product->id;
                $valueOption['id_color']=$valueOption['id_color'][0];
                $valueOption['id_size']=$valueOption['id_size'][0];
                unset($valueOption['key']);
                array_push($dataOption, $valueOption);
            }

            $optionProduct = new OptionsProduct();
            $optionProduct->insert($dataOption);

            if($product &&$imageProduct && $optionProduct){
                DB::commit();
                return response()->json(['success'=>true, 'mess'=>'Thêm mới thành công!']);
            }else{
                return response()->json(['success'=>false, 'mess'=>'Thêm mới thất bại!']);
            }

        }catch(\Exception $e){
            DB::rollback();
            return response()->json(['success'=>false, 'mess'=>$e]);
        }
    }
    public function upload($file){
        $fileName ='product_'.explode('.',$file->getClientOriginalName())[0].time().'.'.$file->extension();
        if($file->move(public_path('uploads/product'), $fileName)){
            return '/uploads/product/'.$fileName;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): JsonResponse
    {
        try {
            $product = Products::where('id',$id)->with('OptionsProduct')
                ->with('imagesProduct')
                ->with('OptionsProduct.color')
                ->with('OptionsProduct.size')
                ->with('category')
                ->first();
            return $this->jsonData($product);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
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
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $post = $request->post();
            $file = $request->file();
            $listPath = [];
            $product = new Products();
            $product->find($id)->update($post);
            // image
            foreach ($file as $index => $value) {
                $dataImg = [
                    'id_product' => $id,
                    'path' => $this->upload($value),
                ];
                array_push($listPath, $dataImg);
            }
            $imageProduct = new ImagesProduct();
            $imageProduct->insert($listPath);
            if ($post['delete_image']) {
                $delete_image = json_decode($post['delete_image'], true);
                $this->deleteListImage($delete_image);
            }
            //product_detail
            if ($post['delete_id']) {
                $delete_options = json_decode($post['delete_id'], true);
                foreach ($delete_options as $index => $option) {
                    $productOptions = new OptionsProduct();
                    $productOptions->find($option)->delete();
                }
            }
            //option
            $productOption = json_decode($post['option'], true);
            $optionProduct = new OptionsProduct();
            $dataOption = [];
            foreach ($productOption as $index => $valueOption) {
                $valueOption['id_product'] = $id;
                $valueOption['id_color'] = $valueOption['id_color'][0];
                $valueOption['id_size'] = $valueOption['id_size'][0];
                unset($valueOption['key']);
                if (@$valueOption['id']) {
                    $optionProduct->find($valueOption['id'])->update($valueOption);
                } else {
                    array_push($dataOption, $valueOption);
                }
            }
            $dataOption && $optionProduct->insert($dataOption);
            return response()->json(['success'=>true, 'mess'=>'Cập nhật thành công!']);
        }catch(\Exception $e){
            return response()->json(['success'=>false, 'mess'=>$e]);
        }

    }

    public function deleteListImage($id_delete){
        foreach ($id_delete as $index=>$value){
            $imageProduct = new ImagesProduct();
            $imageProduct->find($value);
            $data = $imageProduct->find($value)->toArray();
            if(file_exists((public_path($data['path'])))){
                File::delete(public_path($data['path']));
            }
            $imageProduct->find($value)->delete();
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
            $listImg =ImagesProduct::where('id_product', $id)->get()->toArray();
            $res = Products::find($id)->delete();
            if($res){
                if(count($listImg)>0){
                    foreach ($listImg as $index => $value){
                        if(file_exists((public_path($value['path'])))){
                            File::delete(public_path($value['path']));
                        }
                    }
                }
                return response()->json(['success'=>true, 'mess'=>'Xóa dữ liệu thành công!']);
            }else{
                return response()->json(['success'=>false, 'mess'=>'Xóa dữ liệu thất bại!']);
            }
        }catch(\Exception $e){
            return response()->json(['success'=>false, 'mess'=>$e]);
        }
    }
}
