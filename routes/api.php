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
    $api->get("/lotes/",[
        'as' => 'lotes.index',
        'uses' => "\App\Http\Controllers\LotesController@index"]);

    $api->post("/lotes/",[
        'as' => 'lotes.store',
        'uses' => "\App\Http\Controllers\LotesController@store"]);


    //Inventario
    $api->get("/inventorys/",[
        "as" => "inventory.index",
        "uses" => "\App\Http\Controllers\InventoryController@index"]);

    $api->get("/inventorys/details",[
        "as" => "inventory.indexDetails",
        "uses" => "\App\Http\Controllers\InventoryController@indexDetails"]);

    $api->post("/inventorys/",[
        "as" => "inventory.store",
        "uses" => "\App\Http\Controllers\InventoryController@store"]);

    $api->get("/inventorys/stock",[
        "as" => "inventory.stock",
        "uses" => "\App\Http\Controllers\InventoryController@stock"]);

    //Facturas
    $api->post("/invoices/",[
        "as" => "invoices.store",
        "uses" => "\App\Http\Controllers\InvoiceController@store"]);

    $api->post("/invoices/cancel",[
        "as" => "invoices.cancel",
        "uses" => "\App\Http\Controllers\InvoiceController@cancel"]);

});
