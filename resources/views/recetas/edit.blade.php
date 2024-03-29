@extends('layouts.app')
@section('styles')
    <!--<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('botones')
    <a class="btn btn-primary mr-2" href="{{ route('recetas.index') }}">Volver</a>
@endsection

@section('content')
    {{-- {{$receta}} --}}
    <h2 class="text-center mb-5">Editar Receta: {{$receta->titulo}}</h2>

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <form method="POST" action="{{ route('recetas.update', ['receta'=> $receta->id]) }}" enctype="multipart/form-data" novalidate>
                @csrf
                @method('put') {{-- put no es un metodo soportado por HTML por eso se pone aca --}}
                <div class="form-group  mt-3">
                    <label for="titulo">Titulo Receta</label>

                    <input type="text" 
                        name="titulo" 
                        id="titulo" 
                        class="form-control @error('titulo') is-invalid @enderror" 
                        placeholder="Titulo Receta"
                        value="{{$receta->titulo}}"> 
                        <!--el error del class es para que pinte de rojo todo el recuadro del input-->
                        <!--el old del value es para que persista lo ultimo escrito-->
                    @error('titulo')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group  mt-3">
                    <label for="categoria">Categoria</label>
                    <select
                        name="categoria"
                        class="form-control @error('categoria') is-invalid @enderror"
                        id="categoria">
                        <option value="">--Seleccione--</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ $receta->categoria_id == $categoria->id ? 'selected' : "" }}>{{ $categoria->nombre }}</option>
                        @endforeach                        
                    </select>
                    @error('categoria')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group  mt-3">
                    <label for="ingredientes">Ingredientes</label>                    
                    <input id="ingredientes" type="hidden" name="ingredientes" value="{{$receta->ingredientes}}">
                    <trix-editor 
                        class="form-control @error('ingredientes') is-invalid @enderror"
                        input="ingredientes">
                    </trix-editor>
                    @error('ingredientes')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="preparacion">Preparacion</label>                    
                    <input id="preparacion" type="hidden" name="preparacion" value="{{$receta->preparacion}}">
                    <trix-editor 
                        class="form-control @error('preparacion') is-invalid @enderror"
                        input="preparacion">
                    </trix-editor>
                    @error('preparacion')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mt-4">
                    <p>Imagen actual:</p>
                    <img src="/storage/{{ $receta->imagen }}" alt="" style="width: 300px">
                </div>

                <div class="form-group  mt-3">
                    <label for="imagen">Elige la nueva imagen</label>
                    <input 
                        id="imagen"
                        type="file" 
                        class="form-control @error('imagen') is-invalid @enderror" 
                        name="imagen">
                    
                    @error('imagen')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group  mt-3">
                    <input type="submit" class="btn btn-primary" value="Agregar receta">
                </div>   

            </form>
        </div>
    </div>

@endsection
@section('scripts')
    <!--<script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
