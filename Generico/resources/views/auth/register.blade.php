@extends('layouts.appMaster')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark text-white">{{ __('Registrar Usuarios') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <label for="name" class="text-md-end">{{ __('Name') }}</label>
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="email" class="col-form-text-md-end">{{ __('Correo') }}</label>

                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-6">
                                    <label for="password" class="col-form-label text-md-end">{{ __('Contraseña') }}</label>

                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-6">
                                    <label for="password-confirm"
                                        class="col-form-label text-md-end">{{ __('Confirmar Contraseña') }}</label>

                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>

                            <div class="col-12 col-md-6">
                                <label for="empresa" class="col-form-label text-md-end">{{ __('Empresa') }}</label>
                                <select class="form-control select2" name="id_empresa" id="id_empresa">
                                    @foreach ($empresas as $e )
                                        <option value="{{$e->id}}">{{$e->nombre_empresa}}</option>
                                    @endforeach
                                </select>

                                @error('id_empresa')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="rol" class="col-form-label text-md-end">{{ __('Rol') }}</label>
                                <select class="form-control select2" name="id_rol" id="id_rol">
                                    @foreach ($roles as $r )
                                        <option value="{{$r->id}}">{{$r->rol}}</option>
                                    @endforeach
                                </select>

                                @error('id_rol')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="id_estatus" class="col-form-label text-md-end">{{ __('Estatus') }}</label>
                                <select class="form-control select2" name="id_estatus" id="id_estatus">
                                    @foreach ($estatus as $es )
                                        <option value="{{$es->id}}">{{$es->nombre_estatus}}</option>
                                    @endforeach
                                </select>

                                @error('id_estatus')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="telefono" class="col-form-text-md-end">{{ __('Télefono') }}</label>

                                <input id="telefono" type="text"
                                    class="form-control @error('telefono') is-invalid @enderror" name="telefono"
                                    value="{{ old('telefono') }}" required autocomplete="telefono"
                                    maxlength="10"
                                    pattern="^[1-9][0-9]{9}$" 
                                    title="Debe ser un número de 10 dígitos, sin símbolos y no empezar con 0.">

                                @error('telefono')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="direccion" class="col-form-text-md-end">{{ __('Dirección') }}</label>

                                <input id="telefono" type="phone"
                                    class="form-control @error('direccion') is-invalid @enderror" name="direccion"
                                    value="{{ old('direccion') }}" required autocomplete="direccion">

                                @error('direccion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                            <div class="row justify-content-center pt-5">
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Registrar Usuario') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: 'Selecciona una opcion',
                allowClear: true,
                width: '100%' // Asegura que se adapte al contenedor
            });
        });
    </script>
@endsection
