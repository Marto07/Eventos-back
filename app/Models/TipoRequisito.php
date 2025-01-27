<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
 
class TipoRequisito extends Model
{
    use HasFactory;

    protected $table = "tipo_requisitos";
    protected $fillable = ["nombre", "estado"];

    //Relacion 1 a muchos con requisitos
    public function requisitos() 
    {
        return $this->hasMany(Requisito::class, 'tipo_requisito_id');
    }
}
