@extends('layouts.principalLogin')

@section('content')

@include('partials.mensaje')

<div class="card my-3">
        <div class="card-body">
            <h5 class="card-title">Buscar</h5>
            <form action="{{ action([App\Http\Controllers\UsuarisController::class, 'index']) }}">
                <div class="form" style="display: flex; align-items: center;">
                    <div class="col1">
                        @if (old('actiuBuscar') == 'actiu')
                            <div class="custom-control custom-checbox">
                                <input type="checkbox" class="custom-control-input" id="actiuBuscar" name="actiuBuscar"
                                    value="actiu" checked />
                                <label class="custom-control-label" for="actiuBuscar">Actiu</label>
                            </div>
                        @else
                            <div class="custom-control custom-checbox">
                                <input type="checkbox" class="custom-control-input" id="actiuBuscar" name="actiuBuscar"
                                    value="actiu" />
                                <label class="custom-control-label" for="actiuBuscar">Actiu</label>
                            </div>
                        @endif
                    </div>
                    <div class="col-1">
                        <button type="submit" class="btn btn-secondary">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nom usuari</th>
                <th scope="col">Contrasenya</th>
                <th scope="col">Correu</th>
                <th scope="col">Nom</th>
                <th scope="col">Cognom</th>
                <th scope="col">Actiu</th>
                <!-- <th scope="col">Tipus</th> -->
            </tr>
        </thead>
        <tbody>
        @foreach ($usuaris as $usuari)
            <tr>
                <td>{{ $usuari->nom_usuari }}</td>
                <td>************</td>
                <td>{{ $usuari->correu }}</td>
                <td>{{ $usuari->nom }}</td>
                <td>{{ $usuari->cognom }}</td>
                <td>
                    @if ($usuari->actiu)
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="actiu" name="actiu" value="actiu" checked disabled />
                        <label class="custom-control-label" for="actiu"></label>
                    </div>
                    @else
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="actiu" name="actiu" value="actiu" disabled />
                        <label class="custom-control-label" for="actiu"></label>
                    </div>
                    @endif
                </td>
                <td>
                    <form class="float-right ml-1" action="{{ action([App\Http\Controllers\UsuarisController::class, 'destroy'], ['usuari' => $usuari->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">
                            Esborrar
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </form>

                    <form action="{{ action([App\Http\Controllers\UsuarisController::class, 'edit'], ['usuari' => $usuari->id]) }}" class="float-right">
                        <button class="btn btn-sm btn-secondary">
                            Editar
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                    </form>

                    <form action="{{ action([App\Http\Controllers\UsuarisController::class, 'editPassword'], ['usuari' => $usuari->id]) }}" class="float-right">
                    <button class="btn btn-sm btn-warning me-3" style="width: 30px height: 50px;">
                        Canviar contrasenya
                        <i class="fa-solid fa-key"></i>
                    </button>
                </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    {{ $usuaris->links() }}

    <a href="{{ url('usuaris/create') }}" class="btn btn-primary btn-float-afegir"><i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Nou usuari</a>

@endsection
