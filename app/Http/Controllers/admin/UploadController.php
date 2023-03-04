<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;

class UploadController extends Controller
{
    public function upload(Request $request){
        $file= $request->file('file');
        $fileName ='product_'.explode('.',$file->getClientOriginalName())[0].time().'.'.$file->extension();
        if($file->move(public_path('uploads/product'), $fileName)){
            return '/uploads/product/'.$fileName;
        }
    }
    public function removeFile(Request $request){
        $path = $request->post('path');
        if(File::delete(public_path($path))){
            return response()->json(['success'=>true,'mess'=>'Xóa file thành công']);
        }else{
            return response()->json(['success'=>true,'mess'=>'Xóa file thất bại']);
        }
    }
}
