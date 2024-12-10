<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Foro extends Model
{
    protected $table = "foros";
    public $timestamps = false;
    protected $fillable = ["name", "content", "user_id", "likes", "reportes", "time_creation"];

    public function creador()
    {
        return $this->belongsTo(Usuario::class, 'user_id');
    }

    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'r_foros_usuarios', 'foro_id', 'user_id')->withPivot('has_like');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'forum_id');
    }
}
