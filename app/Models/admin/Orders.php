<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    use HasFactory;
//    protected $fillable = ['id','name','id_category','detail','description','discount','trade_mark','status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     **/
    public function member(): \Illuminate\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(OrderMembers::class, 'id_member', 'id');
    }

    public function detail(): \Illuminate\Database\Eloquent\Relations\hasMany
    {
        return $this->hasMany(OrderProducts::class, 'id_order', 'id');
    }

}
