@extends('layouts.principalLogin')

@section('titol', 'Nou usuari')

@section('content')
<div class="card my-4">
    <div class="card-header">
        <h3>Nou usuari</h3>
    </div>
    <div class="card-body">
        <form action="{{ action([App\Http\Controllers\UsuarisController::class, 'store']) }}" method="POST">
            @csrf

            <div class="row my-3">
                <div class="col">
                    <label for="nom">Nom:</label>
                    <input type="text" class="form-control" name="nom" id="nom" autofocus value="{{ old('nom') }}">
                </div>
                <div class="col">
                    <label for="cognom">Cognom:</label>
                    <input type="text" class="form-control" name="cognom" id="cognom" value="{{ old('cognom') }}">
                </div>
                <div class="col">
                    <label for="nom_usuari">Nom usuari:</label>
                    <input type="text" class="form-control" name="nom_usuari" id="nom_usuari" value="{{ old('nom_usuari') }}">
                </div>
            </div>

            <div class="row my-3">
                <label for="correu" class="col-sm-2 col-form-label">Email: </label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" name="correu" id="correu" placeholder="exemple@politecnics.barcelona" value="{{ old('correu') }}">
                </div>
            </div>

            <div class="row my-3">
                <label for="contrasenya" class="col-sm-2 col-form-label">Contrasenya: </label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" name="contrasenya" id="contrasenya" value="{{ old('contrasenya') }}">
                </div>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tipus_usuaris_id" id="administrador" value="1">
                <label class="form-check-label" for="inlineRadio1">Administrador</label>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tipus_usuaris_id" id="professor" value="2">
                <label class="form-check-label" for="inlineRadio2">Professor</label>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="tipus_usuaris_id" id="alumne" value="3" checked>
                <label class="form-check-label" for="inlineRadio3">Alumne</label>
            </div>

            <div class="row my-3">
                <div class="col">
                    @if (old('actiu') == 'actiu')
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="actiu" id="actiu" value="actiu" checked>
                            <label class="form-check-label" for="actiu">
                                Actiu
                            </label>
                        </div>
                    @else
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="actiu" id="actiu" value="actiu">
                            <label class="form-check-label" for="actiu">
                                Actiu
                            </label>
                        </div>
                    @endif
                </div>
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button class="btn btn-primary" type="submit">
                    Acceptar
                    <i class="fa-solid fa-check"></i>
                </button>
                <a href="{{ url('usuaris/create') }}">
                    <button class="btn btn-primary" type="button">
                        Cancel·lar
                    </button>
                </a>
                <a href="{{ url('usuaris') }}">
                    <button class="btn btn-primary" type="button">
                        Sortir
                        <i class="fa-solid fa-x"></i>
                    </button>
                </a>
            </div>
        </form>
    </div>
</div>
@endsection