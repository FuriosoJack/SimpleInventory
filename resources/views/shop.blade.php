@extends('app.layout')
@section('body')
    <div class="ui dimmer" >
        <div class="content">
            <h2 class="ui inverted icon header">
                <div class="ui text loader"></div>
            </h2>
        </div>
    </div>


    <!-- MOdal confirmacion de cancelar factura -->
    <div class="ui basic modal" id="modalConfirmCancelInvoice">
        <div class="header">Pago Exitoso!!</div>
        <div class="content">
            <table class="ui celled striped table" id="tabledetailInvoice">
                <thead>
                <tr><th colspan="3">
                       Detalle de Factura
                    </th>
                </tr>
                <tr>
                    <th colspan="2">
                        Estado
                    </th>
                    <th>

                    </th>
                </tr>

                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <div class="actions">
            <div class="ui cancel negative button">Aprobar</div>
            <div class="ui approve positive button">Aprobar</div>
        </div>
    </div>

        <div class="item" id="templateItemProduct" style="display: none;">
            <div class="ui small image">
                <img src="https://semantic-ui.com/images/wireframe/image.png">
            </div>
            <div class="content">
                <div class="header"></div>
                <div class="meta">
                    <span class="price"></span>
                </div>
                <div class="description">
                    <p></p>
                </div>
                <div class="extra">
                    <div class="ui label stock" ></div>
                    <div class="ui right floated primary button addToCheck">
                        Añadir
                        <i class="right chevron icon"></i>
                    </div>
                </div>
            </div>
        </div>


        <div class="ui action input" id="templateInputNumber" style="display: none;">
            <input type='number' min='1' />
        </div>

    <div class="ui two column padded grid">
        <div class="column">
            <div class="ui segment">
                <h3 class="ui header">Lista Productos</h3>

                <div class="ui items" id="itemsStock">


                </div>

            </div>

        </div>
        <div class="column">
            <div class="ui segment">
                <h3 class="ui header">Revision</h3>


                <table class="ui very basic celled table" id="tableCheckout">
                    <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio Unidad</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                    </tr></thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <tr class="active">
                            <td colspan="3">
                                <p class="ui right floated"><b>Total: </b></p>
                            </td>
                            <td>

                            </td>
                        </tr>
                    </tfoot>
                </table>

                <button id="btnpay" class="ui secondary button">
                    Pagar
                </button>
            </div>

        </div>
    </div>




    <script type="text/javascript">

        var productsStock;
        var productsBuy = [];

        function addItem(position)
        {

            var objectJSON = productsStock[position];
            //Se busca el template

            var templteItem = $("#templateItemProduct");


            var clonItem = templteItem.clone();



            clonItem.attr("id","item-" + position);
            //Se le quita el estilo de disply
            clonItem.show();

            //Se le aasigna el nombre al producto
            clonItem.find(".header").html(objectJSON.name);

            clonItem.find(".price").html("$" + objectJSON.price);

            clonItem.find(".stock").html("Disponibles: " +objectJSON.stock);

            //Se le añade evento


            var tempalteTR = "<tr class='trproduct' id='trproduct-"+objectJSON.id+"' ><td>" + objectJSON.name +"</td><td>" + objectJSON.price + "</td><td><div class='ui input'><input type='number' min='1' max='" +objectJSON.stock +"' value='1'/></div></td><td>" +objectJSON.price +"</td></tr>";
            console.log(tempalteTR);
            clonItem.find(".addToCheck").click(function(){


                productsBuy.push(objectJSON);




                //Se añade elemento a la tabla
                $("#tableCheckout").find("tbody").append(tempalteTR);


                $(".trproduct input").change(function(){

                    var yo = $(this);
                    var precio = (objectJSON.price * yo.val());

                    yo.parents("tr").first().find("td").last().html(precio);



                });

                //Se elimina itemm de la lista
                $("#item-"+position).remove();


            });



            $("#itemsStock").append(clonItem);



        }

        $(document).ready(function(){



            $.ajax({
                'url': '{{app('Dingo\Api\Routing\UrlGenerator')->version('v1')->route('inventory.stock')}}',
                headers: {
                    'Accept':'application/prs.simpleinventory.v1+json',
                    'Content-Type':'application/json'
                },
                dataType: 'json',
                type: 'GET',
                success: function(data,textStatus, jqXHR){ //http://api.jquery.com/jquery.ajax/

                    productsStock = data.data;


                    //Llenado de la lista

                    for(i = 0; i < productsStock.length; i++){
                        addItem(i);
                    }


                },
                error: function(jqXHR, textStatus, errorThrown){

                }
            });


            $("#btnpay").click(function(){


                $('.ui.container').dimmer('show');
                //Se actualizan todos los produtos segun la tabla


                for(i = 0; i < productsBuy.length; i ++){
                    console.log(productsBuy);
                    var trProduct = $("#trproduct-" + productsBuy[i].id);
                    productsBuy[i].quantity = trProduct.find("input").val();

                }

                var datasend  = {
                    "inventorys" : productsBuy
                }

                $.ajax({
                    'url': '{{app('Dingo\Api\Routing\UrlGenerator')->version('v1')->route('invoices.store')}}',
                    headers: {
                        'Accept':'application/prs.simpleinventory.v1+json',
                        'Content-Type':'application/json'
                    },
                    dataType: 'json',
                    data: JSON.stringify(datasend),
                    type: 'POST',
                    success: function(data,textStatus, jqXHR){ //http://api.jquery.com/jquery.ajax/

                        $('.ui.container').dimmer('hide');
                        $('#modalConfirmCancelInvoice')
                            .modal({
                                closable  : false,
                                onDeny    : function(){
                                    location.reload();
                                },
                                onApprove : function() {



                                }
                            })
                            .modal('show');

                    },
                    error: function(jqXHR, textStatus, errorThrown){

                    }
                });



            });


        });

    </script>



@endsection