<table class="table border">
    <thead class="border">
        <tr>
            @foreach ($resultado->capacidades as $key => $capacidade)
                <th class="text-center pt-0 pb-0 border" colspan="{{ $capacidade->indicadores()->count() }}">
                    {{ $capacidade->nombre }} - cierre: @if(isset($capacidade->fecha)) {{ date('d-m-Y',strtotime($capacidade->fecha)) }} @else <span class="text-danger"> NP </span> @endif
                </th>
            @endforeach
        </tr>
        <tr>
            @foreach ($resultado->capacidades as $key => $capacidade)
                @foreach ($capacidade->indicadores as $llave=>$indicadore)
                    <th class="text-center pt-0 pb-0 border">
                        <span>
                            {{ $indicadore->nombre }} - cierre: @if(isset($capacidade->fecha)) {{ date('d-m-Y',strtotime($indicadore->fecha)) }} @else <span class="text-danger"> NP </span> @endif
                        </span>
                        <p class="pt-0 pb-0 mb-0">
                            <span>T: {{ $indicadore->detalles()->count() }}</span>|
                            <span class="text-primary">A: {{ $indicadore->detalles()->where('nota','>',12)->count() }}</span>|
                            <span class="text-danger">D: {{ $indicadore->detalles()->where('nota','<',13)->count() }}</span>
                        </p>
                    </th>
                @endforeach
            @endforeach
        </tr>
    </thead>
</table>