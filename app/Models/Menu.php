<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public $table = 'menu';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'product_id' ,
        'restraunt_id' ,
        'price' ,
        'discount' ,
        'makeup' ,
    ];

    use HasFactory;
}
