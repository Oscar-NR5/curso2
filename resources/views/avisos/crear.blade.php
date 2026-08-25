@extends('layouts.publico')

@section('titulo', 'Nuevo aviso')

@section('contenido')
    <form method="POST" action="{{ route('avisos.store') }}" class="max-w-lg mx-auto p-8 bg-white rounded-lg shadow mt-8">
        @csrf
        @include('avisos._campos', ['submitLabel' => 'Publicar aviso'])
    </form>
@endsection