<?php

namespace App\Http\Controllers;

use App\Http\Requests\CancelInvoiceRequest;
use App\Http\Requests\StoreInvoiceRequest;
use App\Inventory;
use App\Invoice;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    use Helpers;


    public function store(StoreInvoiceRequest $request)
    {


        $invoice = Invoice::create(["state" => Invoice::STATE_OK]);


        foreach ($request->get('inventorys') as $inventory){



            //Creacion de los detalles
            $invoice->detailsInvoice()->create([
                'id_inventory' => $inventory['id'],
                'quantity' => $inventory['quantity']
            ]);

            //Se descuenta la cantidad del inventario
            $inventoryModel = Inventory::find($inventory['id']);
            $inventoryModel->update([
                'quantity_current' => (((int)$inventoryModel->quantity_current) - $inventory['quantity'] )
            ]);

            $inventoryModel->save();



        }

        //Se descuenta un elemento
        return $this->response->created(null,$invoice);

    }


    public function cancel(CancelInvoiceRequest $request)
    {
        $invoice = Invoice::findOrFail($request->get('id_invoice'));

        //Se cambia el estado de la factura a cancelada
        $invoice->update([
            'state' => Invoice::STATE_CANCEL
        ]);

        //Se buscan los elementos de la factura


        foreach ($invoice->detailsInvoice as $detailInvoice){

            //Se busca el inventario y se le aumenta el numero del detalle
            //

            $inventory = $detailInvoice->inventory;

            $inventory->update([
                'quantity_current' => ( ((int) $inventory->quantity_current) + ((int)$detailInvoice->quantity))
            ]);

            $inventory->save();

        }


        $invoice->save();

        return $this->response->noContent();


    }


}
