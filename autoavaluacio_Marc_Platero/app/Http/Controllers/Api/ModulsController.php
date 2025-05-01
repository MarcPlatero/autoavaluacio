<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Moduls;
use Illuminate\Http\Request;
use App\Http\Resources\ModulsResource;
use App\Models\Inscripcio;
use Illuminate\Support\Facades\Auth;

class ModulsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // try {
        //     $moduls = Moduls::all();
        //     return response()->json($moduls);
        // } catch (\Throwable $th) {
        //     return response()->json(['error' => 'Error al mostrar els moduls: ' . $th->getMessage()], 500);
        // }

        $moduls = Moduls::all();
        return ModulsResource::collection($moduls);
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
    public function show(Moduls $moduls)
    {
        // try {
        //     $moduls = Moduls::with('resultats_aprenentatge.criteris_avaluacio.rubriques')->find($moduls->id);
        //     return  new ModulsResource($moduls);

        // } catch (\Throwable $th) {
        //     return response()->json(['error' => 'Error al mostrar l\'usuari: ' . $th->getMessage()], 500);
        // }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Moduls $moduls)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Moduls $moduls)
    {
        //
    }

    public function mostrarModulosMatriculados($idUsuari)
    {
        // try {
        //     $moduls = Moduls::whereHas('enrollments', function ($query) use ($idUsuari) {
        //         $query->where('usuaris_id', $idUsuari);
        //     })->get();

        //     return ModulsResource::collection($moduls);
        // } catch (\Throwable $th) {
        //     return response()->json(['error' => 'Error al mostrar els mòduls matriculats: ' . $th->getMessage()], 500);
        // }
    }
}
