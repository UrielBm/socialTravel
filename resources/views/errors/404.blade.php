@extends('layouts.app')
<!-- Title de la section -->
@section('titleSection')
<h2 class="text-center display-2 mb-4 title">Error 404</h2>  
@endsection
@section('content')
<div class="container">
    <p class="errorText">¡Oh!, al parecer no podemos encontrar el elemento que estas buscando o se ha eliminado. Lo sentimos mucho シ.</p>
    <div class="d-flex justify-content-center">
        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<lottie-player src="https://assets10.lottiefiles.com/packages/lf20_mdbdc5l7.json"  background="transparent"  speed="1"  class="errorImage"  loop  autoplay></lottie-player>
    </div>
</div>
@endsection