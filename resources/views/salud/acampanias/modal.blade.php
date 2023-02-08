<!-- Modal -->
<div class="modal fade" id="modal-delete-{{ $atencione->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    {!! Form::open(['route'=>['salud.acampanias.destroy',$atencione->id],'method'=>'delete']) !!}
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger">
                    <i class="fas fa-exclamation"></i>
                    Confirmar Eliminacion
                </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                Esta seguro de que desea eliminar la atencion <b class="text-primary">#{{ ceros($atencione->numero) }}</b> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
                <button type="submit" class="btn btn-danger"><i class="fa fa-save"></i> Eliminar</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>

<!-- Button trigger modal -->
@php
    use Carbon\Carbon;
@endphp
<!-- Modal -->
<div class="modal fade" id="modal-show-{{ $atencione->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">
                <i class="fas fa-laptop-medical"></i> Atencion <b>#{{ ceros($atencione->numero) }}</b>
            </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="card card-dark">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-12 col-md-8">
                            <p class="card-title">
                                <b class="text-uppercase">{{ $atencione->estudiante->postulante->cliente->apellido }},</b>
                                <span class="text-capitalize">{{ strtolower($atencione->estudiante->postulante->cliente->nombre) }}</span>
                            </p>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            {!! Form::select('campania_id', $campanias, $atencione->campanias, ['class'=>'form-control text-right','readonly']) !!}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 mb-2">
                            <h4 class="card-title text-danger">
                                <b><i class="fas fa-heart"></i> Signos Vitales - Enfermeria...</b>
                            </h4>
                        </div>
                        <div class="col-sm-12 col-md-2">
                            {!! Form::label('vitales_temperatura', 'Temperatura', [null]) !!}
                            {!! Form::number('vitales_temperatura', $atencione->vitales_temperatura, ['class'=>'form-control','step'=>'0.01','readonly']) !!}                
                        </div>
                        <div class="col-sm-12 col-md-2">
                            {!! Form::label('vitales_fc', 'F. Cardiaca', [null]) !!}
                            {!! Form::number('vitales_fc', $atencione->vitales_fc, ['class'=>'form-control','step'=>'0.01','readonly']) !!}                
                        </div>
                        <div class="col-sm-12 col-md-2">
                            {!! Form::label('vitales_fr', 'F. Respiratoria', [null]) !!}
                            {!! Form::number('vitales_fr', $atencione->vitales_fr, ['class'=>'form-control','step'=>'0.01','readonly']) !!}                
                        </div>
                        <div class="col-sm-12 col-md-2">
                            {!! Form::label('vitales_saturacion', 'Sat. Oxígeno', [null]) !!}
                            {!! Form::number('vitales_saturacion', $atencione->vitales_saturacion, ['class'=>'form-control','step'=>'0.01','readonly']) !!}                
                        </div>
                        <div class="col-sm-12 col-md-2">
                            {!! Form::label('vitales_sys', 'P.A. Sistólica', [null]) !!}
                            {!! Form::number('vitales_sys', $atencione->vitales_sys, ['class'=>'form-control','step'=>'0.01','readonly']) !!}                
                        </div>
                        <div class="col-sm-12 col-md-2">
                            {!! Form::label('vitales_dia', 'P.A. Diastólica', [null]) !!}
                            {!! Form::number('vitales_dia', $atencione->vitales_dia, ['class'=>'form-control','step'=>'0.01','readonly']) !!}                
                        </div>
                        <div class="col-sm-12 mb-2 mt-3">
                            <h4 class="card-title text-success">
                                <b><i class="fas fa-brain"></i> Mental - Psicologia...</b>
                            </h4>
                        </div>
                        <div class="col-sm-12 mb-2 mt-3">
                            <h4 class="card-title text-info">
                                <b><i class="fas fa-utensils"></i> Nutricional - Area Nutrición...</b>
                            </h4>
                        </div>
                        <div class="col-sm-12 col-md-2">
                            {!! Form::label('nutri_peso', 'Peso Kg.', [null]) !!}
                            {!! Form::number('nutri_peso', $atencione->nutri_peso, ['class'=>'form-control','step'=>'0.01','onChange="imc()"','readonly']) !!}                
                        </div>
                        <div class="col-sm-12 col-md-2">
                            {!! Form::label('nutri_talla', 'Talla cm.', [null]) !!}
                            {!! Form::number('nutri_talla', $atencione->estudiante->pmedico->nutri_talla, ['class'=>'form-control','step'=>'0.01','onChange="imc()"','readonly']) !!}                
                        </div>
                        <div class="col-sm-12 col-md-2">
                            {!! Form::label('nutri_perimetro', 'Per. Abdominal', [null]) !!}
                            {!! Form::number('nutri_perimetro', $atencione->nutri_perimetro, ['class'=>'form-control','step'=>'0.01','readonly']) !!}                
                        </div>
                        <div class="col-sm-12 col-md-2">
                            {!! Form::label('nutri_edad', 'Edad', [null]) !!}
                            {!! Form::number('nutri_edad', Carbon::parse($atencione->estudiante->postulante->fechaNacimiento)->age, ['readonly','class'=>'form-control','step'=>'0.01']) !!}                
                        </div>
                        @php
                            $pmetros = number_format($atencione->estudiante->pmedico->nutri_talla / 100,2,'.','');
                            $imc = number_format($atencione->nutri_peso  / ($pmetros * $pmetros),2,'.','');
                            //$imc = 11;
                        @endphp
                        <div class="col-sm-12 col-md-2">
                            {!! Form::label('nutri_imc', 'IMC', [null]) !!}
                            {!! Form::number('nutri_imc', $imc, ['readonly','class'=>'form-control','step'=>'0.01','readonly']) !!}                
                        </div>
                        <div class="col-sm-12 mb-2 mt-3">
                            <h4 class="card-title text-danger">
                                <b><i class="fas fa-flask"></i> Exámenes - Laboratório...</b>
                            </h4>
                        </div>
                        <div class="col-sm-12 col-md-2">
                            {!! Form::label('lab_glicemia', 'Glicemia', [null]) !!}
                            {!! Form::number('lab_glicemia', $atencione->lab_glicemia, ['class'=>'form-control','step'=>'0.01','readonly']) !!}                
                        </div>
                        <div class="col-sm-12 col-md-2">
                            {!! Form::label('lab_trigliceridos', 'Trigliceridos', [null]) !!}
                            {!! Form::number('lab_trigliceridos', $atencione->lab_trigliceridos, ['class'=>'form-control','step'=>'0.01','readonly']) !!}                
                        </div>
                        <div class="col-sm-12 col-md-2">
                            {!! Form::label('lab_colesterol', 'Colesterol', [null]) !!}
                            {!! Form::number('lab_colesterol', $atencione->lab_colesterol, ['class'=>'form-control','step'=>'0.01','readonly']) !!}                
                        </div>
                        <div class="col-sm-12 col-md-2">
                            {!! Form::label('lab_hdl', 'HDL', [null]) !!}
                            {!! Form::number('lab_hdl', null, ['class'=>'form-control','step'=>'0.01','readonly']) !!}                
                        </div>
                        <div class="col-sm-12 col-md-2">
                            {!! Form::label('lab_ldl', 'LDL', [null]) !!}
                            {!! Form::number('lab_ldl', null, ['class'=>'form-control','step'=>'0.01','readonly']) !!}                
                        </div>
                        <div class="col-sm-12 col-md-2">
                            {!! Form::label('lab_hto', 'Hematocrito', [null]) !!}
                            {!! Form::number('lab_hto', $atencione->lab_hto, ['class'=>'form-control','step'=>'0.01','readonly']) !!}                
                        </div>
                        <div class="col-sm-12 col-md-2">
                            {!! Form::label('lab_hemoglobina', 'Hemoglobina', [null]) !!}
                            {!! Form::number('lab_hemoglobina', $atencione->lab_hemoglobina, ['class'=>'form-control','step'=>'0.01','readonly']) !!}                
                        </div>
                        <div class="col-sm-12 col-md-2">
                            {!! Form::label('lab_gs', 'Gr. Sanguineo', [null]) !!}
                            @if(isset($atencione->estudiante->pmedico->lab_gs))
                                {!! Form::select('lab_gs', $gss, $atencione->estudiante->pmedico->lab_gs, ['class'=>'form-control','readonly']) !!}                    
                            @else
                            {!! Form::select('lab_gs', $gss, null, ['class'=>'form-control']) !!}   
                            @endif
                        </div>
                        <div class="col-sm-12 col-md-2">
                            {!! Form::label('lab_fs', 'Fac. Sanguineo', [null]) !!}
                            @if(isset($atencione->estudiante->pmedico->lab_fs))
                                {!! Form::select('lab_fs', $fss, $atencione->estudiante->pmedico->lab_fs, ['class'=>'form-control','readonly']) !!} 
                            @else
                            {!! Form::select('lab_fs', $fss, null, ['class'=>'form-control']) !!}    
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                <i class="far fa-times-circle"></i> Cerrar
            </button>
        </div>
      </div>
    </div>
  </div>


    
  <!-- Modal -->
  <div class="modal fade" id="modal-survey-{{ $atencione->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">
                    <i class="fas fa-poll-h"></i> Lista de Encuestas y Test Realizados.
                </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <th>#</th>
                        <th>Encuesta</th>
                        <th>Fecha</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach ($atencione->estudiante->surveys()->orderBy('id','desc')->get() as $key=>$survey )
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $survey->survey->name_es }}</td>
                                <td style="width: 100px">{{ date('d-m-Y',strtotime($survey->date)) }}</td>
                                <td>
                                    <a href="{{ route('salud.acampanias.show',$survey->id) }}" class="btn btn-primary">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
  </div>
