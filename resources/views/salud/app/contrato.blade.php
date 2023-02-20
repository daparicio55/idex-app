@extends('layouts.saludapp')
@section('titulo','Salud APP')
@section('css')
<style>
    .abs-center {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    }
</style>
@stop
@section('contenido')
{!! Form::open(['route'=>'salud.app.store','method'=>'post']) !!}
{!! Form::hidden('dni', $estudiante->postulante->cliente->dniRuc, [null]) !!}
{!! Form::hidden('fecha', $estudiante->postulante->fechaNacimiento, [null]) !!}
{!! Form::hidden('estudiante_id', $estudiante->id, [null]) !!}
{!! Form::hidden('contrato', 1, [null]) !!}
<div class="container abs-center">
    <div class="d-flex mx-2 justify-content-center align-items-center">
        <div class="row">
            <div class="col-sm-11 p-2 shadow-sm border rounded-5 border-primary">
            <div class="row">
                <div class="col-sm-10 mt-4">
                    <h4><b><i class="fas fa-school text-primary"></i> Bienvenida I.E.S.T.P. Perú Japón</b></h4>
                    <i class="fas fa-medal"></i><small class="fst-italic" id="lema"> la unidad es la medalla que nos distingue..</small>    
                </div>
                <div class="col-sm-2 mt-2">
                    <a class="btn btn-outline-primary" id="esp">ESPAÑOL</a>
                    <a class="btn btn-outline-success" id="awa">AWAJUN</a>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-sm-12 px-5">
                    <div id="contrato_esp">
                        <p style="text-align: justify">
                            Yo, en mi condición de paciente, autorizo al Personal y/o del IDEX Perú Japón, 
                            a practicar los procedimientos de:
                        </p>
                        <ul>
                            <li>Tamizaje de Toma de muestra Sanguínea. /Valoración antropométrica/ Signos Vitales.</li>
                            <li>Exámenes de Laboratorio de:</li>
                            <li>Glucosa, Triglicéridos, Colesterol, HDL, LDL, Hemoglobina, Hematocrito.</li>
                            <li>Reevaluación.</li>
                        </ul>
                        <p style="text-align: justify">
                        Conocedor de la intensión de realizar una investigación “Herramienta informática con enfoque intercultural para seguimiento de estudiantes del IDEX 2022”, me comprometo a ser partícipe de todas las actividades que involucre las intervenciones de esta herramienta denominada IDEX-PJ.
                        </p>
                        <p style="text-align: justify">
                        Finalmente autorizo que durante el procedimiento el cual soy sometido, según sea el caso se puedan utilizar técnicas e instrumentos que garanticen evidencia científica y pedagógica porque también entiendo que el IDEX es una institución respaldada 
                        por docentes que trabajan con personal de salud en formación, capacitación y entrenamiento.
                        </p>
                        <p style="text-align: justify">
                            En forma voluntaria y en pleno uso de mis facultades mentales, físicas, y de mi entendimiento, libre de coerción o alguna otra influencia indebida y habiendo sido debidamente informado sobre las actividades de la presente Herramienta Informática, por lo que firmo el presente consentimiento informado entendiendo las declaraciones arriba descritas.
                        </p>
                        <p style="text-align: right" class="text-success">
                            Dr. Manuel Jesús Quispe Narváez	- CEP 67230
                        </p>
                    </div>                  
                    
