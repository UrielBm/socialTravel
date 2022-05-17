<?php

namespace App\Http\Controllers;

use App\Models\Viaje;
use Illuminate\Http\Request;
use App\Models\CategoriaViaje;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class ViajeController extends Controller
{
    /** middleWare para protejer las rutas del viajeController */

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show', 'search']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user()->id;
        $viajes = Viaje::where("user_id", $user)->paginate(5);
        return view('/viajes.mis_viajes', compact('viajes'));
    }
    public function indexLike()
    {
        $user = auth()->user();
        return view('/viajes.me_gustan', compact('user'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //obtener categorias por BD
        //$categorias = DB::table('categoria_viajes')->get()->pluck('nombre', 'id');

        //obtener categorias por Modelo
        $categorias = CategoriaViaje::all(["id", "nombre"]);
        return view('/viajes.create', compact("categorias"));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'titulo' => 'required|min:10',
            'topic_places' => 'required',
            'description' => 'required',
            'picture' => 'required|image|max:6000',
            'cost' => 'required|numeric|min:0',
            'days' => 'required|numeric|min:1',
            'categoria' => 'required',
        ]);

        //Ruta de la imagen en nuestro servidor
        $ruta_imagen = $request['picture']->store('upload-viajes', 'public');

        //tamaño de la imagen modificada
        $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(850, 400);
        $img->save();
        // Ejemplo de insertando sin un modelo
        // DB::table('viajes')->insert([
        //     'titulo' => $data['titulo'],
        //     'topic_places' => $data['topic_places'],
        //     'description' => $data['description'],
        //     'picture' => $ruta_imagen,
        //     'cost' => $data['cost'],
        //     'user_id' => Auth::user()->id,
        //     'categoria_id' => $data['categoria'],
        // ]);

        //Insertando con modelo. 
        auth()->user()->viajes()->create([
            'titulo' => $data['titulo'],
            'topic_places' => $data['topic_places'],
            'description' => $data['description'],
            'picture' => $ruta_imagen,
            'cost' => $data['cost'],
            'days' => $data['days'],
            'categoria_id' => $data['categoria'],
        ]);

        return  redirect()->action([ViajeController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Viaje  $viaje
     * @return \Illuminate\Http\Response
     */
    public function show(Viaje $viaje)
    {
        //verificar si el viaje tiene me gusta
        $like = (auth()->user()) ? auth()->user()->meGusta->contains($viaje->id) : false;
        // cuantos likes tiene la receta
        $likes = $viaje->likes->count();
        return view("/viajes.show", compact('viaje', 'like', 'likes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Viaje  $viaje
     * @return \Illuminate\Http\Response
     */
    public function edit(Viaje $viaje)
    {
        //validando que sea el mismo usuario que la creo
        $this->authorize('view', $viaje);
        //obtener categorias por Modelo
        $categorias = CategoriaViaje::all(["id", "nombre"]);
        return view("/viajes.edit", compact("viaje", "categorias"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Viaje  $viaje
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Viaje $viaje)
    {
        //validando que sea el mismo usuario que la creo
        $this->authorize('update', $viaje);
        //validación
        $data = request()->validate([
            'titulo' => 'required|min:10',
            'topic_places' => 'required',
            'description' => 'required',
            'cost' => 'required|numeric|min:0',
            'categoria' => 'required',
        ]);

        //Asignar los valores
        $viaje->titulo =       $data['titulo'];
        $viaje->topic_places = $data['topic_places'];
        $viaje->description =  $data['description'];
        $viaje->cost =         $data['cost'];
        $viaje->categoria_id = $data['categoria'];

        //si sube una nueva imagen
        if (request('picture')) {
            //Ruta de la imagen en nuestro servidor
            $ruta_imagen = $request['picture']->store('upload-viajes', 'public');

            //tamaño de la imagen modificada
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000, 550);
            $img->save();

            //asignar al objeto de viaje
            $viaje->picture = $ruta_imagen;
        }
        $viaje->save();

        //redireccionar
        return  redirect()->action([ViajeController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Viaje  $viaje
     * @return \Illuminate\Http\Response
     */
    public function destroy(Viaje $viaje)
    {
        //verificando permisos  usuario que lo creo para eliminar
        $this->authorize('delete', $viaje);
        //eliminado relación de likes y viajes.
        DB::table('likes_viaje')->where('viaje_id', $viaje->id)->delete();

        //eliminando el viaje 
        $viaje->delete();

        //redirect to view index 
        return  redirect()->action([ViajeController::class, 'index']);
    }

    public function search(Request $request)
    {
        $busqueda = $request['search'];
        $viajes = Viaje::where('titulo', 'like', '%' . $busqueda . '%')->paginate(6);
        $viajes->appends(['search' => $busqueda]);
        return view("busqueda.show", compact("viajes", "busqueda"));
    }
}
