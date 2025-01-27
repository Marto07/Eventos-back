<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitado extends Model
{
    use HasFactory;

    protected $table = "invitados";
    protected $fillable = ["nombre", "apellido", "email", "asistencia_estado", "evento_fk"];

    //Relacion inversa con evento
    public function evento() {
        return $this->belongsTo(Evento::class, 'evento_id');
    }

    public function requisitos() {
        return $this->hasMany(Requisito::class, 'invitado_id');
    }
}
