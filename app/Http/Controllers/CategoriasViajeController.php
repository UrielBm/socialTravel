<?php

namespace App\Http\Controllers;

use App\Models\Viaje;
use Illuminate\Http\Request;
use App\Models\CategoriaViaje;

class CategoriasViajeController extends Controller
{
    public function show(CategoriaViaje $categoria)
    {
        $viajes = Viaje::where("categoria_id", $categoria->id)->paginate(6);
        return view("/categorias.categoria", compact("viajes", "categoria"));
    }
}
