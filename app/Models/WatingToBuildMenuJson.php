<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WatingToBuildMenuJson extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'restraunt_id',
        'timestamp',
    ];
}
