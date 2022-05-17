@extends('layouts.app')
<!-- Title de la section -->
@section('titleSection')
<h2 class="text-center display-2 mb-4 title">Los viajes que te gustan</h2>  
@endsection
@section('content')
<!-- section de viajes publicados -->
<section>
    <!--section de tabla de viajes -->
    <div class="col-md-8 mx-auto bg-white p-3">
        @if (sizeof($user->meGusta) > 0)
        <ul class="list-group">
            @foreach ($user->meGusta as $viaje)
                <li class="list-group-item d-flex justify-content-between align-items-baseline">
                    <p class="text-center">Titulo: {{$viaje->titulo}}</p>
                    <a class="btn btn-outline-warning" href="{{route('viaje.show',["viaje" => $viaje->id ])}}">VER VIAJE.</a>
                </li>
            @endforeach
        </ul>
        @else
            <p class="display-6 text-center">
                Aun no tienes ningun viaje que te guste シ.
            </p>
        @endif
    </div>
</section>
@endsection