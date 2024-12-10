<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;

class Usuario extends Model implements AuthenticatableContract
{
    use Authenticatable;
    protected $table = "usuarios";
    public $timestamps = false;
    protected $fillable = ["name", "email", "password", "profile_url", "last_session", "creation_date", "remember_token"];

    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'r_usuarios_roles', 'user_id', 'rol_id');
    }

    public function pedidos()
    {
        return $this->belongsToMany(Producto::class, 'r_usuario_productos', 'user_id', 'product_id');
    }

    public function cicloMenstrual()
    {
        return $this->hasOne(CicloMenstrual::class, 'user_id');
    }

    public function forosCreados()
    {
        return $this->hasMany(Foro::class, 'user_id');
    }

    public function foros()
    {
        return $this->belongsToMany(Foro::class, 'r_foros_usuarios', 'user_id', 'foro_id')->withPivot('has_like');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'user_id');
    }

    public function likeComentarios()
    {
        return $this->belongsToMany(Comentario::class, 'r_comentarios_usuarios', 'user_id', 'comment_id')->withPivot('has_like');
    }

    public function carrito()
    {
        return $this->belongsToMany(Producto::class, 'r_usuario_productos', 'user_id', 'product_id')->withPivot('quantity', 'is_in_cart')->wherePivot('is_in_cart', true);
    }
	
	public function facturas()
	{
		return $this->hasMany(Factura::class, 'buyer_id');
	}
}
