@props(['post'])

<article class="post-card">
    <span class="tag">
        {{ $post->categoria->nombre }}
    </span>
    <h2>{{ $post->titulo }}</h2>
    <p class="post-summary">{{ $post->resumen }}</p>
    <p class="post-date">{{ $post->created_at->format('d/m/Y') }}</p>
    @if (auth()->user()?->can('update', $post) || auth()->user()?->can('delete', $post))
        <div class="post-actions">
            @can('update', $post)
                <a href="{{ route('avisos.edit', $post) }}" class="text-link">Editar</a>
            @endcan
            @can('delete', $post)
                <form method="POST" action="{{ route('avisos.destroy', $post) }}" onsubmit="return confirm('¿Borrar este aviso?')">
                    @csrf
                    @method('DELETE')
                    <button class="button-danger">Borrar</button>
                </form>
            @endcan
        </div>
    @endif
</article>

