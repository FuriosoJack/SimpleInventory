<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLotesRequest;
use App\Http\Resources\LotesResource;
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

        return $this->response->array(LotesResource::collection($lotes)->response()->getData(true));

    }


    public function store(StoreLotesRequest $request)
    {


       $dataBaic = $request->only(['quantity','price_unit','id_product']);

        $dataBaic['code'] = str_random("10");
        $lote = Lote::create($dataBaic);

        throw_if(!$lote,\Exception::class,"Error en la creacion del lote");

        return $this->response->created(null,$lote);

    }

}
