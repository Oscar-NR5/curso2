@extends('layouts.publico')

@section('titulo', 'Contacto · Bitácora')

@section('contenido')
    <main class="form-panel">
        <header class="form-heading">
            <span class="eyebrow">Comunicación</span>
            <h1>Contacto</h1>
            <p>Comparte una consulta, sugerencia o comentario con el equipo del blog.</p>
        </header>

        <form action="{{ route('contacto.enviar') }}" method="post">
            @csrf

            <div class="field">
                <label for="nombre" class="field-label">Nombre</label>
                <input id="nombre" name="nombre" type="text" class="field-input">
            </div>

            <div class="field">
                <label for="correo" class="field-label">Correo</label>
                <input id="correo" name="correo" type="email" class="field-input">
            </div>

            <div class="field">
                <label for="mensaje" class="field-label">Mensaje</label>
                <textarea id="mensaje" name="mensaje" rows="5" class="field-input"></textarea>
            </div>

            <button type="submit" class="button form-submit">Enviar mensaje</button>
        </form>

        <a href="{{ route('avisos.index') }}" class="text-link">Volver a los avisos</a>

    </main>
@endsection