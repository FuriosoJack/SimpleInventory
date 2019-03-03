<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductsResource;
use App\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Dingo\Api\Routing\Helpers;
class ProductsController extends Controller
{

    use Helpers;

    public function index()
    {
        $products = Product::all();
       return $this->response->array(ProductsResource::collection($products)->response()->getData(true));

    }

    public function store(StoreProductRequest $request)
    {

        $product = Product::create($request->only(['name']));


        throw_if(!$product,\Exception::class,"Fallo la creacion del producto");


        return $this->response->created(null,$product);

    }
}
