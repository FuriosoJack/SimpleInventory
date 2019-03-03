@extends('app.layout')
@section('body')

    <div class="ui two column padded grid">
        <div class="column">
            <div class="ui segment">
                <h3 class="ui header">Lista Productos</h3>

                <div class="ui items">


                    @foreach($inventorys as $inventory)
                        <div class="item">
                            <div class="ui small image">
                                <img src="https://semantic-ui.com/images/wireframe/image.png">
                            </div>
                            <div class="content">
                                <div class="header">{{$inventory->lote->product->name}}</div>
                                <div class="meta">
                                    <span class="price">${{$inventory->lote->price_unit}}</span>
                                </div>
                                <div class="description">
                                    <p></p>
                                </div>
                                <div class="extra">
                                    <div class="ui right floated primary button">
                                        Añadir
                                        <i class="right chevron icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>

        </div>
        <div class="column">
            <div class="ui segment">
                <h3 class="ui header">Reision</h3>


            </div>

        </div>
    </div>
@endsection