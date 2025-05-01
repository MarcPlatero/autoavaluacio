<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Resultats_Aprenentatge;
use Illuminate\Http\Request;
use App\Http\Resources\ResultatsAprenentatgeResource;
use Illuminate\Database\QueryException;
use App\Clases\Utilitat;

class ResultatsAprenentatgeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resultats = Resultats_Aprenentatge::all();

        return ResultatsAprenentatgeResource::collection($resultats);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $resultats_Aprenentatge = new Resultats_Aprenentatge();

        $resultats_Aprenentatge->ordre = $request->input('ordre');
        $resultats_Aprenentatge->descripcio = $request->input('descripcio');
        $resultats_Aprenentatge->actiu = ($request->input('actiu') == 'actiu');
        $resultats_Aprenentatge->moduls_id = $request->input('moduls_id');

        try 
        {
            $resultats_Aprenentatge->save();
            $response = (new ResultatsAprenentatgeResource($resultats_Aprenentatge))->response()->setStatusCode(201);
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
    public function show(Resultats_Aprenentatge $resultats_Aprenentatge)
    {
        return new ResultatsAprenentatgeResource($resultats_Aprenentatge);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Resultats_Aprenentatge $resultats_Aprenentatge)
    {
        $resultats_Aprenentatge->ordre = $request->input('ordre');
        $resultats_Aprenentatge->descripcio = $request->input('descripcio');
        $resultats_Aprenentatge->actiu = ($request->input('actiu') == 'actiu');
        $resultats_Aprenentatge->moduls_id = $request->input('moduls_id');

        try 
        {
            $resultats_Aprenentatge->save();
            $response = (new ResultatsAprenentatgeResource($resultats_Aprenentatge))->response()->setStatusCode(201);
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
    public function destroy(Resultats_Aprenentatge $resultats_Aprenentatge)
    {
        try
        {
            $resultats_Aprenentatge->delete();
            $response = \response()->json(['mensaje' => 'Resultat d\'Aprenentatge esborrat correctament.'], 200);
        }
        catch (QueryException $ex)
        {
            $mensaje = Utilitat::errorMessage($ex);
            $response = \response()->json(['error' => $mensaje], 400);
        }

        return $response;
    }

    public function obtenirResultatsAprenentatgeSegonsElModulSeleccionat(Request $request)
    {
        $idModul=$request->moduls;

        $resultatsAprenentatge=Resultats_Aprenentatge::where("moduls_id","=",$idModul)->get();

        if($resultatsAprenentatge->isEmpty())
        {
            $response=response()->json(["message"=>"El mòdul no té resultats d'aprenentatge."],200);
        }
        else
        {
            $response=response()->json($resultatsAprenentatge,200);
        }

        return $response;
    }
}
