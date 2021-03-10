<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuJsonInfo extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'restraunt_id',
        'create_timestamp',
    ];

    protected $table = 'menu_json_info';
}
