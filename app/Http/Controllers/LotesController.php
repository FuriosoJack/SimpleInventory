<?php

namespace App\Http\Controllers;

use App\Lote;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

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


       $dataBaic = $request->only(['quantity','price_unit','id_product']);

        $dataBaic['code'] = str_random("10");
        $lote = Lote::create($dataBaic);

        throw_if(!$lote,\Exception::class,"Error en la creacion del lote");

        return $this->response->created(null,$lote);

    }

}
