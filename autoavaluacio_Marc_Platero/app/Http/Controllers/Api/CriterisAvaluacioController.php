<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Criteris_Avaluacio;
use Illuminate\Http\Request;
use App\Http\Resources\CriterisAvaluacioResource;
use Illuminate\Database\QueryException;
use App\Clases\Utilitat;


class CriterisAvaluacioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $criteris = Criteris_Avaluacio::all();

        return CriterisAvaluacioResource::collection($criteris);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $criteris_Avaluacio = new Criteris_Avaluacio();

        $criteris_Avaluacio->ordre = $request->input('ordre');
        $criteris_Avaluacio->descripcio = $request->input('descripcio');
        $criteris_Avaluacio->actiu = ($request->input('actiu') == 'actiu');
        $criteris_Avaluacio->resultats_aprenentatge_id = $request->input('resultats_aprenentatge_id');

        try 
        {
            $criteris_Avaluacio->save();
            $response = (new CriterisAvaluacioResource($criteris_Avaluacio))->response()->setStatusCode(201);
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
    public function show(Criteris_Avaluacio $criteris_Avaluacio)
    {
        return new CriterisAvaluacioResource($criteris_Avaluacio);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Criteris_Avaluacio $criteris_Avaluacio)
    {
        $criteris_Avaluacio->ordre = $request->input('ordre');
        $criteris_Avaluacio->descripcio = $request->input('descripcio');
        $criteris_Avaluacio->actiu = ($request->input('actiu') == 'actiu');
        $criteris_Avaluacio->resultats_aprenentatge_id = $request->input('resultats_aprenentatge_id');

        try 
        {
            $criteris_Avaluacio->save();
            $response = (new CriterisAvaluacioResource($criteris_Avaluacio))->response()->setStatusCode(201);
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
    public function destroy(Criteris_Avaluacio $criteris_Avaluacio)
    {
        try
        {
            $criteris_Avaluacio->delete();
            $response = \response()->json(['mensaje' => 'Criteri d\'Avaluació esborrat correctament.'], 200);
        }
        catch (QueryException $ex)
        {
            $mensaje = Utilitat::errorMessage($ex);
            $response = \response()->json(['error' => $mensaje], 400);
        }

        return $response;
    }

    public function obtenirCriterisAvaluacioSegonsElsResultatsDeAprenentatge(Request $request)
    {
        $stringIdsResultatsAprenentatge=$request->stringIdsResultatsAprenentatge;
        $arrayIdsResultadosDeAprendizaje = explode(",", $stringIdsResultatsAprenentatge);
        $criteriosEvaluacion=[];

        for ($i=0; $i <count($arrayIdsResultadosDeAprendizaje); $i++) {
            $criteriosEvaluacion[$i]=Criteris_Avaluacio::where('resultats_aprenentatge_id',$arrayIdsResultadosDeAprendizaje[$i])->get();
        }

        $response=response()->json($criteriosEvaluacion,200);

        return $response;
    }
}
