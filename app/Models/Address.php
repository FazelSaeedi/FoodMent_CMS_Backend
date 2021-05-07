<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'address' ,
        'location',
        'city_id',
        'province_id',
    ];

    public $timestamps = true;

}
