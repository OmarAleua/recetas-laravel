@extends('layouts.app')
@section('botones')

    <a class="btn btn-primary mr-2" href="{{ route('recetas.index') }}">Volver</a>

@endsection

@section('content')
    {{-- <h1>{{$receta}}</h1> --}}
    <article class="contenido-receta" id="">
        <h1 class="text-center mb-4">{{$receta->titulo}}</h1>

        <div class="imagen-receta">
            <img src="/storage/{{ $receta->imagen }}" class="w-100"> {{-- /recetas-laravel/public --}}
        </div>

        <div class="receta-meta mt-2">
            <p>
                <span class="font-weight-bold text-primary">Escrito en: </span>
                {{$receta->categoria->nombre}}
            </p>
            <p>
                <span class="font-weight-bold text-primary">Autor: </span>
                {{$receta->autor->name}}
            </p>
            <p>
                <span class="font-weight-bold text-primary">Fecha: </span>
                {{-- {{$receta->created_at}} --}}
                @php
                    $fecha = $receta->created_at
                @endphp
                <fecha-receta fecha="{{$fecha}}"></fecha-receta>             
            </p>
            
            <div class="ingredientes">
                <h2 class="my-3 text-primary">Ingredientes</h2>
                {!! $receta->ingredientes !!}
            </div>    
            <div class="preparacion">
                <h2 class="my-3 text-primary">Preparacion</h2>
                {!! $receta->preparacion !!}
            </div>  
        </div>    
    </article>
@endsection