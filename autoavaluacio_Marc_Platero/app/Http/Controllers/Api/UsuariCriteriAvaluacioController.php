<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Usuaris;
use App\Models\Criteris_Avaluacio;
use Illuminate\Http\Request;

class UsuariCriteriAvaluacioController extends Controller
{
    
    public function obtenirNotesSegonsUsuariICriterisAvaluacio(Request $request)
    {
        $idUsuario=$request->usuaris;
        $stringIdsCriterisAvaluacio=$request->stringIdsCriterisAvaluacio;
        $arrayIdsCriteriosDeEvaluacion=explode(",", $stringIdsCriterisAvaluacio);
        $notas=[];
        $usuaris = Usuaris::find($idUsuario);

        for ($i=0; $i <count($arrayIdsCriteriosDeEvaluacion); $i++) {
            $criterioEvaluacion=Criteris_Avaluacio::find($arrayIdsCriteriosDeEvaluacion[$i]);

            $registroIntermedia = $usuaris->criteris_avaluacio()
                ->wherePivot('criteris_avaluacio_id', $criterioEvaluacion->id)
                ->first();

            $notas[$i]=["idUsuario"=>$registroIntermedia->pivot->usuaris_id,"idCriteriosEvaluacion"=>$registroIntermedia->pivot->criteris_avaluacio_id,"nota"=>$registroIntermedia->pivot->nota];
        }

        $response=response()->json($notas,200);

        return $response;
    }

    public function editarNotaCriteriAvaluacio(Request $request)
    {
        $idUsuario=$request->usuaris;
        $idCriteriosEvaluacion=$request->idCriteriosEvaluacion;
        $nota=$request->nota;

        $usuaris = Usuaris::find($idUsuario);

        $usuaris->criteris_avaluacio()->updateExistingPivot($idCriteriosEvaluacion, ['nota' => $nota]);

        return response()->json(["message"=>"Nota actualizada correctamente"],200);
    }

}
