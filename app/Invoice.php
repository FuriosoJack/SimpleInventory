<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    const STATE_OK = "OK";
    const STATE_CANCEL = "CANCEL";

    protected $table = "invoices";

    protected $fillable = ["state"];

    public function detailsInvoice()
    {
        return $this->hasMany(DetailInvoice::class,"id_invoice",$this->getKeyName());
    }

}
