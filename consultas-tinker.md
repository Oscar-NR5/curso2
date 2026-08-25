# Consultas Eloquent probadas

Estas consultas se ejecutaron en `php artisan tinker` con los datos del seeder.

## Bloque A

### 1. Cinco posts publicados más recientes

```php
Post::publicados()->latest()->take(5)->get(['titulo', 'created_at'])->toArray();
// [['titulo' => 'hola', 'created_at' => '2026-08-25 21:31:13'], ['titulo' => 'Cambio de horario en barandilla', 'created_at' => '2026-08-19 22:48:06'], ['titulo' => 'Curso de primeros auxilios', 'created_at' => '2026-08-18 22:48:06'], ['titulo' => 'Mantenimiento de patrullas', 'created_at' => '2026-08-16 22:48:06'], ['titulo' => 'Actualización del directorio interno', 'created_at' => '2026-08-14 22:48:06']]
```

### 2. Publicados y borradores

```php
Post::publicados()->count();
// 9
Post::where('publicado', false)->count();
// 0
```

### 3. Posts de una categoría

```php
Post::deCategoria(1)->latest()->pluck('titulo')->toArray();
// ['hola', 'Cambio de horario en barandilla', 'Actualización del directorio interno', 'Renovación de credenciales']
```

### 4. Títulos publicados que contienen una palabra

```php
Post::publicados()->where('titulo', 'like', '%curso%')->pluck('titulo')->toArray();
// ['Curso de primeros auxilios']
```

### 5. Scope de posts recientes

```php
Post::publicados()->recientes(30)->latest()->pluck('titulo')->toArray();
// ['hola', 'Cambio de horario en barandilla', 'Curso de primeros auxilios', 'Mantenimiento de patrullas', 'Actualización del directorio interno', 'Taller de manejo defensivo', 'Operativo coordinado en el sector norte', 'Renovación de credenciales']
```

## Bloque B

### 6. Posts sin etiquetas

```php
Post::doesntHave('etiquetas')->pluck('titulo')->toArray();
// ['Actualización del directorio interno', 'Taller de manejo defensivo', 'Operativo coordinado en el sector norte', 'Renovación de credenciales', 'Simulacro de evacuación en oficinas centrales', 'hola']
```

### 7. Etiquetas más utilizadas

```php
Etiqueta::withCount('posts')->orderByDesc('posts_count')->get(['nombre', 'posts_count'])->toArray();
// [['nombre' => 'operativo', 'posts_count' => 2], ['nombre' => 'seguridad', 'posts_count' => 1], ['nombre' => 'aviso', 'posts_count' => 1]]
```

### 8. Publicados recientes de una categoría con una etiqueta

```php
Post::publicados()
    ->recientes(30)
    ->whereHas('etiquetas', fn ($query) => $query->where('nombre', 'operativo'))
    ->with('categoria', 'etiquetas')
    ->latest()
    ->get();
// ['Cambio de horario en barandilla', 'Curso de primeros auxilios']
// Responde qué avisos publicados y recientes tienen la etiqueta operativo, cargando sus relaciones.
```