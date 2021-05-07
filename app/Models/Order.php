<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'userid' ,
        'totalamount' ,
        'totalprice' ,
        'restraunt_id' ,
        'restraunt_code',
        'address_id' ,
        'userdescription'
    ];

    public function OrderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public $timestamps = true;
}
