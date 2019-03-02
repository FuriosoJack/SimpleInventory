<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailInvoice extends Model
{
    protected $table = "details_invoice";

    protected $fillable = ["id_invoice","id_inventory","quantiry"];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class,"id_invoice","id");
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class,"id_inventory","id");
    }
}
