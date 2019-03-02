<?php

namespace App\Http\Controllers;

use App\Lote;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;

class LotesController extends Controller
{
    use Helpers;


    public function index()
    {

        $lotes = Lote::all();

        return $this->response->array($lotes->toArray());

    }


    public function store(Request $request)
    {

        $lote = Lote::create($request->only(['quantity','price']));


        return $this->response->created($lote);

    }

}
