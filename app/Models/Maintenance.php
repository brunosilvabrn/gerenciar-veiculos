<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'modelo_id',
        'descricao',
        'data',
        'ativo'
    ];

    public function carro()
    {
        return $this->belongsTo(Carro::class, 'modelo_id', 'id');
    }
}
