<div>
    <!-- It is quality rather than quantity that matters. - Lucius Annaeus Seneca -->
    <a class="btn btn-{{ $color }} dropdown-toggle w-100" href="#" role="button" id="{{ $id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ $slot }}
      </a>
      <div class="dropdown-menu" aria-labelledby="{{ $id }}">
        @foreach ($items as $item)
            <a class="dropdown-item" href="{{ route($ruta,$item->id) }}">
                {{ $item->periodo }} {{ $item->nombre }}
            </a>    
        @endforeach
      </div>
</div>