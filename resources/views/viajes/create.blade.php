@extends('layouts.app')
<!-- styles que se ocupan para esta vista -->
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" integrity="sha512-5m1IeUDKtuFGvfgz32VVD0Jd/ySGX7xdLxhqemTmThxHdgqlgPdupWoSN8ThtUSLpAGBvA8DY2oO7jJCrGdxoA==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
@endsection

<!-- Title de la section -->
@section('titleSection')
    <h2 class="text-center display-2 mb-4 text-pink title">Publicar un nuevo viaje.</h2>
@endsection
<!-- Action buttons -->
@section('actionButtons')
    <div class="col-md-10 mx-auto p-3">
        <div class="d-flex align-items-center">
            <p class="mb-0 me-3">Ver mis viajes publicados:</p>
            <a href="{{route('viaje.index')}}" class="btn btn-success text-white">   
                Regresar
            </a>
        </div>
    </div>
@endsection
@section('content')
    <!-- section del form para crear viajes -->
    <section class="d-flex justify-content-center mt-5">
        <!-- section del form para publicar viajes -->
        <form class="container col-md-8 mb-2" method="POST" action="{{route('viaje.store')}}" enctype="multipart/form-data">
            @csrf
            <h3 class="text-center">Mi nuevo viaje.</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <label for="titulo">Titulo del viaje</label>
                        <input type="text" name="titulo" id="titulo" class="form-control @error('titulo') is-invalid @enderror" placeholder="Titulo del viaje" value="{{old('titulo')}}" />
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
                                <option value="{{$categoria->id}}" {{old('categoria') == $categoria->id ? "selected" : ""}}>{{$categoria->nombre}}</option>
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
                        <input id="topic_places" type="hidden" name="topic_places" value="{{old('topic_places')}}" />
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
                        <input id="description" type="hidden" name="description" value="{{old('description')}}" />
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
                <div class="col-md-4">
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
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="cost">Costo del viaje promedio:</label>
                        <input class="form-control @error('cost') is-invalid @enderror" id="cost" type="number" name="cost" placeholder="0" min="0" value="{{old('cost')}}" />
                        @error('cost')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="cost">Días que duro el viaje:</label>
                        <input class="form-control @error('days') is-invalid @enderror" id="days" type="number" name="days" placeholder="1" min="1" max="365" value="{{old('days')}}" />
                        @error('days')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">+ Agregar viaje.</button>
            </div>
        </form>
    </section>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
@endpush

