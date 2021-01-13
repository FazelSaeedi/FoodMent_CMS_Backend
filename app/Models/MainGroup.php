<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainGroup extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $table = 'maingroups';

    protected $fillable = [
        'name',
        'code'
    ];
}
