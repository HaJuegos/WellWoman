<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $table = "comentarios";
    public $timestamps = false;
    protected $fillable = ["content", "date_comment", "likes", "reports", "forum_id", "user_id"];

    public function foro()
    {
        return $this->belongsTo(Foro::class, 'forum_id');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'user_id');
    }

    public function likeUsuarios()
    {
        return $this->belongsToMany(Usuario::class, 'r_comentarios_usuarios', 'comment_id', 'user_id')->withPivot('has_like');
    }

}
