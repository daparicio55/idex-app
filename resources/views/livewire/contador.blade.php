<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <button type="button" class="btn btn-danger" wire:click="decrementar(2)">
        -
    </button>
    <span class="m-2">{{ $count }}</span>
    <button type="button" class="btn btn-info" wire:click="incrementar(2)">
        +
    </button>
</div>
