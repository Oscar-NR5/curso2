@extends('layouts.publico')

@section('titulo', 'Editar aviso')

@section('contenido')
    <form method="POST" action="{{ route('avisos.update', $post) }}" class="form-panel">
        @csrf
        @method('PUT')
        @include('avisos._campos', ['submitLabel' => 'Guardar cambios'])
    </form>
@endsection