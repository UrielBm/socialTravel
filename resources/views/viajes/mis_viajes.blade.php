@extends('layouts.app')
<!-- Title de la section -->
@section('titleSection')
<h2 class="text-center display-2 mb-4 title">Tus viajes publicados</h2>  
@endsection
<!-- Action buttons -->
@section('actionButtons')
    <div class="col-md-10  mx-auto p-3">
        <div class="d-flex align-items-center"><p class="mb-0 me-3">Agregar un nuevo viaje:</p><a href="{{route('viaje.create')}}" class="btn btn-success text-white">+ Agregar viaje</a></div>
    </div>
@endsection
@section('content')
<!-- section de viajes publicados -->
<section>
    <!--section de tabla de viajes -->
    <div class="col-md-10 mx-auto bg-white p-3">
        <table class="table table-striped">
            <thead class="bg-primary ">
                <tr class="text-center">
                    <th scole="col">Titulo</th>
                    <th scole="col">Categoria</th>
                    <th scole="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @if (sizeof($viajes) > 0)
                @foreach ($viajes as $viaje)
                <tr>
                    <td class="Capital">{{$viaje->titulo}}</td>
                    <td class="text-center">{{$viaje->categoria->nombre}}</td>
                    <td>
                        <div class="d-flex justify-content-around align-items-center">
                            <a href="{{route('viaje.show',["viaje" => $viaje->id ])}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path style="fill:#346751;" d="M15 12c0 1.657-1.343 3-3 3s-3-1.343-3-3c0-.199.02-.393.057-.581 1.474.541 2.927-.882 2.405-2.371.174-.03.354-.048.538-.048 1.657 0 3 1.344 3 3zm-2.985-7c-7.569 0-12.015 6.551-12.015 6.551s4.835 7.449 12.015 7.449c7.733 0 11.985-7.449 11.985-7.449s-4.291-6.551-11.985-6.551zm-.015 12c-2.761 0-5-2.238-5-5 0-2.761 2.239-5 5-5 2.762 0 5 2.239 5 5 0 2.762-2.238 5-5 5z"/></svg>
                            </a>
                            <a href="{{route('viaje.edit',["viaje" => $viaje->id ])}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path style="fill:#6e85b2" d="M14.078 4.232l-12.64 12.639-1.438 7.129 7.127-1.438 12.641-12.64-5.69-5.69zm-10.369 14.893l-.85-.85 11.141-11.125.849.849-11.14 11.126zm2.008 2.008l-.85-.85 11.141-11.125.85.85-11.141 11.125zm18.283-15.444l-2.816 2.818-5.691-5.691 2.816-2.816 5.691 5.689z"/></svg>
                            </a>
                            <button-delete viaje-id={{$viaje->id}}></button-delete>
                        </div>
                    </td>
                </tr>
                @endforeach  
                @else
                     <tr>
                         <td colspan="3" class="text-center">No tienes viajes registrados</td>
                    </tr>  
                @endif 
            </tbody>
        </table>
        <div class="col-12 d-flex justify-content-center">
            {{$viajes->links()}}
        </div>
    </div>
</section>
@endsection