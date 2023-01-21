<?php

use App\Http\Controllers\AdmisioneAlternativaController;
use App\Http\Controllers\AdmisioneConfiguracionController;
use App\Http\Controllers\AdmisioneEstudiante;
use App\Http\Controllers\AdmisioneExoneradoController;
use App\Http\Controllers\AdmisioneOrdinarioController;
use App\Http\Controllers\AdmisionePostulanteController;
use App\Http\Controllers\AdmisioneReporteController;
use App\Http\Controllers\AdmisioneVacanteController;
use App\Http\Controllers\CargarNotaController;
use App\Http\Controllers\CepreCarnetController;
use App\Http\Controllers\CepreCruzeController;
use App\Http\Controllers\CepreEstudianteController;
use App\Http\Controllers\CeprePagoController;
use App\Http\Controllers\CepreReporteController;
use App\Http\Controllers\CepreSumativoAlternativaController;
use App\Http\Controllers\CepreSumativoCalificacioneController;
use App\Http\Controllers\CepreSumativoConfiguracionController;
use App\Http\Controllers\CepreSumativoConsolidadoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ColegioController;
use App\Http\Controllers\ConvalidacioneController;
use App\Http\Controllers\cvCapacitacionController;
use App\Http\Controllers\cvConocimientoController;
use App\Http\Controllers\cvController;
use App\Http\Controllers\cvEstudioController;
use App\Http\Controllers\cvExperienciaController;
use App\Http\Controllers\cvPersonalController;
use App\Http\Controllers\cvReporteController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\DeudaController;
use App\Http\Controllers\DocumentotipoController;
use App\Http\Controllers\EdocumentoController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\EstadisticaController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\EstudiantePEstudioController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\FdocumentoController;

use App\Http\Controllers\IformativoController;
use App\Http\Controllers\InsidenciaController;
use App\Http\Controllers\LicenciaController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\MatriculaDetalleController;
use App\Http\Controllers\MesaparteController;
use App\Http\Controllers\MformativoController;
use App\Http\Controllers\MoodleController;
use App\Http\Controllers\NominaController;
use App\Http\Controllers\OficinaController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermisoController;

use App\Http\Controllers\PmatriculaController;
use App\Http\Controllers\RdocumentoController;
use App\Http\Controllers\RegularizacioneController;
use App\Http\Controllers\RepositorioController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UasignadaController;
use App\Http\Controllers\UdidacticaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VerificacioneAvanzadoController;
use App\Http\Controllers\VerificacioneController;
use App\Models\cvPersonale;
use App\Models\Pmatricula;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',function(){
    return Redirect::to('inicio');
});
Route::get('/home',function(){
    return Redirect::to('inicio');
})->name('home');

Auth::routes(["register" => false]);
Route::resource('docentes/cvs',cvController::class)->names('docentes.cvs');
Route::resource('docentes/cv/experiencias',cvExperienciaController::class)->names('docentes.cv.experiencias');
Route::resource('docentes/cv/capacitaciones',cvCapacitacionController::class)->names('docentes.cv.capacitaciones');
Route::resource('docentes/cv/personales',cvPersonalController::class)->names('docentes.cv.personales');
Route::resource('docentes/cv/estudios',cvEstudioController::class)->names('docentes.cv.estudios');
Route::resource('docentes/cv/reportes',cvReporteController::class)->names('docentes.cv.reportes');
Route::resource('docentes/cv/conocimientos',cvConocimientoController::class)->names('docentes.cv.conocimientos');
//servicios de de hojas de vida
Route::get('/cv/{mail}',function($mail){
    $user = User::where('email','=',$mail)->first();
    $periodo = Pmatricula::orderBy('nombre','desc')->first();
    $personale = cvPersonale::where('user_id','=',$user->id)->first();
    return view('docentes.cv.show',compact('personale','periodo'));
})->name('cv');


