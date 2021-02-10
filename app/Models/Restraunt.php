<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restraunt extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'admin',
        'code',
        'address',
        'phone',
        'update_at'
    ];

}
