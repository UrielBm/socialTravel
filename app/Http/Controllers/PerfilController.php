<?php

namespace App\Http\Controllers;

use App\Models\Viaje;
use App\Models\Perfil;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        $viajes = Viaje::where("user_id", $perfil->user_id)->paginate(6);
        return view("/perfiles.show", compact('perfil', 'viajes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        //validando policy
        $this->authorize('view', $perfil);
        return view("/perfiles.edit", compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {
        // usanso poilicy para evitar update no permitidos
        $this->authorize('update', $perfil);
        $data = request()->validate([
            'name' => 'required',
            'url_video' => 'required |url',
            'biography' => 'required |min:30',
            'instagram' => 'required |url',
            'twitter' =>   'required |url',
        ]);
        // si el usuario sube una imagen 
        if ($request['avatar']) {
            //Ruta de la imagen en nuestro servidor
            $ruta_imagen = $request['avatar']->store('upload-perfiles', 'public');

            //tamaño de la imagen modificada
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(400, 400);
            $img->save();

            // creando array de img
            $array_avatar = ['avatar' => $ruta_imagen];
        }
        // actualizar datos del usuario
        auth()->user()->name = $data["name"];
        auth()->user()->url_video = $data["url_video"];
        auth()->user()->save();
        // eliminar datos de la tabla usuario que no se require en perfil
        unset($data['name']);
        unset($data['url_video']);
        // actualizar datos de perfil
        auth()->user()->perfil()->update(array_merge($data, $array_avatar ?? []));
        return redirect()->action([ViajeController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        //
    }
}
