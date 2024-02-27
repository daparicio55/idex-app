<div class="card">
    <div class="card-header bg-info">
        <h5>
            Reportes de Postulantes por Colegios
        </h5>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Colegio</th>
                    {{-- <th>Gestion</th> --}}
                    <th>Distrito</th>
                    <th>Provincia</th>
                    <th>Departamento</th>
                    <th>Cant.</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($colegios as $key => $colegio)
                    <tr>
                        <td class="pb-0">{{ $key + 1 }}</td>
                        <td class="pb-0">{{ $colegio->CEN_EDU }}</td>
                        {{-- <td class="pt-0">{{ $colegio->D_GESTION }}</td> --}}
                        <td class="pb-0">{{ $colegio->D_DIST }}</td>
                        <td class="pb-0">{{ $colegio->D_PROV }}</td>
                        <td class="pb-0">{{ $colegio->D_DPTO }}</td>
                        <td class="pb-0 text-center">{{ $colegio->admisionePostulantes()->where('admisione_id','=',$_GET['id'])->count() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div