Route::resource('sacademica/iformativos',IformativoController::class)->names('sacademica.iformativos');
Route::resource('sacademica/pmatriculas',PmatriculaController::class)->names('sacademica.pmatriculas');
Route::resource('sacademica/mformativos', MformativoController::class)->names('sacademica.mformativos');
Route::resource('sacademica/udidacticas',UdidacticaController::class)->names('sacademica.udidacticas');
Route::resource('sacademica/matriculas',MatriculaController::class)->names('sacademica.matriculas');
Route::resource('sacademica/matriculasdetalles',MatriculaDetalleController::class)
->names('sacademica.matriculasdetalles');
Route::resource('sacademica/nominas',NominaController::class)->names('sacademica.nominas');
Route::resource('sacademica/moodle',MoodleController::class)->names('sacademica.moodle');
Route::resource('sacademica/verificaciones',VerificacioneController::class)->names('sacademica.verificaciones');
Route::resource('sacademica/verificacionesas',VerificacioneAvanzadoController::class)->names('sacademica.verificacionesas');
Route::resource('sacademica/estadisticas', EstadisticaController::class)->names('sacademica.estadisticas');
Route::resource('sacademica/convalidaciones', ConvalidacioneController::class)->names('sacademica.convalidaciones');
Route::resource('sacademica/regularizaciones', RegularizacioneController::class)->names('sacademica.regularizaciones');
Route::resource('sacademica/estudiantes',EstudianteController::class)->names('sacademica.estudiantes');
Route::resource('sacademica/licencias',LicenciaController::class)->names('sacademica.licencias');
Route::resource('sacademica/cargarnotas',CargarNotaController::class)->names('sacademica.cargarnotas');
Route::resource('sacademica/uasignadas',UasignadaController::class)->names('sacademica.uasignadas');
/* rutas para students */
Route::resource('students',StudentController::class)->names('students');
/* fin ruta students */
Route::resource('tdocumentario/mesapartes',MesaparteController::class)->names('tdocumentario.mesapartes');
Route::resource('tdocumentario/rdocumentos',RdocumentoController::class)->names('tdocumentario.rdocumentos');
Route::resource('tdocumentario/edocumentos',EdocumentoController::class)->names('tdocumentario.edocumentos');
Route::resource('tdocumentario/fdocumentos',FdocumentoController::class)->names('tdocumentario.fdocumentos');
Route::get('tdocumentario/rdocumentos/recepcion/{id}',[RdocumentoController::class,'recepcion'])
->name('tdocumentario.rdocumentos.recepcion');



Route::resource('soporte/insidencias',InsidenciaController::class)->names('soporte.insidencias');
Route::resource('soporte/equipos',EquipoController::class)->names('soporte.equipos');
Route::resource('inicio', InicioController::class)->names('inicio');
Route::resource('accesos/permisos',PermisoController::class)->names('accesos.permisos');
Route::resource('accesos/roles', RoleController::class)->names('accesos.roles');
Route::resource('accesos/usuarios', UsuarioController::class)->names('accesos.usuarios');
Route::resource('accesos/oficinas', OficinaController::class)->names('accesos.oficinas');
Route::resource('ventas/servicios',ServicioController::class)->names('ventas.servicios');
Route::resource('ventas/clientes', ClienteController::class)->names('ventas.clientes');
Route::resource('ventas/ventas', VentaController::class)->names('ventas.ventas');
Route::resource('ventas/deudas', DeudaController::class)->names('ventas.deudas');

Route::resource('cepres/estudiantes', CepreEstudianteController::class)->names('cepres.estudiantes');
Route::resource('cepres/pagos', CeprePagoController::class)->names('cepres.pagos');
Route::resource('cepres/carnets',CepreCarnetController::class)->names('cepres.carnets');
Route::resource('cepres/reportes',CepreReporteController::class)->names('cepres.reportes');
Route::resource('cepres/cruzes',CepreCruzeController::class)->names('cepres.cruzes');
Route::resource('cepres/sumativos/configuraciones',CepreSumativoConfiguracionController::class)->names('cepres.sumativos.configuraciones');
Route::resource('cepres/sumativos/respuestas',CepreSumativoAlternativaController::class)->names('cepres.sumativos.respuestas');
Route::resource('cepres/sumativos/calificaciones',CepreSumativoCalificacioneController::class)->names('cepres.sumativos.calificaciones');
Route::resource('cepres/sumativos/consolidados',CepreSumativoConsolidadoController::class)->names('cepres.sumativos.consolidados');
Route::get('cepres/sumativos/calificaciones/normalizar/{id}',[CepreSumativoCalificacioneController::class,'normalizar'])
->name('cepres.sumativos.calificaciones.normalizar');
Route::post('cepres/sumativos/calificaciones/subircsv/{id}',[CepreSumativoCalificacioneController::class,'subircsv'])
->name('cepres.sumativos.calificaciones.subircsv');
Route::get('cepres/sumativos/calificaiones/resultados/{id}',[CepreSumativoCalificacioneController::class,'resultados'])
->name('cepres.sumativos.calificaciones.resultados');
/* exports */
Route::get('exports/nomina1',[ExportController::class,'nomina1'])
->name('exports.nomina1');
Route::get('exports/nomina2',[ExportController::class,'nomina2'])
->name('exports.nomina2');
/* fin exports */
Route::resource('administraciones/documentotipos',DocumentotipoController::class)->names('administraciones.documentotipos');
Route::resource('repositorios',RepositorioController::class)->names('repositorios');

