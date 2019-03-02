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

            </div>
            <p>sds</p>
        </div>
    </div>


    <script type="text/javascript">

        $("#modalCreatorProduct").modal('attach events', '#btnAddProduct', 'show');

        $("#btnCreateLote").click(function(){


            var form = $("#formCreateLote");


            var select = $("#product")
            form.validate();




        });


    </script>

@endsection