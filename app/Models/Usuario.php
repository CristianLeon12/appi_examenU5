<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $fillable = [
        'nombre_completo',
        'correo_electronico',
        'contrasena',
    ];

   
    protected $hidden = [
        'contrasena',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['contrasena'] = bcrypt($password);
    }
    public function informacion()
    {
        return $this->hasOne(Informacion::class);
    }
}
