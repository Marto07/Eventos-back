<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = "usuarios";
    protected $fillable = ["nombre", "apellido","email", "nombre_usuario", "contrasena"];

    //Relacion de 1 a muchos eventos
    public function eventos() {
        return $this->hasMany(Evento::class, 'usuario_id');
    }
}
