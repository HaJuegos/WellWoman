<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = "roles";
    public $timestamps = false;
    protected $fillable = ["id", "type"];

    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'r_usuarios_roles', 'rol_id', 'user_id');
    }
}
