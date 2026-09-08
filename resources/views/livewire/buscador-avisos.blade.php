<div>
    <div class="search-controls">
        <label class="sr-only" for="busqueda-avisos">Buscar avisos</label>
        <input
            id="busqueda-avisos"
            type="search"
            wire:model.live.debounce.300ms="busqueda"
            class="field-input search-input"
            placeholder="Buscar avisos..."
            autocomplete="off"
        >
        <button type="button" wire:click="limpiarBusqueda" class="button button-clear">
            Limpiar
        </button>
    </div>

    <div class="post-grid">
        @forelse ($posts as $post)
            <x-tarjeta-post :post="$post" />
        @empty
            <p class="empty-state">No se encontraron avisos.</p>
        @endforelse
    </div>
</div>
