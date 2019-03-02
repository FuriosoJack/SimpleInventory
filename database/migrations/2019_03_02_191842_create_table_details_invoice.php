<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDetailsInvoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details_invoice', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("id_invoice")->unsigned();
            $table->foreign("id_invoice")->references("id")->on("invoices");
            $table->integer("id_inventory")->unsigned();
            $table->foreign("id_inventory")->references("id")->on("inventorys");
            $table->integer("quantiry");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('details_invoice');
    }
}