Route::resource('admisiones/postulantes',AdmisionePostulanteController::class)->names('admisiones.postulantes');
Route::resource('admisiones/reportes',AdmisioneReporteController::class)->names('admisiones.reportes');
Route::resource('admisiones/configuraciones',AdmisioneConfiguracionController::class)->names('admisiones.configuraciones');
Route::resource('admisiones/vacantes',AdmisioneVacanteController::class)->names('admisiones.vacantes');
Route::resource('admisiones/exonerados',AdmisioneExoneradoController::class)->names('admisiones.exonerados');
Route::resource('admisiones/ordinarios',AdmisioneOrdinarioController::class)->names('admisiones.ordinarios');
Route::resource('admisiones/alternativas',AdmisioneAlternativaController::class)->names('admisiones.alternativas');
Route::resource('admisiones/estudiantes',AdmisioneEstudiante::class)->names('admisiones.estudiantes');
Route::get('admisiones/postulantes/anular/{id}',[AdmisionePostulanteController::class,'anular'])
->name('admisiones.postulantes.anular');
Route::post('admisiones/ordinarios/csv/{id}',[AdmisioneOrdinarioController::class,'subircsv'])
->name('admisiones.ordinarios.subircsv');
Route::post('admisiones/ordinarios/bonificacion/{id}',[AdmisioneOrdinarioController::class,'bonificaciones'])
->name('admisiones.ordinarios.bonificaciones');
Route::get('adminsiones/ordinarios/resultados/{id}',[AdmisioneOrdinarioController::class,'resultados'])
->name('admisiones.ordinarios.resultados');
Route::get('admisiones/ordinarios/bono/{id}',[AdmisioneOrdinarioController::class,'bono'])
->name('admisiones.ordinarios.bono');

//rutas APIs
Route::resource('colegios',ColegioController::class)->names('colegios');
Route::get('estudiantepestudio/dni/{dni}',[EstudiantePEstudioController::class,'buscardni'])
->where('dni','[0-9]+')->name('estudiantepestudio.dni');
Route::get('estudiantepestudio/datos/{id}',[EstudiantePEstudioController::class,'datos'])
->where('id','[0-9]+')->name('estudiantepestudio.datos');
Route::get('estudiantepestudio/unidades/{id}',[EstudiantePEstudioController::class,'unidades'])
->where('id','[0-9]+')->name('estudiantepestudio.unidades');
Route::get('estudiantepestudio/notas/',[EstudiantePEstudioController::class,'notas'])
->name('estudiantepestudio.notas');
//fin de rutas API

Route::get('ventas/deudas/imprimir/{id}',[DeudaController::class,'imprimir'])
->where('id','[0-9]+')->name('ventas.deudas.imprimir');
Route::get('ventas/deudas/pagar/{id}',[DeudaController::class,'pagar'])
->where('id','[0-9]+')->name('ventas.deudas.pagar');
Route::get('ventas/deudas/amortizar/{id}',[DeudaController::class,'amortizar'])
->where('id','[0-9]+')->name('ventas.deudas.amortizar');
Route::get('ventas/deudas/impriAmortizacion/{id}',[DeudaController::class,'impriAmortizar'])
->where('id','[0-9]+')->name('ventas.deudas.impriAmortizacion');
Route::get('ventas/ventas/imprimirv2/{id}',[VentaController::class,'imprimirv2'])->name('ventas.ventas.imprimirv2');
Route::get('ventas/ventas/imprimir/{id}',[VentaController::class,'imprimir'])
->where('id','[0-9]+')->name('ventas.ventas.imprimir');
Route::get('ventas/ventas/anular/{id}',[VentaController::class,'anular'])
->where('id','[0-9]+')->name('ventas.ventas.anular');
Route::get('/clear-cache', function () {
    echo Artisan::call('config:clear');
    echo Artisan::call('config:cache');
    echo Artisan::call('cache:clear');
    echo Artisan::call('route:clear');
 });


