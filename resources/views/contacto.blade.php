@extends('layouts.publico')

@section('titulo', 'Contacto · Blog de Avisos')

@section('contenido')
    <main class="max-w-lg mx-auto p-8 bg-white rounded-lg shadow mt-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Contacto</h1>

        <form action="{{ route('contacto.enviar') }}" method="post" class="space-y-4">
            @csrf

            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                <input id="nombre" name="nombre" type="text" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none">
            </div>

            <div>
                <label for="correo" class="block text-sm font-medium text-gray-700 mb-1">Correo</label>
                <input id="correo" name="correo" type="email" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none">
            </div>

            <div>
                <label for="mensaje" class="block text-sm font-medium text-gray-700 mb-1">Mensaje</label>
                <textarea id="mensaje" name="mensaje" rows="5" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none"></textarea>
            </div>

            <button type="submit" class="w-full bg-blue-900 text-white font-semibold rounded-lg py-2 hover:bg-blue-800 transition">Enviar mensaje</button>
        </form>

        <a href="{{ route('inicio') }}" class="mt-4 block text-center text-sm text-blue-900 hover:underline">Volver a los avisos</a>

    </main>
@endsection