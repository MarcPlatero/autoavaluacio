<?php

namespace App\Http\Controllers;

use App\Models\Moduls;
use Illuminate\Http\Request;

class ModulsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $actiu = $request->input('actiuBuscar');

        if ($actiu == 'actiu')
        {
            $moduls = Moduls::where('actiu', '=', true)->get();
        }
        else
        {
            $moduls = Moduls::all();
        }

        $request->session()->flashInput($request->input());

        return view('moduls.index', compact('moduls'));
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
    public function show(Moduls $moduls)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Moduls $moduls)
    {
        //
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
}
