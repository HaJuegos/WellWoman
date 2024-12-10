<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = "pagos";
    public $timestamps = false;
    protected $fillable = ["type"];

    public function factura()
    {
        return $this->belongsTo(Factura::class);
    }
}
