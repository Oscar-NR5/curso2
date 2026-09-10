<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Categoria;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $avisos = Post::publicados()
            ->with(['categoria', 'user'])
            ->when($request->categoria, fn ($query, $id) => $query->deCategoria($id))
            ->latest()
            ->paginate(10);

        return PostResource::collection($avisos);
    }

    public function show(Post $post)
    {
        abort_unless($post->publicado, 404);

        return new PostResource($post->load(['categoria', 'user']));
    }

    public function store(Request $request)
    {
        Gate::authorize('create', Post::class);

        $datos = $request->validate([
            'titulo' => ['required', 'max:120'],
            'contenido' => ['required'],
            'categoria_id' => ['required', 'exists:categorias,id'],
        ]);
        $datos['user_id'] = $request->user()->id;

        $post = Post::create($datos);

        return (new PostResource($post->load(['categoria', 'user'])))
            ->response()
            ->setStatusCode(201);
    }

    public function update(Request $request, Post $post)
    {
        Gate::authorize('update', $post);

        $datos = $request->validate([
            'titulo' => ['required', 'max:120'],
            'contenido' => ['required'],
            'categoria_id' => ['required', 'exists:categorias,id'],
        ]);

        $post->update($datos);

        return new PostResource($post->load(['categoria', 'user']));
    }

    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);
        $post->delete();

        return response()->noContent();
    }

    public function resumen()
    {
        return [
            'total' => Post::count(),
            'publicados' => Post::publicados()->count(),
            'borradores' => Post::where('publicado', false)->count(),
            'por_categoria' => Categoria::withCount('posts')
                ->get()
                ->mapWithKeys(fn ($categoria) => [$categoria->nombre => $categoria->posts_count]),
        ];
    }
}