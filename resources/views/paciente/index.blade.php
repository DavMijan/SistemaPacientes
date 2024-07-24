@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Pacientes</h1>
    <div class="float-right">
        <a href="{{ route('pacientes.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
          {{ __('Crear Nuevo') }}
        </a>
      </div>
@stop

@section('content')
<table id="example" class="table table-striped table-bordered" style="width:100%">
    <div class="container-fluid">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>

									<th >Nombre</th>
									<th >Apellido</th>
                                    @role('superadmin')
                                    <th >Estado</th>
                                    @endrole
                                    @role('admin')
                                    <th >Estado</th>
                                    @endrole
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($pacientes as $paciente)

                                    @role('superadmin')

                                        <tr>
                                            <td>{{ ++$i }}</td>

										<td >{{ $paciente->nombre }}</td>
										<td >{{ $paciente->apellido }}</td>
                                        <td>
                                            @if ($paciente->estado == 1)
                                                Activo
                                            @else
                                                Inactivo
                                            @endif
                                        </td>

                                            <td>
                                                <form action="{{ route('pacientes.destroy',$paciente->id) }}" method="POST">
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modalver">
                                                        Ver
                                                    </button>

                                                    <a class="btn btn-sm btn-primary " href="{{ route('pacientes.show',$paciente->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Ver') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('pacientes.edit',$paciente->id) }}" ><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Anular/Activar') }}</button>

                                                    </form>
                                            </td>
                                        </tr>
                                        @endrole

                                    @role('admin')
                                        <tr>
                                            <td>{{ ++$i }}</td>

										<td >{{ $paciente->nombre }}</td>
										<td >{{ $paciente->apellido }}</td>
                                        <td>
                                            @if ($paciente->estado == 1)
                                                Activo
                                            @else
                                                Inactivo
                                            @endif
                                        </td>

                                            <td>
                                                <form action="{{ route('pacientes.destroy',$paciente->id) }}" method="POST">
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modalver">
                                                        Ver
                                                    </button>
                                                    <a class="btn btn-sm btn-primary " href="{{ route('pacientes.show',$paciente->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Ver') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('pacientes.edit',$paciente->id) }}" ><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Anular//Activar') }}</button>

                                                </form>
                                            </td>
                                        </tr>
                                        @endrole

                                    @role('digitador')
                                    @if ($paciente->estado == 1 )
                                        <tr>
                                            <td>{{ ++$i }}</td>

										<td >{{ $paciente->nombre }}</td>
										<td >{{ $paciente->apellido }}</td>



                                            <td>
                                                <form action="{{ route('pacientes.destroy',$paciente->id) }}" method="POST">
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modalver">
                                                        Ver
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endif
                                        @endrole
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $pacientes->links() !!}
            </div>
        </div>
    </div>

    <div class="modal fade" id="Modalver" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Paciente</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('paciente.show')
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>



@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">

@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>
    <script>
    $('#example').DataTable({
        responsive:true
    });
    </script>
@stop


