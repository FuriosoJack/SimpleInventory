<?php

namespace App\Http\Controllers;

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
}
