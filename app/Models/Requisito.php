<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Requisito extends Model
{
    use HasFactory;

    protected $table = "requisitos";
    protected $fillable = ["descripcion", "invitado_fk", "tipo_requisito_fk"];

    //Relacion inversa con invitado
    public function invitado() {
        return $this->belongsTo(Invitado::class, 'invitado_id');
    }

    //Relacion con tipoRequisito
    public function tipoRequisito() {
        return $this->hasMany(TipoRequisito::class, 'tipo_requisito_id');
    }
}
