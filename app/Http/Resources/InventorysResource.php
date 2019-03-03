<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class InventorysResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return  [
            "id" => $this->id,
            "producto" => $this->lote->product->name,
            "cantidad_inventario" => $this->quantity_current,
            "lote_code" => $this->lote->code,
            "cantidad_lote" => $this->lote->quantity,
            "precio_lote" => $this->lote->price_unit
        ];
    }
}
