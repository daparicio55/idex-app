@extends('salud.app.v2.layouts.main')
@section('page-header')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    @if (Auth::user()->hasRole('Bolsa User'))
        <h1 class="h3 mb-0 text-gray-800 text-center">{{ Auth::user()->ucliente->cliente->postulaciones[0]->carrera->nombreCarrera }}</h1>
        <small class="text-center d-block">{{ Auth::user()->ucliente->cliente->postulaciones[0]->admisione->nombre }}</small>    
    @endif
</div>
@endsection
@section('page-content')
    @error('telefono')
        <div class="alert alert-danger mt-1 mb-1 pt-0 pb-0">
            <small>{{ $message }}</small>
        </div>
    @enderror
    <x-alert/>
<div class="row">
    <div class="col-lg-6 mb-4">
        {!! Form::open(['route'=>'salud.app.profile.update','method'=>'PUT']) !!}
        <div class="card shadow mb-2 border-left-primary">
            <div class="card-header">
                Datos Personales
            </div>
            <div class="card-body">
                <div class="text-center">
                    <img class="img-fluid px-3 px-sm-4" style="width: 25rem;" src="{{ Auth::user()->adminlte_image() }}" alt="...">
                </div>
                <div class="form-group">
                    @if (Auth::user()->hasRole('Bolsa User'))
                        <label class="mt-2">F. Nacimiento</label>
                        <input type="text" class="form-control" value="{{ date('d/m/Y',strtotime(Auth::user()->ucliente->cliente->postulaciones[0]->fechaNacimiento)) }}" readonly>                            
                    @endif

                    <label class="mt-2">DNI</label>
                    @if (Auth::user()->hasRole('Bolsa User'))
                        <input type="text" class="form-control" value="{{ Auth::user()->ucliente->cliente->dniRuc }}" readonly>
                    @endif
                    @if (Auth::user()->hasRole('Docentes'))
                        <input type="text" class="form-control" value="{{ Auth::user()->personale->dni }}" readonly>
                    @endif

                    <label class="mt-2">Telefono</label>
                    @if (Auth::user()->hasRole('Bolsa User'))
                        <input type="text" class="form-control" name="telefono" value="{{ Auth::user()->ucliente->cliente->telefono }}">
                    @endif
                    @if (Auth::user()->hasRole('Docentes'))
                        <input type="text" class="form-control" value="{{ Auth::user()->personale->telefono }}" readonly>
                    @endif

                    <label class="mt-2">Correo Electrónico</label>
                    @if (Auth::user()->hasRole('Bolsa User'))
                        <input type="text" class="form-control" value="{{ Auth::user()->ucliente->cliente->email }}" readonly>
                    @endif
                    @if (Auth::user()->hasRole('Docentes'))
                        <input type="text" class="form-control" value="{{ Auth::user()->personale->correoInstitucional }}" readonly>
                    @endif
                    
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    Actualizar
                </button>
            </div>
        </div>
        {!! Form::close() !!}
        <div class="card shadow mb-4 border-left-primary">
            <div class="card-header bg-gray-600 text-white">
                Perfil Médico
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for=""><i class="fas fa-balance-scale"></i> Peso</label>
                    @if (Auth::user()->hasRole('Bolsa User'))
                        @if(isset(Auth::user()->ucliente->cliente->postulaciones[0]->estudiante->acampanias[0]->nutri_peso))
                            <input type="text" class="form-control" value="{{ Auth::user()->ucliente->cliente->postulaciones[0]->estudiante->acampanias[0]->nutri_peso }} Kg." readonly>
                        @endif
                    @endif
                    @if (Auth::user()->hasRole('Docentes'))
                        @if(isset(Auth::user()->acampanias[0]->nutri_peso))
                            <input type="text" class="form-control" value="{{ Auth::user()->acampanias[0]->nutri_peso }} Kg." readonly>
                        @endif
                    @endif
                    <label for="" class="mt-2"><i class="fas fa-ruler-vertical"></i> Talla</label>
                    @if (Auth::user()->hasRole('Bolsa User'))
                        @if(isset(Auth::user()->ucliente->cliente->postulaciones[0]->estudiante->pmedico->nutri_talla))
                            <input type="text" class="form-control" value="{{ Auth::user()->ucliente->cliente->postulaciones[0]->estudiante->pmedico->nutri_talla }} cm." readonly>
                        @endif
                    @endif
                    @if (Auth::user()->hasRole('Docentes'))
                        @if(isset(Auth::user()->acampanias[0]->nutri_talla))
                            <input type="text" class="form-control" value="{{ Auth::user()->acampanias[0]->nutri_talla }} cm." readonly>
                        @endif
                    @endif
                    <label for="" class="mt-2"><i class="fas fa-circle-notch"></i> Perímetro Abdominal</label>
                    @if (Auth::user()->hasRole('Bolsa User'))
                        @if(isset(Auth::user()->ucliente->cliente->postulaciones[0]->estudiante->acampanias[0]->nutri_perimetro))
                            <input type="text" class="form-control" value="{{ Auth::user()->ucliente->cliente->postulaciones[0]->estudiante->acampanias[0]->nutri_perimetro }} cm." readonly>
                        @endif
                    @endif
                    @if (Auth::user()->hasRole('Docentes'))
                        @if(isset(Auth::user()->acampanias[0]->nutri_perimetro))
                            <input type="text" class="form-control" value="{{ Auth::user()->acampanias[0]->nutri_perimetro }} cm." readonly>
                        @endif
                    @endif
                    <label for="" class="mt-2"><i class="fas fa-syringe"></i> Grupo Sanguineo</label>
                    @if (Auth::user()->hasRole('Bolsa User'))
                        @if(isset(Auth::user()->ucliente->cliente->postulaciones[0]->estudiante->pmedico->lab_gs))
                            <input type="text" class="form-control" value="{{ Auth::user()->ucliente->cliente->postulaciones[0]->estudiante->pmedico->lab_gs }}" readonly>
                        @endif
                    @endif
                    @if (Auth::user()->hasRole('Docentes'))
                        @if(isset(Auth::user()->acampanias[0]->lab_gs))
                            <input type="text" class="form-control" value="{{ Auth::user()->acampanias[0]->lab_gs }}" readonly>
                        @endif
                    @endif
                    <label for="" class="mt-2"><i class="fas fa-prescription"></i> Factor Sanguineo</label>
                    @if (Auth::user()->hasRole('Bolsa User'))
                        @if(isset(Auth::user()->ucliente->cliente->postulaciones[0]->estudiante->pmedico->lab_fs))
                            <input type="text" class="form-control" value="{{ Auth::user()->ucliente->cliente->postulaciones[0]->estudiante->pmedico->lab_fs }}" readonly>
                        @endif
                    @endif
                    @if (Auth::user()->hasRole('Docentes'))
                        @if(isset(Auth::user()->acampanias[0]->lab_fs))
                            <input type="text" class="form-control" value="{{ Auth::user()->acampanias[0]->lab_fs }}" readonly>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script src="{{ asset('js/main.js') }}"></script>
@endsection