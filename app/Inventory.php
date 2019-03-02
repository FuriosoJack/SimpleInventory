<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = "inventorys";

    protected $fillable = ["quantity_current","id_lote"];


    public function lote()
    {
        return $this->belongsTo(Lote::class,"id_lote","id");
    }

    public function detailsInvoice()
    {
        return $this->hasMany(DetailInvoice::class,"id_inventory",$this->getKeyName());
    }
}
