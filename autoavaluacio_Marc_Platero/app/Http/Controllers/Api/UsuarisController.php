<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Usuaris;
use Illuminate\Http\Request;
use App\Http\Resources\UsuarisResource;
use Illuminate\Database\QueryException;
use App\Clases\Utilitat;

class UsuarisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuaris = Usuaris::all();

        return UsuarisResource::collection($usuaris);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $usuaris = new Usuaris();

        $usuaris->nom_usuari = $request->input('nom_usuari');
        $usuaris->contrasenya = bcrypt($request->get('contrasenya'));
        $usuaris->correu = $request->input('correu');
        $usuaris->nom = $request->input('nom');
        $usuaris->cognom = $request->input('cognom');
        $usuaris->actiu = ($request->input('actiu') == 'actiu');
        $usuaris->tipus_usuaris_id  = $request->input('tipus_usuaris_id');

        try 
        {
            $usuaris->save();
            $response = (new UsuarisResource($usuaris))->response()->setStatusCode(201);
        }
        catch (QueryException $ex)
        {
            $mensaje = Utilitat::errorMessage($ex);
            $response = \response()->json(['error' => $mensaje], 400);
        }

        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuaris $usuaris)
    {
        return new UsuarisResource($usuaris);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuaris $usuaris)
    {
        $usuaris->nom_usuari = $request->input('nom_usuari');
        $usuaris->contrasenya = bcrypt($request->get('contrasenya'));
        $usuaris->correu = $request->input('correu');
        $usuaris->nom = $request->input('nom');
        $usuaris->cognom = $request->input('cognom');
        $usuaris->actiu = ($request->input('actiu') == 'actiu');
        $usuaris->tipus_usuaris_id  = $request->input('tipus_usuaris_id');

        try 
        {
            $usuaris->save();
            $response = (new UsuarisResource($usuaris))->response()->setStatusCode(201);
        }
        catch (QueryException $ex)
        {
            $mensaje = Utilitat::errorMessage($ex);
            $response = \response()->json(['error' => $mensaje], 400);
        }

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuaris $usuaris)
    {
        try
        {
            // Comprova si l'usuari té dades relacionades
            if ($usuaris->hasRelatedData()) {
                // Si té dades relacionades, posa l'usuari com a inactiu
                $usuaris->update(['actiu' => false]);
                $response = \response()->json(['error' => 'L\'usuari no es pot eliminar ja que té dades relacionades, és posa en inactiu.'], 400);
            } else {
                // Si no té dades relacionades, esborra l'usuari definitivament
                $usuaris->delete();
                $response = \response()->json(['mensaje' => 'L\'usuari s\'ha esborrat correctament.'], 200);
            }
        }
        catch (QueryException $ex)
        {
            $mensaje = Utilitat::errorMessage($ex);
            $response = \response()->json(['error' => $mensaje], 400);
        }

        return $response;
    }
}
