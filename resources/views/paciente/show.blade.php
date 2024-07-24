
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Mostrar') }} Usuarios</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('pacientes.index') }}"> {{ __('Regresar') }}</a>
                        </div>
                    </div>
                    <div class="card-body bg-white">

                                <div class="form-group mb-2 mb20">
                                    <strong>Nombre:</strong>
                                    {{ $paciente->nombre }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Apellido:</strong>
                                    {{ $paciente->apellido }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Fechanac:</strong>
                                    {{ $paciente->fechanac }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Direccion:</strong>
                                    {{ $paciente->direccion }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Telefono:</strong>
                                    {{ $paciente->telefono }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Correo:</strong>
                                    {{ $paciente->correo }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Historial:</strong>
                                    {{ $paciente->historial }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Estado:</strong>
                                    @if ($paciente->estado == 1)
                                                    Activo
                                                @else
                                                    Inactivo
                                                @endif
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
