<?php

// Curso 2 · Sesion 6 · El caso concreto de colas.
//
// Al crear un aviso hay que avisarle por correo a cada usuario. Este trabajo
// lo hace uno por uno: el usleep() simula lo que tarda un servidor de correo
// real por cada mensaje. Las columnas `destinatarios` y `notificados` del
// aviso llevan la cuenta, para que el avance se vea desde tu API y desde la
// pagina /cola-en-vivo.html.
//
// Al implementar `ShouldQueue`, quien crea el aviso no espera a que salgan
// todos los correos: el worker procesa este trabajo en segundo plano.

namespace App\Jobs;

use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class EnviarAvisoPorCorreo implements ShouldQueue
{
    use Queueable;

    public function __construct(public Post $post) {}

    public function handle(): void
    {
        $usuarios = User::all();

        $this->post->destinatarios = $usuarios->count();
        $this->post->notificados = 0;
        $this->post->save();

        foreach ($usuarios as $usuario) {
            usleep(500_000);   // medio segundo por correo, como un servidor real
            Log::info("Aviso {$this->post->id} enviado a {$usuario->email}");
            $this->post->increment('notificados');
        }
    }

}
