@extends('layouts.publico')

@section('titulo', 'Nuevo aviso')

@section('contenido')
    <form method="POST" action="{{ route('avisos.store') }}" class="form-panel">
        @csrf
        @include('avisos._campos', ['submitLabel' => 'Publicar aviso'])
    </form>
@endsection