<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UsuarisController;
use App\Http\Controllers\Api\ResultatsAprenentatgeController;
use App\Http\Controllers\Api\CriterisAvaluacioController;
use App\Http\Controllers\Api\AlumneModulController;
use App\Http\Controllers\Api\ModulsController;
use App\Http\Controllers\Api\RubriquesController;
use App\Http\Controllers\Api\UsuariCriteriAvaluacioController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('usuaris', UsuarisController::class);
Route::apiResource('resultats_aprenentatge', ResultatsAprenentatgeController::class);
Route::apiResource('criteris_avaluacio', CriterisAvaluacioController::class);

Route::post('usuaris/{usuaris}/matricular/{moduls}', [AlumneModulController::class, 'matricularAlumneAModul']);
Route::post('usuaris/{usuaris}/desmatricular/{moduls}', [AlumneModulController::class, 'desmatricularAlumneDeModul']);

Route::apiResource('moduls', ModulsController::class);

Route::get('usuaris/{usuaris}/moduls', [AlumneModulController::class, 'obtenirModulsMatriculats']);

Route::get("obtenirRubriques/{stringIdsCriterisAvaluacio}",[RubriquesController::class,"obtenirRubricaSegonsCriteriAvaluacio"]);

Route::get("obtenirResultatsAprenentatge/{moduls}",[ResultatsAprenentatgeController::class,"obtenirResultatsAprenentatgeSegonsElModulSeleccionat"]);

Route::get("obtenirCriterisAvaluacio/{stringIdsResultatsAprenentatge}",[CriterisAvaluacioController::class,"obtenirCriterisAvaluacioSegonsElsResultatsDeAprenentatge"]);

Route::get("obtenirNotes/{usuaris}/{stringIdsCriterisAvaluacio}",[UsuariCriteriAvaluacioController::class,"obtenirNotesSegonsUsuariICriterisAvaluacio"]);

Route::put("canviarNota/{usuaris}/{idCriteriosEvaluacion}/{nota}",[UsuariCriteriAvaluacioController::class,"editarNotaCriteriAvaluacio"]);

Route::get("mostrarAlumnesInscritsAlModul/{moduls}",[AlumneModulController::class,"mostrarElsAlumnesInscritsAUnModul"]);