@extends('layouts.app')
<!-- Title de la section -->
@section('titleSection')
<h2 class="text-center display-2 mb-4 title">Error 403</h2>  
@endsection
@section('content')
<div class="container">
    <p class="errorText">¡Oh!,al parecer no cuentas con los permisos suficientes para estar aquí.Intenta con otra ruta.</p>
    <div class="d-flex justify-content-center">
        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
        <lottie-player src="https://assets7.lottiefiles.com/packages/lf20_ogx9s7qo.json"  background="transparent"  speed=".5"  class="errorImage"  loop  autoplay></lottie-player>
    </div>
</div>
@endsection