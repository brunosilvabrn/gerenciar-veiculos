<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'marca_id',
        'name'
    ];

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca_id', 'id');
    }
}
