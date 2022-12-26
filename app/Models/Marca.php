<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = [
        'id',
        'marca_id',
        'name'
    ];

}
