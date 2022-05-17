@extends('layouts.app')
@section('hero')
    <div class="hero-categorias">
        <form class="container h-100" method="GET" action="{{Route("busqueda.show")}}">
            <div class="row h-100 align-items-center">
                <div class="col-md-4 texto-buscar">
                    <p class="display-4">Encuentra un viaje para hacer en el futuro</p>
                    <input type="search" name="search" class="form-control" placeholder="Buscar Viaje" />
                </div>
            </div>
        </form>
    </div>
@endsection
@section('content')
<div class="container">
    <section>
        <h2 class="titulo-categoria text-uppercase  mb-4">últimos viajes publicados.</h2>
        <div class="row">
            @php
            $array = [];
             foreach ($nuevos as $nuevo ) {
                $array[] = ["img" => "/storage/".$nuevo->picture,"titulo" => Str::title($nuevo->titulo), "description" => Str::words(strip_tags($nuevo->description),22), "link" => route('viaje.show', ['viaje' => $nuevo->id])];
             } ;  
            $viajes = json_encode($array);
            @endphp
            <carousel-item :items="{{$viajes}}"></carousel-item>
        </div>
    </section>
    <section>
            <div class="container">
                <h2 class="titulo-categoria text-uppercase mt-5 mb-4">Viajes más gustados.</h2>
                <div class="row">
                     @if (sizeof($masVotados) > 0 )
                        @foreach ($masVotados as $viaje)
                            @include('ui.card')
                        @endforeach
                     @else
                         <p class="display-6 text-center">Aun no hay viajes que le hayan dado me gusta シ.</p>
                     @endif
                </div>
            </div>
    </section>
    @if (sizeof($masLargos) === 3)
        <section>
            <div class="container">
                <h2 class="titulo-categoria text-uppercase mt-5 mb-4">Viajes más extensos.</h2>
                <div class="row">
                        @foreach ($masLargos as $viaje)
                            @include('ui.card')
                        @endforeach
                </div>
            </div>
        </section>
    @endif
    <section>
        @foreach ($viajesCategoria as $key => $grupo)
            <div class="container">
                <h2 class="titulo-categoria text-uppercase mt-5 mb-4">{{str_replace('-', ' ', $key)}}.</h2>
                <div class="row">
                    @foreach ($grupo as $viajes)
                        @foreach ($viajes as $viaje)
                            @include('ui.card')
                        @endforeach
                    @endforeach
                </div>
            </div>
        @endforeach
    </section>
</div>
@endsection