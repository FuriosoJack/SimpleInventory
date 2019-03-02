<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    protected $fillable = ["name"];


    public function lotes()
    {
        return $this->hasMany(Lote::class,"id_product",$this->getKeyName());
    }
}
