<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//Route::resource('inventory','InventoryController')->only(['index','store','show']);
//Route::resource('products','ProductsController')->only(['index','store','show']);

$api = app('Dingo\Api\Routing\Router');
$api->version(["v1"],function($api) {


    //Productos

    $api->get("/products/",[
        "as" => "products.index",
        "uses" => "\App\Http\Controllers\ProductsController@index"]);

    $api->post("/products/",[
        "as" => "products.store",
        "uses" =>"\App\Http\Controllers\ProductsController@store"]);

    //Lotes
    $api->get("/lotes/","\App\Http\Controllers\LotesController@index");
    $api->post("/lotes/","\App\Http\Controllers\LotesController@store");


    //Inventario
    $api->get("/inventorys/","\App\Http\Controllers\InventoryController@index");
    $api->post("/inventorys/","\App\Http\Controllers\InventoryController@store");


    //Facturas
    $api->post("/invoices/","\App\Http\Controllers\InvoiceController@store");

});
