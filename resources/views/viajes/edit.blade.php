@extends('layouts.app')
<!-- styles que se ocupan para esta vista -->
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" integrity="sha512-5m1IeUDKtuFGvfgz32VVD0Jd/ySGX7xdLxhqemTmThxHdgqlgPdupWoSN8ThtUSLpAGBvA8DY2oO7jJCrGdxoA==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
@endsection

<!-- Title de la section -->
@section('titleSection')
    <h2 class="text-center display-2 mb-4 text-pink title">Editar mi viaje.</h2>
@endsection
<!-- Action buttons -->
@section('actionButtons')
    <div class="col-md-10 mx-auto p-3">
        <div class="d-flex align-items-center">
            <p class="mb-0 me-3">Ver mis viajes publicados:</p>
            <a href="{{route('viaje.index')}}" class="btn btn-outline-success">   
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" style="margin-right: .5rem">
                    <path style="fill:#346751;" d="M15 12c0 1.657-1.343 3-3 3s-3-1.343-3-3c0-.199.02-.393.057-.581 1.474.541 2.927-.882 2.405-2.371.174-.03.354-.048.538-.048 1.657 0 3 1.344 3 3zm-2.985-7c-7.569 0-12.015 6.551-12.015 6.551s4.835 7.449 12.015 7.449c7.733 0 11.985-7.449 11.985-7.449s-4.291-6.551-11.985-6.551zm-.015 12c-2.761 0-5-2.238-5-5 0-2.761 2.239-5 5-5 2.762 0 5 2.239 5 5 0 2.762-2.238 5-5 5z"/>
                </svg>Mis viajes.
            </a>
        </div>
    </div>
@endsection
@section('content')
    <!-- section del form para crear viajes -->
    <section class="d-flex justify-content-center mt-5">
        <!-- section del form para publicar viajes -->
        <form class="container col-md-8 mb-2" method="POST" action="{{route('viaje.update',["viaje" => $viaje->id ])}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <h3 class="text-center">Editando: {{$viaje->titulo}}</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <label for="titulo">Titulo del viaje</label>
                        <input type="text" name="titulo" id="titulo" class="form-control @error('titulo') is-invalid @enderror" placeholder="Titulo del viaje" value="{{$viaje->titulo}}" />
                        @error('titulo')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="categoria">Categoria:</label>
                        <select name="categoria" id="categoria" class="form-control @error('categoria') is-invalid @enderror">
                            <option value="">--Seleccione una opción--</option>
                            @foreach ($categorias as$categoria)
                                <option value="{{$categoria->id}}" {{$viaje->categoria_id == $categoria->id ? "selected" : ""}}>{{$categoria->nombre}}</option>
                            @endforeach
                        </select>
                        @error('categoria')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mt-4">
                        <label for="topic_places" class="mb-2">Lugares que visitar:</label>
                        <input id="topic_places" type="hidden" name="topic_places" value="{{$viaje->topic_places}}" />
                        <trix-editor class=" form-control @error('topic_places') is-invalid @enderror" input="topic_places"></trix-editor>
                        @error('topic_places')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mt-4">
                        <label for="description" class="mb-2">Descripción: ¿Qué hice en el viaje?</label>
                        <input id="description" type="hidden" name="description" value="{{$viaje->description}}" />
                        <trix-editor class=" form-control @error('description') is-invalid @enderror" input="description"></trix-editor>
                        @error('description')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="picture">Foto del viaje:</label>
                        <input class="form-control @error('picture') is-invalid @enderror" id="picture" name="picture" type="file" />
                        @error('picture')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 my-3">
                    <p class="mb-0">Foto actual del viaje:</p>
                    <img src="/storage/{{$viaje->picture}}" alt="foto actual del viaje" style="width: 22rem" />
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cost">Costo del viaje promedio:</label>
                        <input class="form-control @error('cost') is-invalid @enderror" id="cost" type="number" name="cost" placeholder="0" min="0" value="{{$viaje->cost}}" />
                        @error('cost')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary text-white"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"><path style="fill:#6e85b2" d="M14.078 4.232l-12.64 12.639-1.438 7.129 7.127-1.438 12.641-12.64-5.69-5.69zm-10.369 14.893l-.85-.85 11.141-11.125.849.849-11.14 11.126zm2.008 2.008l-.85-.85 11.141-11.125.85.85-11.141 11.125zm18.283-15.444l-2.816 2.818-5.691-5.691 2.816-2.816 5.691 5.689z"/></svg> Editar viaje.</button>
            </div>
        </form>
    </section>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
@endpush

