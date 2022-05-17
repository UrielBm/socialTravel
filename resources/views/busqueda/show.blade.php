@extends('layouts.app')
@section('content')
<div class="container">
    <section>
        <h2 class="titulo-categoria text-uppercase mt-5 mb-4">Busqueda de: {{$busqueda}}.</h2>
        <div class="row">
            @if (sizeof($viajes) > 0 )
                @foreach ($viajes as $viaje)
                    @include('ui.card')
                @endforeach
            @else
            <p class="display-6 text-center">
                Aun no hay viajes registrados para esta busqueda シ, se el primero ☺.
            </p>
            @endif
       </div>
       <div class="col-12 d-flex justify-content-center">
            {{$viajes->links()}}
        </div>
    </section>
</div>
@endsection