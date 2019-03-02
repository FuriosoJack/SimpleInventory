<?php

namespace App\Http\Controllers;

use App\Inventory;
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

    public function store(Request $request)
    {

        $inventory = Inventory::create($request->only(['quantity_current','id_lote']));

        throw_if(!$inventory,\Exception::class,"Fallo la creacion del inventario");

        return $this->response->created(null,$inventory);
    }


}
