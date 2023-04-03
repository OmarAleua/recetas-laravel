@extends('layouts.app')

@section('botones')

    <a class="btn btn-primary mr-2" href="{{ route('recetas.create') }}">Crear Receta</a>

@endsection

@section('content')

<h2 class="text-center mb-5">Administra tus recetas</h2>
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
            <tr>
                <td>Ravioles</td>
                <td>Pasta</td>
                <td>Editar - Eliminar</td>
            </tr>
        </tbody>        
    </table>
</div>

@endsection

