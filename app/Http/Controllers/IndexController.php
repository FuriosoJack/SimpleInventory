<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {

        $products = Product::all();
        return view('index',[
            'products' => $products
        ]);
    }


    public function shop()
    {
        $inventorysInStock = Inventory::inStock()->get();
        return view('shop',[
            'inventorys' => $inventorysInStock
        ]);
    }
}
