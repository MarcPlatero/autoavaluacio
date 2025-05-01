<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rubriques;
use Illuminate\Http\Request;
use App\Http\Resources\RubriquesResource;
use Illuminate\Support\Facades\Auth;

class RubriquesController extends Controller
{
    
    public function obtenirRubricaSegonsCriteriAvaluacio(Request $request)
    {
        $stringIdsCriterisAvaluacio=$request->stringIdsCriterisAvaluacio;
        $arrayIdsCriterisDeAvaluacio=explode(",", $stringIdsCriterisAvaluacio);
        $rubriques=[];

        for ($i=0; $i <count($arrayIdsCriterisDeAvaluacio); $i++) {
            $rubriques[$i]=Rubriques::where('criteris_avaluacio_id',$arrayIdsCriterisDeAvaluacio[$i])->get();
        }

        $response=response()->json($rubriques,200);

        return $response;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Rubriques $rubriques)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rubriques $rubriques)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rubriques $rubriques)
    {
        //
    }

}
