<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carro extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'marca_id',
        'modelo_id',
        'placa',
        'ano'
    ];

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca_id', 'id');
    }

    public function modelo()
    {
        return $this->belongsTo(Modelo::class, 'modelo_id', 'id');
    }
}
