<?php

namespace App\Http\Controllers;

use App\Http\Resources\InventorysResource;
use App\Inventory;
use App\Lote;
use App\Product;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class InventoryController extends Controller
{
    use Helpers;
    public function index()
    {

        $inventorys = Inventory::all();

        return $this->response->array($inventorys->toArray());


    }

    public function indexDetails()
    {

        $invetorys = Inventory::all();


       return $this->response->array(InventorysResource::collection($invetorys)->response()->getData(true));


    }


    public function store(Request $request)
    {

        $lote = Lote::find($request->get('id_lote'));


        $inventory = $lote->inventory()->create([
            'quantity_current' => $lote->quantity
        ]);


        throw_if(!$inventory,\Exception::class,"Fallo la creacion del inventario");

        return $this->response->created(null,$inventory);
    }


}
