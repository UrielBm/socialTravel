@php
    $fecha = $viaje->created_at;
@endphp
    <div class="col-md-4 mt-4">
        <div class="card shadow">
            <img class="card-img-top" src="/storage/{{$viaje->picture}}" alt="foto del viaje" />
                <div class="card-body">
                    <h5 class="card-title">{{$viaje->titulo}}</h5>
                <div class="travel-meta d-flex justify-content-between align-items-baseline">
                    <p class="text-danger fecha font-weight-bold">Publicado: <fecha-viaje fecha="{{$fecha}}"></fecha-viaje></p>
                    @if (count($viaje->likes) > 0)
                        <p class="d-flex align-items-center">
                            <svg class="heartCard" viewBox="0 0 32 29.6">
                                <path d="M23.6,0c-3.4,0-6.3,2.7-7.6,5.6C14.7,2.7,11.8,0,8.4,0C3.8,0,0,3.8,0,8.4c0,9.4,9.5,11.9,16,21.2c6.1-9.3,16-12.1,16-21.2C32,3.8,28.2,0,23.6,0z"/>
                            </svg> {{count($viaje->likes)}}</p>
                    @else 
                        <svg class="heartCard" viewBox="0 0 32 29.6">
                            <path d="M23.6,0c-3.4,0-6.3,2.7-7.6,5.6C14.7,2.7,11.8,0,8.4,0C3.8,0,0,3.8,0,8.4c0,9.4,9.5,11.9,16,21.2c6.1-9.3,16-12.1,16-21.2C32,3.8,28.2,0,23.6,0z"/>
                        </svg>
                    @endif 
                </div>
                <p>{{Str::words(strip_tags($viaje->description),16)}}</p>
                <a href="{{route('viaje.show', ['viaje' => $viaje->id])}}" class="btn btn-primary d-block uppercase">+ Acerca del viaje</a>
                </div>
        </div>
    </div>