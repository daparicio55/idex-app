<div class="row">
    <div class="card col-lg-12">
        <div class="card-header">
            <h4><i class="far fa-calendar-alt"></i> Periodo de Matricula.</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    {!! Form::label('pmatricula_id', 'Periodo', [null]) !!}
                    {!! Form::select('pmatricula_id', $periodos, null, ['class'=>'form-control']) !!}
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('tipo', 'Tipo Matricula', [null]) !!}
                    {!! Form::select('tipo', $tipo, null, ['class'=>'form-control']) !!}
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    {!! Form::label('fecha', 'Fecha', [null]) !!}
                    {!! Form::date('fecha', null, ['class'=>'form-control','required']) !!}
                </div>
            </div>
        </div>
    </div>
</div>