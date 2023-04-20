@extends('layouts.app')

@section('botones')

    <a class="btn btn-primary mr-2" href="{{ route('recetas.create') }}">Crear Receta</a>

@endsection

@section('content')

{{-- {{$usuarios}} SI FUNCIONO--}}
{{-- @foreach($usuarios as $usuario)
    <option> {{ $usuarios }} </option>
@endforeach SI FUNCIONA TAMBIEN--}}

<h2 class="text-center mb-5">Administra tus recetas</h2>

{{-- {{ $recetas }} --}}

<div class="col-md-10 mx-auto bg-white p-3">
    <table class="table">
        <thead class="bg-primary text-light">
            <tr>
                <th scole="cole">Titulo</th>
                <th scole="cole">Categoria</th>
                <th scole="cole">Acciones</th>
            </tr>    

        </thead>
        <tbody>
            @foreach($recetas as $receta)
                <tr>
                    <td>{{$receta->titulo}}</td>
                    <td>{{$receta->categoria->nombre}}</td>
                    <td>                        
                        <a href="{{ route('recetas.show', ['receta' => $receta->id]) }}" class="btn btn-success d-block mb-2">Ver</a>
                        <a href="{{ route('recetas.edit', ['receta' => $receta->id]) }}" class="btn btn-dark d-block mb-2">Editar</a>
                        <eliminar-receta></eliminar-receta>                       
                    </td>
                </tr>
            @endforeach            
        </tbody>        
    </table>
</div>

@endsection

