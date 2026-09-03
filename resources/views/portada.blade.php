@extends('layouts.publico')

    @section('titulo', 'Avisos · Bitácora')

   @section('contenido')
       @if (session('mensaje')) <div class="message" role="status">{{ session('mensaje') }}</div> @endif

       <section class="hero">
           <div class="hero-inner">
               <span class="eyebrow">Publicaciones recientes</span>
               <h1>Bitácora de Avisos</h1>
               <p>Noticias, comunicados y novedades para mantener a todos al día.</p>
               @auth
                   <a href="{{ route('avisos.create') }}" class="button button-light" style="margin-top: 24px">Nuevo aviso</a>
               @endauth
           </div>
       </section>

       <div class="page-width">
           <div class="post-grid">
               @foreach ($posts as $post)
                   <x-tarjeta-post :post="$post" />
               @endforeach
           </div>
       </div>
   @endsection