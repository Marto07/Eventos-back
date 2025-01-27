<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = "tickets";
    protected $fillable = ["fondo_color", "letras_color"];
    
    // Relación 1 a muchos con Evento
    public function eventos()
    {
        return $this->hasMany(Evento::class, 'ticket_id');
    }
}
