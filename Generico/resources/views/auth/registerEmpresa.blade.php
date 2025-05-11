@extends('layouts.appMaster')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark text-white">{{ __('Registrar Empresas') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('registra_empresa') }}">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <label for="Nombre"><b>Nombre</b></label>
                                    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}">
                                    @error('nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="Representante"><b>Representante</b></label>
                                    <input type="text" name="representante" class="form-control @error('representante') is-invalid @enderror" value="{{ old('representante') }}">
                                    @error('representante')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="Correo"><b>Correo</b></label>
                                    <input type="text" name="correo" class="form-control @error('correo') is-invalid @enderror" value="{{ old('correo') }}">
                                    @error('correo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="RFC"><b>RFC</b></label>
                                    <input type="text" name="rfc" class="form-control @error('rfc') is-invalid @enderror" value="{{ old('rfc') }}">
                                    @error('rfc')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="Dirección"><b>Dirección</b></label>
                                    <input type="text" name="direccion" class="form-control @error('direccion') is-invalid @enderror" value="{{ old('direccion') }}">
                                    @error('direccion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="Teléfono"><b>Teléfono</b></label>
                                    <input type="phone" name="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono') }}" id="telefono" maxlength="14"
                                        oninput="formatearTelefono(this)" placeholder="0000000000">
                                    @error('telefono')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="vigencia"><b>vigencia</b></label>
                                    <select name="vigencia" id="vigencia" class="form-control select2 @error('vigencia') is-invalid @enderror" value="{{ old('vigencia') }}">
                                        <option value="">Selecciona una vigencia</option>
                                        @foreach ($vigencias as $vigencia)
                                            <option value="{{ $vigencia->id }}">{{ $vigencia->tipo_vigencia }}</option>
                                        @endforeach
                                    </select>
                                    @error('vigencia')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="Estatus"><b>Estatus</b></label>
                                    <select name="estatus" id="estatus" class="form-control select2 @error('estatus') is-invalid @enderror" value="{{ old('estatus') }}">
                                        <option value="">Selecciona una opcion...</option>
                                        <option value="1">Activa</option>
                                        <option value="0">Inactiva</option>
                                    </select>
                                    @error('estatus')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="Estatus"><b>Tipo de negocio</b></label>
                                    <select name="id_tipo_negocio" id="id_tipo_negocio" class="form-control select2 @error('id_tipo_negocio') is-invalid @enderror" value="{{ old('id_tipo_negocio') }}">
                                        <option value="">Selecciona una opcion...</option>
                                        @foreach ($negocios as $negocio)
                                            <option value="{{ $negocio->id }}">{{ $negocio->negocio }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_tipo_negocio')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row justify-content-center mt-5">
                                <div class="col-6 col-md-3">
                                    <button type="submit" class="btn btn-dark">
                                        {{ __('Registrar Empresa') }}
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

        function formatearTelefono(input) {
            let valor = input.value.replace(/\D/g, ''); // Eliminar no numéricos

            // Limitar a 10 dígitos
            if (valor.length > 10) {
                valor = valor.slice(0, 10);
            }
            // Aplicar formato: (123) 456-7890
            if (valor.length > 6) {
                input.value = `(${valor.slice(0, 3)}) ${valor.slice(3, 6)}-${valor.slice(6)}`;
            } else if (valor.length > 3) {
                input.value = `(${valor.slice(0, 3)}) ${valor.slice(3)}`;
            } else if (valor.length > 0) {
                input.value = `(${valor}`;
            }
        }
    </script>
@endsection
