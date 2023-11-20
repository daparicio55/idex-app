<div>
    {{-- The whole world belongs to you. --}}
    <form class="mt-4" wire:submit="guardar">
        <input type="text" wire:model="pais">
        <button>
            Guardar
        </button>
    </form>
    <ul>
        @foreach ($paises as $key => $pais)
            <li class="mt-1">
                ({{ $key }}){{ $pais }}
                <button class="btn btn-danger sm" wire:click="delete({{ $key }})">
                    X
                </button>
            </li>
        @endforeach
    </ul>
</div>
