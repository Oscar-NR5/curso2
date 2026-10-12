<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Datos de práctica del blog de avisos.
     *
     * Ojo: asume las columnas del ejercicio de clase (titulo, contenido,
     * categoria_id). Si nombraste distinto tus columnas, adapta este archivo.
     * Las fechas van escalonadas a propósito: sirven para probar latest()
     * y el scope recientes() de la tarea.
     */
    public function run(): void
    {
        $avisos = [
            ['titulo' => 'Nueva publicación en la bitácora', 'categoria' => 'Aviso', 'dias' => 1,
             'contenido' => 'Desde el lunes, la bitácora contará con una nueva sección para compartir novedades y comunicados de la comunidad.'],
            ['titulo' => 'Curso de primeros auxilios', 'categoria' => 'Capacitación', 'dias' => 2,
             'contenido' => 'Inscripciones abiertas en la academia para el curso de primeros auxilios básicos. Cupo limitado a 25 personas.'],
            ['titulo' => 'Mantenimiento de la plataforma', 'categoria' => 'Operativo', 'dias' => 4,
             'contenido' => 'La plataforma tendrá una revisión técnica esta semana para mejorar la velocidad y la experiencia de lectura.'],
            ['titulo' => 'Actualización del directorio de autores', 'categoria' => 'Aviso', 'dias' => 6,
             'contenido' => 'Revisa que tu nombre y perfil de autor aparezcan correctamente; los cambios se pueden solicitar al equipo editorial.'],
            ['titulo' => 'Taller de escritura para blogs', 'categoria' => 'Capacitación', 'dias' => 9,
             'contenido' => 'Abrimos una nueva fecha para el taller de escritura clara y publicación responsable. Registro disponible para toda la comunidad.'],
            ['titulo' => 'Calendario editorial del mes', 'categoria' => 'Operativo', 'dias' => 12,
             'contenido' => 'El viernes publicaremos el calendario editorial del mes; consulta las fechas y temas de las próximas entradas.'],
            ['titulo' => 'Renovación de perfiles', 'categoria' => 'Aviso', 'dias' => 20,
             'contenido' => 'La sección de perfiles se actualizará próximamente para mostrar biografías, enlaces y temas de interés de cada autor.'],
            ['titulo' => 'Respaldo de publicaciones', 'categoria' => 'Operativo', 'dias' => 40,
             'contenido' => 'Realizaremos un respaldo general de las publicaciones para conservar el archivo y facilitar futuras consultas.'],
        ];

        $categorias = Categoria::pluck('id', 'nombre');

        foreach ($avisos as $datos) {
            $post = Post::firstOrNew(['titulo' => $datos['titulo']]);
            $post->contenido = $datos['contenido'];
            $post->categoria_id = $categorias[$datos['categoria']];
            $post->created_at = now()->subDays($datos['dias']);
            $post->save();
        }
    }
}
