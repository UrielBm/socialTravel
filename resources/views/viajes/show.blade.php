@extends('layouts.app')

@section('content')
    <article class="container p-md-5 shadow">
        @php
        $fecha = $viaje->created_at;
        $update = $viaje->updated_at;
        @endphp
        <h1 class="display-md-4 text-center text-warning Capital mb-4 title">{{$viaje->titulo}}</h1>
        <share-button></share-button>
        <div class="wrapperImg mb-4">
            <img src="/storage/{{$viaje->picture}}"  class="w-100 rounded-2" alt="trip picture"/>
        </div>
        <div class="travel-meta">
            <p class="subtitle">Autor: <a class="text" href="{{route('perfil.show',["perfil" => $viaje->autor->id])}}">{{$viaje->autor->name}}</a></p>
            <p class="subtitle">Categoria: <a class="text" href="{{route("categorias.show", ["categoria" => $viaje->categoria->id])}}">{{$viaje->categoria->nombre}}</a><svg class="iconViaje" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg></p>
            <p class="subtitle">Costo promedio:<span class="text">$ {{$viaje->cost}} pesos</span></p>
            <p class="subtitle">Días del viaje:<span class="text">{{$viaje->days}} días de viaje</span></p>
            <p class="subtitle">Publicado: <fecha-viaje fecha="{{$fecha}}"></fecha-viaje></p>
            @if ($viaje->created_at != $viaje->updated_at)
            <p class="subtitle">Actualizado:<fecha-viaje fecha="{{$update}}"></fecha-viaje></p>
            @endif
        </div>
        <div class="description">
            <h6 class="subtitle">Acerca de mi viaje: </h6>
            {!!$viaje->description!!}
        </div>
        <div class="list-places">
            <h6 class="subtitle">Lugares que recomiedo visitar: </h6>
            {!!$viaje->topic_places!!}
        </div>
        <div>
           <like-button viaje-id="{{$viaje->id}}" like="{{$like}}" likes="{{$likes}}"></like-button>
        </div>
    </article>
@endsection