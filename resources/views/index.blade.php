@extends('app.layout')
@section('body')

    <!-- Modal Creador de productos -->

    <div class="ui modal small" id="modalCreatorProduct">
        <div class="header">Crear Producto</div>
        <div class="content">
            <div class="ui form">
                <div class="field">
                    <label>Nombre Producto</label>
                    <input type="text" name="name_product" placeholder="Name">
                </div>
                <button class="ui button positive" id="btnSendCreateProduct">
                    Crear
                </button>
            </div>

            <script type="text/javascript">

                $(document).ready(function(){

                    $("#btnSendCreateProduct").click(function(){


                        var inputNameText = $("#modalCreatorProduct").find("input").first();

                        var data = JSON.stringify({
                            'name':inputNameText.val()
                        });
                        $.ajax({
                            'url': '{{app('Dingo\Api\Routing\UrlGenerator')->version('v1')->route('products.store')}}',
                            headers: {
                                'Accept':'application/prs.simpleinventory.v1+json',
                                'Content-Type':'application/json'
                            },
                            dataType: 'json',
                            type: 'POST',
                            data: data ,
                            success: function(data,textStatus, jqXHR){ //http://api.jquery.com/jquery.ajax/
                                location.reload();
                            },
                            error: function(jqXHR, textStatus, errorThrown){

                            }
                        });

                    });
                });
            </script>
        </div>
    </div>


    <!-- Modal confirmacion de inventario -->

    <div class="ui basic modal" id="modalCreatorAddInventory">
        <div class="header">Crear un inventario de este lote?</div>
        <div class="actions">
            <div class="ui approve positive button">Approve</div>
            <div class="ui cancel negative button">Cancel</div>
        </div>
    </div>

    <div class="ui divider"></div>
    <div class="ui two column padded grid">
        <div class="column">
            <div class="ui segment">
                <h3 class="ui header">Lotes</h3>

                <div class="ui form" id="formCreateLote" method="post">
                    <div class="field">
                        <label>Productos
                            <a class="ui" href="#" id="btnAddProduct"><i class="icon circular plus"></i></a> </label>

                        <select class="ui dropdown fluid" id="selectProducts" name="product" required>
                            <option value=""></option>
                            @foreach($products as $product)
                                <option value="{{$product->id}}">{{$product->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="field">
                        <label>Cantidad</label>
                        <div class="ui action input">
                        <input type="number" name="quantity" min="1" required>
                        </div>
                    </div>
                    <div class="field">
                        <label>Precio</label>
                        <div class="ui action input">
                        <input type="number" name="price" min="50" required>
                        </div>
                    </div>
                    <button class="ui button" type="submit" id="btnCreateLote">Crear Lote</button>
                </div>
            </div>

        </div>
        <div class="column">
            <div class="ui segment">

                <table class="ui celled table" id="tableInvetory">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Cantidad En inventario</th>
                        <th>Code Lote</th>
                        <th>Cantidad Lote</th>
                        <th>Precio Lote</th>
                    </tr>
                    </thead>
                </table>
            </div>

        </div>
    </div>


    <script type="text/javascript">

        $("#modalCreatorProduct").modal('attach events', '#btnAddProduct', 'show');

        $("#btnCreateLote").click(function(){


            var form = $("#formCreateLote");


            var select = form.find("select").first();



            var inputQuantity = form.find("input[name='quantity']").first();

            var inputPrice = form.find("input[name='price']").first();


            var data = {
                quantity: inputQuantity.val(),
                price_unit: inputPrice.val(),
                id_product: select.val()
            };

            $.ajax({
                'url': '{{app('Dingo\Api\Routing\UrlGenerator')->version('v1')->route('lotes.store')}}',
                headers: {
                    'Accept':'application/prs.simpleinventory.v1+json',
                    'Content-Type':'application/json'
                },
                dataType: 'json',
                type: 'POST',
                data: JSON.stringify(data) ,
                success: function(data,textStatus, jqXHR){ //http://api.jquery.com/jquery.ajax/
                    //Se pregunta si se quiere añadir al lote de una vez

                    var datasend = {
                        id_lote: data.lote.id
                    };
                    $('#modalCreatorAddInventory')
                        .modal({
                            closable  : false,
                            onDeny    : function(){
                                location.reload();
                            },
                            onApprove : function() {

                            $.ajax({
                                    'url': '{{app('Dingo\Api\Routing\UrlGenerator')->version('v1')->route('inventory.store')}}',
                                    headers: {
                                        'Accept':'application/prs.simpleinventory.v1+json',
                                        'Content-Type':'application/json'
                                    },
                                    dataType: 'json',
                                    type: 'POST',
                                    data: JSON.stringify(datasend) ,
                                    success: function(data,textStatus, jqXHR){ //http://api.jquery.com/jquery.ajax/
                                        //Se pregunta si se quiere añadir al lote de una vez
                                        location.reload();
                                    },
                                    error: function(jqXHR, textStatus, errorThrown){

                                    }
                                });


                            }
                        })
                        .modal('show');

                },
                error: function(jqXHR, textStatus, errorThrown){

                }
            });




        });


        $("#tableInvetory").DataTable( {
            ajax: {
                url: "{{app('Dingo\\Api\\Routing\\UrlGenerator')->version('v1')->route('inventory.indexDetails')}}",
                dataSrc: 'data',
                headers: {
                    'Accept':'application/prs.simpleinventory.v1+json',
                    'Content-Type':'application/json'
                },
            },
            columns: [
                {
                    'data': "id"
                },
                {
                    "data": "cantidad_inventario"
                },
                {
                    "data": "lote_code"
                },
                {
                    "data" : "cantidad_lote"
                },
                {
                    "data": "precio_lote"
                }


            ]
        });


    </script>

@endsection