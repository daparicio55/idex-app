<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="btn-group" role="group" aria-label="Botones del footer">
                        <a href="{{ route('salud.app.matriculas.index') }}" type="button" class="btn btn-primary m-1 @if(!Auth::user()->hasRole('Bolsa User')) disabled @endif"><i class="far fa-list-alt"></i> Matriculas</a>
                        {{-- <button type="button" class="btn btn-secondary m-1">Botón 2</button> --}}
                        <a href="{{ route('salud.app.calificaciones.index') }}" class="btn btn-success m-1 @if(!Auth::user()->hasRole('Bolsa User')) disabled @endif"><i class="fas fa-sort-numeric-up-alt"></i> Calificaciones</a>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="copyright text-center my-auto">
            <span>Desarrollado por &copy; Of. Soporte Tecnológico 2024</span>
        </div> --}}
    </div>
</footer>