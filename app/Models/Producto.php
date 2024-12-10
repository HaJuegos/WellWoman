<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = "productos";
    public $timestamps = false;
    protected $fillable = ["name", "description", "price", "oldprice", "stock", "category", "mark", "image_url", "user_id"];

    public function facturas()
    {
        return $this->belongsToMany(Factura::class, 'r_facturas_productos', 'product_id', 'factura_id')->withPivot('quantity', 'price');
    }

    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'r_usuario_productos', 'product_id', 'user_id');
    }

    public function usuariosCarrito()
    {
        return $this->belongsToMany(Usuario::class, 'r_usuario_productos', 'product_id', 'user_id')->withPivot('quantity', 'is_in_cart')->wherePivot('is_in_cart', true);
    }
}
