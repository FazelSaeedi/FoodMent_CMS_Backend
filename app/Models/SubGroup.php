<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubGroup extends Model
{

    use HasFactory;

    public $timestamps = false;

    public $table = 'subgroups';

    protected $fillable = [
        'name',
        'code'
    ];
}
