@extends('adminlte::page')
@section('title', 'Accesos Estudiantes')

@section('content_header')
    <h1>Accesos de Estudiantes</h1>
@stop

@section('content')
@if (session('info'))
    <div class="alert alert-success" id='info'>
        <strong>{{session('info')}}</strong>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger" id='error'>
        <strong>{{session('error')}}</strong>
    </div>
@endif
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Email</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $key => $usuario)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>
                        <a data-toggle="modal" data-toggle="modal" data-target="#modalEmail-{{ $usuario->id }}" class="btn btn-warning" title="enviar correo de restablecimiento">
                            <i class="fas fa-mail-bulk"></i>
                        </a>
                        <a data-toggle="modal" data-toggle="modal" data-target="#modalDelete-{{ $usuario->id }}"  class="btn btn-danger">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                        {{-- @include('dashboard.administrador.estudiantes.modal') --}}
                        @include('accesos.estudiantes.modal')
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4">
                    {{ $usuarios->links() }}
                </td>
            </tr>
        </tfoot>
    </table>
</div>


@stop
@section('js')
    <script>
        $(document).ready(function(){
        setTimeout(() => {
            $("#info").hide();
        }, 12000);
        });
        $(document).ready(function(){
            setTimeout(() => {
            $("#error").hide();
        }, 12000);
        });
	</script>
@stop