<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class BuscadorAvisos extends Component
{
    public string $busqueda = '';

    public function limpiarBusqueda(): void
    {
        $this->busqueda = '';
    }

    public function render()
    {
        $posts = Post::publicados()
            ->with('categoria')
            ->when(trim($this->busqueda) !== '', function ($query) {
                $texto = '%' . trim($this->busqueda) . '%';

                $query->where(function ($query) use ($texto) {
                    $query->where('titulo', 'like', $texto)
                        ->orWhere('contenido', 'like', $texto)
                        ->orWhereHas('categoria', function ($query) use ($texto) {
                            $query->where('nombre', 'like', $texto);
                        });
                });
            })
            ->latest()
            ->get();

        return view('livewire.buscador-avisos', ['posts' => $posts]);
    }
}
