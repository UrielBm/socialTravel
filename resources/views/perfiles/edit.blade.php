@extends('layouts.app')
<!-- styles que se ocupan para esta vista -->
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" integrity="sha512-5m1IeUDKtuFGvfgz32VVD0Jd/ySGX7xdLxhqemTmThxHdgqlgPdupWoSN8ThtUSLpAGBvA8DY2oO7jJCrGdxoA==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
@endsection

<!-- Title de la section -->
@section('titleSection')
    <h2 class="text-center display-2 mb-4 text-pink title">Editar mi perfil.</h2>
@endsection
<!-- Action buttons -->
@section('actionButtons')
    <div class="col-md-10 mx-auto p-3">
        <div class="d-flex align-items-center">
            <p class="mb-0 me-3">Regresar a perfil:</p>
            <a href="{{route('perfil.show',["perfil" => $perfil->user->id])}}" class="btn btn-primary"><svg style="width: 1.2rem" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>Mi perfil.</a>
        </div>
    </div>
@endsection
@section('content')
    <!-- section del form para crear viajes -->
    <section class="d-flex justify-content-center mt-5">
        <!-- section del form para publicar viajes -->
        <form class="container col-md-8 mb-2" method="POST" action="{{route('perfil.update',["perfil" => $perfil->id])}}"  enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <label for="name">Nombre:</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="nombre de perfil"  value="{{$perfil->user->name}}"/>
                        @error('name')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <label for="url_video">Link de videos:</label>
                        <input type="text" name="url_video" id="url_video" class="form-control @error('url_video') is-invalid @enderror" placeholder="link donde pueden ver tus videos" value="{{$perfil->user->url_video}}" />
                        @error('url_video')
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
                        <label for="picture">Avatar:</label>
                        <input class="form-control @error('avatar') is-invalid @enderror" id="avatar" name="avatar" type="file" />
                        @error('avatar')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
               @if ($perfil->avatar)
                <div class="col-md-6 my-3">
                    <p class="mb-0">Avatar actual:</p>
                    <div class="d-flex justify-content-center">
                        <img src="/storage/{{$perfil->avatar}}"  alt="Avatar del perfil" style="width: 12rem" class="rounded-circle" />
                    </div>
                </div>
               @endif
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group mt-4">
                        <label for="biography" class="mb-2">Biografía:</label>
                        <input id="biography" type="hidden" name="biography"  value="{{$perfil->biography}}" />
                        <trix-editor class=" form-control @error('biography') is-invalid @enderror" input="biography"></trix-editor>
                        @error('biography')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="instagram">Link de Instagram:</label>
                        <input class="form-control @error('cost') is-invalid @enderror" id="instagram" type="text" name="instagram" placeholder="perfil de instagram" value="{{$perfil->instagram}}" />
                        @error('instagram')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="twitter">Link de Twitter:</label>
                        <input class="form-control @error('cost') is-invalid @enderror" id="twitter" type="text" name="twitter" placeholder="perfil de twitter" value="{{$perfil->twitter}}" />
                        @error('twitter')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary text-white"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"><path style="fill:#6e85b2" d="M14.078 4.232l-12.64 12.639-1.438 7.129 7.127-1.438 12.641-12.64-5.69-5.69zm-10.369 14.893l-.85-.85 11.141-11.125.849.849-11.14 11.126zm2.008 2.008l-.85-.85 11.141-11.125.85.85-11.141 11.125zm18.283-15.444l-2.816 2.818-5.691-5.691 2.816-2.816 5.691 5.689z"/></svg> Editar perfil.</button>
            </div>
        </form>
    </section>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
@endpush

