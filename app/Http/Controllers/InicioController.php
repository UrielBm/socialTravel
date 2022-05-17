<?php

namespace App\Http\Controllers;

use App\Models\Viaje;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CategoriaViaje;

class InicioController extends Controller
{
    //
    public function index()
    {
        //obtener los viajes más largos.
        $masLargos = Viaje::orderBy('days', 'desc')->take(3)->get();
        //obtener viajes más gustados. 
        $masVotados = Viaje::withCount('likes')->orderBy('likes_count', 'desc')->take(3)->get();
        //obtener los más nuevos viajes
        $nuevos = Viaje::latest()->take(6)->get();
        //obtener viajes por categorias
        $categorias = CategoriaViaje::all();
        $viajesCategoria = [];

        foreach ($categorias as $categoria) {
            $haveOne = Viaje::where('categoria_id', $categoria->id)->exists();
            if ($haveOne) {
                $viajesCategoria[Str::slug($categoria->nombre)][] = Viaje::where('categoria_id', $categoria->id)->take(3)->get();
            }
        }
        return view('inicio.index', compact("nuevos", "viajesCategoria", "masVotados", "masLargos"));
    }
}
