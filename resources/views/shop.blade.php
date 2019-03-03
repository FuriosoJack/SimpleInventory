@extends('app.layout')
@section('body')


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
                    <div class="ui right floated primary button">
                        Añadir
                        <i class="right chevron icon"></i>
                    </div>
                </div>
            </div>
        </div>

        <tr id="templateTrProduct" style="display: none;">
            <td>

            </td>
            <td>

            </td>
            <td>

            </td>
            <td>

            </td>
        </tr>

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


                <table class="ui very basic celled table">
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

            </div>

        </div>
    </div>


    <script type="text/javascript">

        var productsStock;
        var productsBy;

        function añadirItem(objectJSON)
        {

            //Se busca el template

            var templteItem = $("#templateItemProduct");


            var clonItem = templteItem.clone();

            //Se le quita el estilo de disply
            clonItem.show();

            //Se le aasigna el nombre al producto
            clonItem.find(".header").html(objectJSON.name);

            clonItem.find(".price").html("$" + objectJSON.price);

            clonItem.find(".stock").html("Disponibles: " +objectJSON.stock);

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
                        añadirItem(productsStock[i]);
                    }


                },
                error: function(jqXHR, textStatus, errorThrown){

                }
            });

        });

    </script>



@endsection