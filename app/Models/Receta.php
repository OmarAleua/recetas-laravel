<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'timestamps',
    ];

    //Relacion de 1:n un User puede tener muchas recetas
    /* public function user() {
        return $this->belongsTo(User::class);
    } */ //no lo hizo aun

    //Obtiene la categoria de la receta via fk
    public function categoria() {
        return $this->belongsTo(CategoriaReceta::class);
    }

    //Obtiene la informacion del usuario via fk
    public function autor() {
        return $this->belongsTo(User::class, 'user_id'); //'user_id' es el fk de esta tabla
    }
}
