<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $table = "facturas";
    public $timestamps = false;
    protected $fillable = [
        'purchase_date',
        'subtotal',
        'total',
        'buyer_id',
        'creator_id',
    ];

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'r_facturas_productos', 'factura_id', 'product_id')->withPivot('quantity', 'price');
    }

    public function creador()
    {
        return $this->belongsTo(Usuario::class, 'creator_id');
    }

    public function comprador()
    {
        return $this->belongsTo(Usuario::class, 'buyer_id');
    }
}
