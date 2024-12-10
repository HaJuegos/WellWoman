<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = "pedidos";
    public $timestamps = false;
    protected $fillable = ["order_date", "total", "delivery_address", "status"];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function factura()
    {
        return $this->hasMany(Factura::class);
    }
}
