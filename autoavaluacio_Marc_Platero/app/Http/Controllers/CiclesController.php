<?php

namespace App\Http\Controllers;

use App\Models\Cicles;
use Illuminate\Http\Request;

class CiclesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $actiu = $request->input('actiuBuscar');

        if ($actiu == 'actiu')
        {
            $cicles = Cicles::where('actiu', '=', true)->get();
        }
        else
        {
            $cicles = Cicles::all();
        }

        $request->session()->flashInput($request->input());

        return view('cicles.index', compact('cicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Cicles $cicles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cicles $cicles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cicles $cicles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cicles $cicles)
    {
        //
    }
}