{{-- **********awajun****************** --}}
                    <div id="contrato_awa" style="display: none">
                        <p style="text-align: justify">
                            Wi, ampímatin asan, shinchin suwajai IDEX Perú japon aentsjin takanuna, ampimaku takatai ainanuna emati tusan:
                        </p>
                        <ul>
                            <li>Tamiznum apugmau numpa jigmauwa nunú / yaá wegantauwaita manikiamu / iyashish pégkejashit diyamu</li>
                            <li>Laboratorionum dinnastatanú:</li>
                            <li>Numpa yumiskaji, numpanum wiya diyamu, numpa wiyají, HDL, LDL, numpa, numpa shinchijí.</li>
                        </ul>
                        <p style="text-align: justify">
                            Dekaku ajai juu takat aiknanuna “ujanika takamua nuna inía papín aujai nuna puyatjus diyamuanunú IDEX 2022”, ashí takak aikatna nunuig tuké pujuttajai, nuna dekamtikakajai, juu ujanika takamu IDEX PJ nunuig.                    
                        </p>
                        <p style="text-align: justify">
                            Amuakum shinchin suwajai, takat emamunum wi pachitkau asan, yachamsa takat antsag wají takatai ainanunag mina iyashjuin tatastinme tusan, nunú yachamsa takat antsag augmaunun pachitkau asa, waa tamash IDEX makichik institución ayamjuka shinchimtikamui, jintinkagtin aina dukan takainawai ampijattan jintin aidau asa.                    
                        </p>
                        <p style="text-align: justify">
                            Wiki anenmansan, anentaimu, buchitu antsanuk antau asan, tikish chicam emesmainanú, shig ujakmau takat ematnanunú juu ujanika takamua nunú, nudui juna papin tsentsajai, yakií aganmau nuna antuku asan.                    
                        </p>
                        <p style="text-align: right" class="text-success">
                            Dr. Manuel Jesús Quispe Narváez	- CEP 67230
                        </p>
                    </div>     
                </div>
            </div>
            </div>  
            <div class="d-grid mb-5">
                <button class="btn btn-primary btn-lg fw-bold" id="btnIngresar" type="submit">
                    <i class="fas fa-check"></i> <span id="si">Acepto los terminos</span>
                </button>
                <a href="{{ route('salud.app.index') }}" id="btnSalir" class="btn btn-danger mt-2 btn-lg fw-bold" id="btnIngresar">
                    <i class="fas fa-times"></i> <span id="no">Rechazo los terminos</span>
                </a>
            </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
@stop
@section('js')
<script>
    const esp = document.getElementById('esp');
    const awa = document.getElementById('awa');
    let lema = document.getElementById('lema');
    let contrato_esp = document.getElementById('contrato_esp');
    let contrato_awa = document.getElementById('contrato_awa');
    let si = document.getElementById('si');
    let no = document.getElementById('no');
    esp.addEventListener('click',function(){
        lema.innerHTML="la unidad es la medalla que nos distingue..";
        contrato_esp.style.display="block";
        contrato_awa.style.display="none";
        si.innerHTML="Acepto los terminos";
        no.innerHTML="Rechazo los terminos";
        //contrato.innerHTML="La presente iniciativa nace en la investigación denominada: herramienta informática con enfoque intercultural para seguimiento de los estudiantes de un instituto superior tecnológico Perú Japón, 2022, la misma que mantiene como objetivo principal: determinar la relación de una herramienta informática con enfoque intercultural para seguimiento de los estudiantes de un Instituto Superior Tecnológico Perú Japón, 2022, planteando el reaprovechamiento del uso de las tecnologías digitales  y el fomento de la interculturalidad en nuestra casa de estudios siendo modelo a todas las instituciones educativas de nuestro País. Proponemos modelos de apertura de oportunidades, con aumento de la productividad, eficiencia de las actividades humanas, tomar decisiones acertadas y reducción de posibilidad de errores.";
    });
    awa.addEventListener('click',function(){
        lema.innerHTML= "juttí ijunmauwa nú iínag íman emapawai..";
        contrato_esp.style.display="none";
        contrato_awa.style.display="block";
        si.innerHTML="ayu, papínak tsentsaktatjai";
        no.innerHTML="ayu, papínak tsentsaktatjai";
        //contrato.innerHTML = "Juu takatak nagkamnae wají autusa diyamu daáji: “herramienta informática con enfoque intercultural para seguimiento de los estudiantes de un instituto superior tecnológico Perú Japón, 2022”, aántsag émamkemas umigtatamujin: “determinar la relación de una herramienta informática con enfoque intercultural para seguimiento de los estudiantes de un Instituto Superior Tecnológico Perú Japón, 2022”, tecnologías digitales tawa nuunú awagki takaku aántsag interculturalidad iína jeén, papií augtainum augmatku, íina nugkee País taji nui instituciones educativas ayaá dushakam juna takatan diísa unuimagtinme tusa. Taji nuka, takat diísa emamaina nú, takamain ayanú ujantinme tamauwa nú pachisa, wají juwamua nú dukap awagmaunum, emamkesa takat aents takatai ainanui, shiíg anentaimja umiamu antsag dewamaina nú ujumak awasatatamau.";
    });
</script>
@stop