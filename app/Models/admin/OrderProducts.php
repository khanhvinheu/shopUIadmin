<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model
{
    use HasFactory;
    protected $table='order_details';
    public function image(): \Illuminate\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(ImagesProduct::class,'product_id','id_product');
    }
}
