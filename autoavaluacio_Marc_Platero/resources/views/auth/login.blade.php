@extends('layouts.principalLogin')

@section('content')

@include('partials.mensaje')

<div class="d-flex justify-content-center align-items-center">
    <div class="col-md-6 col-lg-4">
        <div class="text-center mb-5">
            <h1 class="font-weight-bold" style="font-size: 50px;">Autoavaluació</h1>
        </div>
        <div class="card shadow-lg">
            <div class="card-header text-center bg-primary text-white">
                <h2>Login</h2>
            </div>
            <div class="card-body p-4">
                <form action="{{ action([App\Http\Controllers\UsuarisController::class,'login']) }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="nom_usuari" class="form-label">Nom usuari</label>
                        <input type="text" class="form-control" id="nom_usuari" name="nom_usuari" autofocus value="{{ old('nom_usuari') }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="contrasenya" class="form-label">Contrasenya</label>
                        <input type="password" class="form-control" id="contrasenya" name="contrasenya">
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ url('/') }}" class="btn btn-secondary me-2"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i> Aceptar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
