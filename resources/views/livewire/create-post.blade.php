<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <input type="text" wire:model.live="name">
    <button type="button" wire:click="save">
        Guardar
    </button>
    <p>{{ $name }}</p>
</div>
