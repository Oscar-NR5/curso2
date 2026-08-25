@extends('layouts.publico')

@section('titulo', 'Editar aviso')

@section('contenido')
    <form method="POST" action="{{ route('avisos.update', $post) }}" class="max-w-lg mx-auto p-8 bg-white rounded-lg shadow mt-8">
        @csrf
        @method('PUT')
        @include('avisos._campos', ['submitLabel' => 'Guardar cambios'])
    </form>
@endsection