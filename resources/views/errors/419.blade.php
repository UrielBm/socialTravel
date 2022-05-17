@extends('layouts.app')
<!-- Title de la section -->
@section('titleSection')
<h2 class="text-center display-2 mb-4 title">Error 419</h2>  
@endsection
@section('content')
<div class="container">
    <p class="errorText">¡Oh!,al parecer se agoto el tiempo de tu sesión, prueba igresando de nuevo.</p>
    <div class="d-flex justify-content-center">
        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
        <lottie-player src="https://assets2.lottiefiles.com/private_files/lf30_5i5tlydx.json"  background="transparent"  speed="1"   class="errorImage"  loop  autoplay></lottie-player>
    </div>
</div>
@endsection