<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    protected $table = "lotes";

    protected $fillable = ["code","quantity","price_unit","id_product"];

    public function product()
    {
        return $this->belongsTo(Product::class,"id_product","id");
    }

    public function inventory()
    {
        return $this->hasOne(Inventory::class,"id_lote",$this->getKeyName());
    }
}
