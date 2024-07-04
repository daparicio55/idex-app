<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte Notas</title>
    <style>
         @media all{
            .table-header {
                width: 100%;
                border-collapse: collapse;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                margin-bottom: 1rem;
            }
            .table-section{
                width: 100%;
                border-collapse: collapse;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                margin-bottom: 1rem;
                font-size: 0.6rem;
            }
            .table-section td{
                border: 1px solid #000;
                padding: 0.5rem;
            }

            .table-header h5{
                text-align: center;
                margin: 0rem;
                padding: 0rem;
            }
            .table-main{
                width: 100%;
                border-collapse: collapse;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                margin-bottom: 1rem;
                font-size: 0.6rem;
            }
            .table-main td{
                border: 1px solid #000;
                padding: 0.2rem;

            }
            .table-header td{
                border: 1px solid #000;
                padding: 0.5rem;
            }
            .vertical-header {
                writing-mode: vertical-rl;
                text-orientation: mixed;
                white-space: nowrap;
                padding: 5px 0;
                height: auto; /* Se ajusta al contenido */
            }
        }
    </style>
</head>
<body>
    <header>
        <table class="table-header">
            <thead>
                <tr>
                    <th>
                        <img src="https://titulosinstitutos.minedu.gob.pe/Content/img/logo-minedu.png" width="200px" alt="a">                    
                    </th>
                    <th>
                        <h5>REPORTE DE ACTA DE NOTAS Y ORDEN DE MÉRITO</h5>
                        <small>La unidad es la medalla que nos distingue.</small>
                    </th>
                    <th>
                        <img src="https://idexperujapon.edu.pe/wp-content/uploads/2023/08/cropped-logo-300x93.png" width="150px" alt="b">
                    </th>
                </tr>
            </thead>
        </table>
    </header>
    <section>
        <table class="table-section">
            <thead style="color: white; background: steelblue; font-size: 0.7rem;">
                <td style="padding: 0.8rem">Programa de Estudios</td>
                <td style="padding: 0.8rem">Ciclo</td>
                <td style="padding: 0.8rem">Periodo</td>
            </thead>
            <tbody>
                <tr>
                    <td style="padding-left: 0.9rem; padding-top: 0.5rem">{{ $acta['carrera'] }}</td>
                    <td style="padding-left: 0.9rem; padding-top: 0.5rem">{{ $acta['ciclo'] }}</td>
                    <td style="padding-left: 0.9rem; padding-top: 0.5rem">{{ $acta['periodo'] }}</td>
                </tr>
            </tbody>
        </table>
    </section>
    <main>
        <table class="table-main">
            <thead>
                <tr style="color: white; background: steelblue; font-size: 0.7rem;">
                    <td>#</td>
                    <td>APELLIDOS, Nombres</td>
                    <td>DNI</td>
                    <td>Puesto</td>
                    <td>Ponderado</td>
                    @foreach ($unis as $uni)
                        <td class="vertical-header">{{ $uni->nombre }}</td>    
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($acta['estudiantes'] as $k => $estudiante)
                    <tr>
                        <td>{{ $k + 1 }}</td>
                        <td>{{ $estudiante['apellido'] }}, {{ Str::title($estudiante['nombre']) }}</td>
                        <td>{{ $estudiante['dni'] }}</td>
                        <td>{{ $estudiante['ubicacion'] }}</td>
                        <td>{{ $estudiante['ponderado'] }}</td>
                        @foreach ($unis as $uni)
                            <td style="text-align: center">
                                @foreach ($estudiante['unidades'] as $unidade)
                                    @if ($unidade['id'] == $uni->id)
                                        {{ $unidade['nota'] ? $unidade['nota'] : '-'}}
                                    @endif
                                @endforeach
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</body>
</html>