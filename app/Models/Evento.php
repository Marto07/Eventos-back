<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $table = "eventos";
    protected $fillable = ["nombre", "descripcion", "lugar", "fecha_y_hora", "estado_evento", "privacidad_evento", "usuario_fk", "ticket_fk"];

    //Relacion inversa con persona
    public function usuario() {
        return $this->belongsTo(Usuario::class, 'usuario_fk');
    }

    //Relacion 1  a muchos con invitados
    public function invitados() {
        return $this->hasMany(Invitado::class, 'evento_fk');
    }

    // Relación inversa con Ticket
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_fk');
    }
}
