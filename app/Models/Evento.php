<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $fillable =
    [
        'nome',
        'descricao',
        'data_hora',
        'tipo'
    ];




    public function participantes(){

        return $this->belongsToMany(Participante::class);
    }
}
