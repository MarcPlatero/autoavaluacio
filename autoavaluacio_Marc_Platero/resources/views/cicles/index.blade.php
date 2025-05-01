@extends('layouts.principalLogin')

@section('content')
<div class="card my-3">
        <div class="card-body">
            <h5 class="card-title">Buscar</h5>
            <form action="{{ action([App\Http\Controllers\CiclesController::class, 'index']) }}">
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
                <th scope="col">Sigles</th>
                <th scope="col">Descripció</th>
                <th scope="col">Actiu</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cicles as $cicle)
                <tr>
                    <td>{{ $cicle->sigles }}</td>
                    <td>{{ $cicle->descripcio }}</td>
                    <td>
                        @if ($cicle->actiu)
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
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
