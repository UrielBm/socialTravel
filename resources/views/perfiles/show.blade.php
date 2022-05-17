@extends('layouts.app')

@section('actionButtons')
    @auth
        @if (Auth::user()->id === $perfil->user->id)
        <div class="col-md-10 mx-auto p-3">
            <div class="d-flex align-items-center">
                <p class="mb-0 me-3">Editar perfil:</p>
                <a href="{{route('perfil.edit',["perfil" => $perfil->user->id])}}" class="btn btn-outline-warning">   
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                        <path style="fill:#6e85b2" d="M14.078 4.232l-12.64 12.639-1.438 7.129 7.127-1.438 12.641-12.64-5.69-5.69zm-10.369 14.893l-.85-.85 11.141-11.125.849.849-11.14 11.126zm2.008 2.008l-.85-.85 11.141-11.125.85.85-11.141 11.125zm18.283-15.444l-2.816 2.818-5.691-5.691 2.816-2.816 5.691 5.689z"/>
                    </svg> Perfil.
                </a>
            </div>
            <share-button></share-button>
        </div>
        @endif
    @endauth
@endsection
@section('content')
    <section class="container">
            <div class="row">
                <div class="col-md-5 d-flex justify-content-center align-items-center">
                    @if ($perfil->avatar)
                   <div class="d-flex justify-content-center align-items-center">
                    <img src="/storage/{{$perfil->avatar}}" class="w-100 rounded-circle" alt="avatar del usuario" />
                   </div>
                    @else 
                    <div class="d-flex justify-content-center align-items-center">
                        <img src="/storage/upload-perfiles/usuario.png" class="w-100 rounded-circle" alt="avatar delfault" />    
                    </div>
                    @endif
                </div>
                <div class="col-md-7 mt-3 mt-md-0 d-flex flex-column justify-content-center">
                    <div class="d-flex justify-content-start align-items-baseline"><h4 class="me-3 subtitle">Nombre:</h4><p>{{$perfil->user->name}}</p></div>
                    @if ($perfil->user->url_video !== $perfil->instagram)
                    <div class="d-flex justify-content-start align-items-baseline"><h4 class="me-3 subtitle">Link:</h4> <a href="{{$perfil->user->url_video}}" class="text-info">Mira más de mi contenido</a></div>
                    @endif
                    @if ($perfil->biography)
                    <div>
                        <h4 class="subtitle">Acerca de mi:</h4>
                        {!!$perfil->biography!!}
                    </div>
                    @endif
                    @if ($perfil->instagram || $perfil->twitter)
                    <div class="mb-3">
                        <h4 class="subtitle">Mis redes sociales:</h4>
                        <div class="d-flex justify-content-around">
                            @if ($perfil->twitter)
                                <a href="{{$perfil->twitter}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24">
                                        <path style="fill:#6e85b2" d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6.5 8.778c-.441.196-.916.328-1.414.388.509-.305.898-.787 1.083-1.362-.476.282-1.003.487-1.564.597-.448-.479-1.089-.778-1.796-.778-1.59 0-2.758 1.483-2.399 3.023-2.045-.103-3.86-1.083-5.074-2.572-.645 1.106-.334 2.554.762 3.287-.403-.013-.782-.124-1.114-.308-.027 1.14.791 2.207 1.975 2.445-.346.094-.726.116-1.112.042.313.978 1.224 1.689 2.3 1.709-1.037.812-2.34 1.175-3.647 1.021 1.09.699 2.383 1.106 3.773 1.106 4.572 0 7.154-3.861 6.998-7.324.482-.346.899-.78 1.229-1.274z"/>
                                    </svg>
                                </a>
                            @endif
                            @if ($perfil->instagram)
                                <a href="{{$perfil->instagram}}">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        width="50" height="50" viewBox="0 0 24 24">
                                        <path style="fill: #bd4b4b;" d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm0 7.082c1.602 0 1.792.006 2.425.035 1.627.074 2.385.845 2.46 2.459.028.633.034.822.034 2.424s-.006 1.792-.034 2.424c-.075 1.613-.832 2.386-2.46 2.46-.633.028-.822.035-2.425.035-1.602 0-1.792-.006-2.424-.035-1.63-.075-2.385-.849-2.46-2.46-.028-.632-.035-.822-.035-2.424s.007-1.792.035-2.424c.074-1.615.832-2.386 2.46-2.46.632-.029.822-.034 2.424-.034zm0-1.082c-1.63 0-1.833.007-2.474.037-2.18.1-3.39 1.309-3.49 3.489-.029.641-.036.845-.036 2.474 0 1.63.007 1.834.036 2.474.1 2.179 1.31 3.39 3.49 3.49.641.029.844.036 2.474.036 1.63 0 1.834-.007 2.475-.036 2.176-.1 3.391-1.309 3.489-3.49.029-.64.036-.844.036-2.474 0-1.629-.007-1.833-.036-2.474-.098-2.177-1.309-3.39-3.489-3.489-.641-.03-.845-.037-2.475-.037zm0 2.919c-1.701 0-3.081 1.379-3.081 3.081s1.38 3.081 3.081 3.081 3.081-1.379 3.081-3.081c0-1.701-1.38-3.081-3.081-3.081zm0 5.081c-1.105 0-2-.895-2-2 0-1.104.895-2 2-2 1.104 0 2.001.895 2.001 2s-.897 2-2.001 2zm3.202-5.922c-.397 0-.72.322-.72.72 0 .397.322.72.72.72.398 0 .721-.322.721-.72 0-.398-.322-.72-.721-.72z"/>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    @endif
                    </div>
                </div>
            </div>
    </section>
    <section id="trips" class="container">
        <h2 class="display-6 text-center title">Viajes de {{$perfil->user->name}}</h2>
        @if( sizeof($viajes) > 0 )
        <div class="d-flex justify-content-between align-items-center flex-wrap my-4">
            @foreach ($viajes as $viaje)
                <div class="card" style="width: 22rem; margin-top:1rem">
                    <img class="card-img-top" src="/storage/{{$viaje->picture}}" alt="foto del viaje">
                    <div class="card-body">
                    <h5 class="card-title">{{$viaje->titulo}}</h5>
                    <p class="card-text">{{$viaje->categoria->nombre}}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">${{$viaje->cost}} pesos.</li>
                        <li class="list-group-item">Fecha publicación: <fecha-viaje fecha="{{$viaje->created_at}}"></fecha-viaje></li>
                    </ul>
                    <div class="card-body">
                    <a href="{{route('viaje.show',["viaje" => $viaje->id])}}" class="btn btn-primary d-block">+ ACERCA DEL VIAJE</a>
                    </div>
                </div>
            @endforeach
        </div>
        @else
        <p class="text-center my-3">Aun no ha compartido ninguna aventura ツ,esperemos que pronto lo haga.</p>
       @endif
       <div class="col-12 d-flex justify-content-center">
        {{$viajes->links()}}
       </div>
    </section>
@endsection