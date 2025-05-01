@extends('layouts.principalLogin')

@section('titol', 'Canviar contrasenya')

@section('content')
    <div class="card my-4">
        <div class="card-header">
            <h3>Canviar contrasenya</h3>
        </div>
        <div class="card-body">
            <form action="{{ action([App\Http\Controllers\UsuarisController::class, 'updatePassword'], ['usuari' => $usuari->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row my-3">
                    <label for="contrasenya" class="col-sm-2 col-form-label">Nova contrasenya: </label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="contrasenya" id="contrasenya" required>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-primary me-md-2" type="submit">
                        Canviar
                        <i class="fa-solid fa-check"></i>
                    </button>
                    <a href="{{ url('usuaris') }}">
                        <button class="btn btn-primary" type="button">
                            Cancel·lar
                            <i class="fa-solid fa-x"></i>
                        </button>
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
