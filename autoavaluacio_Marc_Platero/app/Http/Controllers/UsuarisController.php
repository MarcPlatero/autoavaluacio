<?php

namespace App\Http\Controllers;

use App\Models\Usuaris;
use App\Clases\Utilitat;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsuarisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $actiu = $request->input('actiuBuscar');

        if ($actiu == 'actiu')
        {
            // $usuaris = Usuaris::where('actiu', '=', true)->get();

            $usuaris = Usuaris::where('actiu', '=', true)->paginate(7)->withQueryString();
        }
        else
        {
            // $usuaris = Usuaris::all();

            $usuaris = Usuaris::paginate(7);
        }

        $request->session()->flashInput($request->input());

        return view('usuaris.index', compact('usuaris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('usuaris.nouUsuari');
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
            $response = redirect()->action([UsuarisController::class, 'index'])->with('mensaje', 'Usuari creat correctament.');
        }
        catch (QueryException $ex)
        {
            $mensaje = Utilitat::errorMessage($ex);
            $request->session()->flash('error', $mensaje);
            $response = redirect()->action([UsuarisController::class, 'create'])->withInput();
        }

        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuaris $usuaris)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuaris $usuari)
    {
        return view('usuaris.editarUsuari', compact('usuari'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuaris $usuari)
    {
        $usuari->nom_usuari = $request->input('nom_usuari');
        // $usuari->contrasenya = $request->input('contrasenya');
        $usuari->correu = $request->input('correu');
        $usuari->nom = $request->input('nom');
        $usuari->cognom = $request->input('cognom');
        $usuari->actiu = ($request->input('actiu') == 'actiu');
        $usuari->tipus_usuaris_id = $request->input('tipus_usuaris_id');

        $usuari->save();

        return redirect()->action([UsuarisController::class, 'index'])->with('mensaje', 'Dades de l\'usuari actualitzades correctament.');
    }

    public function editPassword(Usuaris $usuari)
    {
        return view('usuaris.canviarContrasenya', compact('usuari'));
    }

    public function updatePassword(Request $request, Usuaris $usuari)
    {
        if ($request->filled('contrasenya')) {
            $usuari->contrasenya = bcrypt($request->get('contrasenya'));
        }

        $usuari->save();

        return redirect()->action([UsuarisController::class, 'index'])->with('mensaje', 'Contrasenya actualitzada correctament.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Usuaris $usuari)
    {
        try
        {
            // Comprova si l'usuari té dades relacionades
            if ($usuari->hasRelatedData()) {
                // Si té dades relacionades, posa l'usuari com a inactiu
                $usuari->update(['actiu' => false]);
                $request->session()->flash('mensaje', 'L\'usuari no es pot eliminar ja que té dades relacionades, és posa en inactiu.');
            } else {
                // Si no té dades relacionades, esborra l'usuari definitivament
                $usuari->delete();
                $request->session()->flash('mensaje', 'L\'usuari s\'ha esborrat correctament.');
            }
        }
        catch (QueryException $ex)
        {
            $mensaje = Utilitat::errorMessage($ex);
            $request->session()->flash('error', $mensaje);
        }

        return redirect()->action([UsuarisController::class, 'index']);
    }


    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $nom_usuari = $request->input('nom_usuari');
        $contrasenya = $request->input('contrasenya');

        $user = Usuaris::where('nom_usuari', $nom_usuari)->first();

        if ($user != null && Hash::check($contrasenya, $user->contrasenya)) {
            Auth::login($user);
            $response = redirect('/home');
        } else {
            $request ->session()->flash('error', 'Usuari o contrasenya incorrectes.');
            $response = redirect('/login')->withInput();
        }
        return $response;
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    // Recupera ID per saber quin és l'usuari
    public function recuperarIdUsuari()
    {
        return response()->json(["id"=>Auth::user()->id],200);
    }

    // Recupera el tipus per saber de quin tipus és l'usuari
    public function recuperarTipusUsuari()
    {
        return response()->json(["tipus"=>Auth::user()->tipus_usuaris_id],200);
    }
}
