<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Moduls;
use App\Models\Usuaris;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Clases\Utilitat;

class AlumneModulController extends Controller
{
    public function matricularAlumneAModul(Usuaris $usuaris, Moduls $moduls)
    {
        try {
            //Amb attach, s'està afegint un registre a la taula pivot usuaris_has_moduls per associar un usuari amb un mòdul específic.
            $usuaris->moduls()->attach($moduls->id);

            $resposta = $this->mostrarSiUnAlumneEstaMatriculatEnUnModul($usuaris, $moduls);

            if ($resposta->getData()->message === "L'alumne està matriculat en el mòdul.") {
                $response = response()->json(["message" => "L'alumne s'ha matriculat al mòdul correctament."], 201);
            } else {
                $response = response()->json(["message" => "No s'ha pogut matricular l'alumne al mòdul."], 500);
            }
        } catch (QueryException $ex) {
            $mensaje = Utilitat::errorMessage($ex);
            $response = response()->json(['error' => $mensaje], 400);
        }

        return $response;
    }

    public function desmatricularAlumneDeModul(Usuaris $usuaris, Moduls $moduls)
    {
        try {
            $usuaris->moduls()->detach($moduls->id);

            $resposta = $this->mostrarSiUnAlumneEstaMatriculatEnUnModul($usuaris, $moduls);

            if ($resposta->getData()->message === "L'alumne no està matriculat en el mòdul.") {
                $response = response()->json(["message" => "L'alumne s'ha desmatriculat del mòdul correctament."], 201);
            } else {
                $response = response()->json(["message" => "No s'ha pogut desmatricular l'alumne del mòdul."], 500);
            }
        } catch (QueryException $ex) {
            $mensaje = Utilitat::errorMessage($ex);
            $response = response()->json(['error' => $mensaje], 400);
        }

        return $response;
    }

    public function mostrarSiUnAlumneEstaMatriculatEnUnModul(Usuaris $usuaris, Moduls $moduls)
    {
        if ($usuaris->moduls()->where('moduls_id', $moduls->id)->exists()) {
            return response()->json(["message" => "L'alumne està matriculat en el mòdul."], 200);
        } else {
            return response()->json(["message" => "L'alumne no està matriculat en el mòdul."], 200);
        }
    }

    public function obtenirModulsMatriculats(Usuaris $usuaris)
    {
        try {
            $moduls = $usuaris->moduls()->get();
            return response()->json($moduls, 200);
        } catch (QueryException $ex) {
            $mensaje = Utilitat::errorMessage($ex);
            return response()->json(['error' => $mensaje], 400);
        }
    }

    public function mostrarElsAlumnesInscritsAUnModul(Request $request)
    {
        $idModulo=$request->moduls;

        $alumnos = Usuaris::join('usuaris_has_moduls', 'usuaris.id', '=', 'usuaris_has_moduls.usuaris_id')
        ->where('usuaris_has_moduls.moduls_id', $idModulo)
        ->where('usuaris.tipus_usuaris_id', 3)
        ->select('usuaris.id AS id', 'usuaris.nom AS nombre', 'usuaris.cognom AS apellidos')
        ->get();

        if($alumnos->isEmpty())
        {
            $response=response()->json(["message"=>"Error, El mòdul no existeix."],500);
        }
        else
        {
            $response=response()->json($alumnos,200);
        }

        return $response;
    }
}
