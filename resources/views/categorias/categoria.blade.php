@extends('layouts.app')
@section('content')
<div class="container">
    <section>
        <h2 class="titulo-categoria text-uppercase mt-5 mb-4">categoria: {{$categoria->nombre}}.</h2>
        <div class="row">
            @if (sizeof($viajes) > 0 )
                @foreach ($viajes as $viaje)
                    @include('ui.card')
                @endforeach
            @else
            <p class="text-center" style="font-size: 2rem">
                Aun no hay viajes registrados en este categoria シ, se el primero ☺.
            </p>
            @endif
       </div>
       <div class="col-12 d-flex justify-content-center">
            {{$viajes->links()}}
        </div>
    </section>
</div>
@endsection