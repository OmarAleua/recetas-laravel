<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use Termwind\Components\Dd;
use Illuminate\Http\Request;
use App\Models\CategoriaReceta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\HTTP;
use Intervention\Image\Facades\Image;

class RecetaController extends Controller
{
    //proteccion para que no ingrese un usuario que no esta registrado
    public function __construct()
    {
        //con esta funcion protegemos todos los metodos 
        //ninguna persona puede editar sin haberse registrado
        //pero con la funcion except, dejamos abierto el metodo show para que vea cualquier persona
        //para mantener 2 metodos abiertos: $this->middleware('auth', ['except' => ['show', 'create']]);
        $this->middleware('auth', ['except' => 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //prueba traer datos de API externa: SI FUNCIONA - MUESTRA TODO
        /* $usuarios = HTTP::get('https://reqres.in/api/users');
        return view('recetas.index', compact('usuarios')); */
        
        //traemos toda la info del modelo
        //Auth::user()->recetas->dd();
        //auth()->user()->recetas->dd(); - ESTA ES OTRA FORMA DE MOSTRAR LO MISMO DE ARRIBA

        $recetas = Auth::user()->recetas;

        // esto se hace para ver la info de forma estatica
        /* $recetas = [
            'pizza especial', 'lemon pie', 'Cerveza',
        ];
        $categorias = [
            'Postres', 'Carnes', 'Bebidas',
        ]; */

        //redirige a recetas.index
        return view('recetas.index', compact('recetas'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //obtener las categorias con modelo
        $categorias = CategoriaReceta::all(['id', 'nombre']);
        //DB::table('categoria_receta')->get()->pluck('nombre', 'id')->dd();
        //obtener las categorias sin modelo
        /* $categorias = DB::table('categoria_recetas')->get()->pluck('nombre', 'id'); */

        return view('recetas.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* dd ( $request->all() ); MUESTRA TODO LO QUE ENVIAMOS A LA DB EN FORMATO JSON Y DETIENE LA EJECUCION*/
        /* dd ( $request['imagen']->store('upload-recetas', 'public') ); */

        //asigna todo el request a data : VALIDATION
        $data = $request->validate([
            'titulo' => 'required|min:6',
            'categoria' => 'required',
            'ingredientes' => 'required',
            'preparacion' => 'required',
            'imagen' => 'required|image'
        ]);

        //validar si hay un archivo en el request
        /* if ($request->('titulo')) {
            $article['image'] = $request->file('image')->store('articles');
        } */
        $ruta_imagen = $request['imagen']->store('upload-recetas', 'public');

        //resize de la imagen
        $img = Image::make( \public_path("storage/{$ruta_imagen}"))->fit(1000,550);
        $img->save();

        //hace la insercion a la DB sin el modelo
        /* DB::table('recetas')->insert([
            'titulo' => $data['titulo'],
            'preparacion' => $data['preparacion'],
            'ingredientes' => $data['ingredientes'],
            'imagen' => $ruta_imagen,
            'user_id' => Auth::user()->id,
            'categoria_id' => $data['categoria']
        ]); */

        //hace la insercion a la DB con el modelo
        Auth::user()->recetas()->create([
            'titulo' => $data['titulo'],
            'preparacion' => $data['preparacion'],
            'ingredientes' => $data['ingredientes'],
            'imagen' => $ruta_imagen,
            'categoria_id' => $data['categoria']
        ]);

        //redireccionamos a index
        return redirect()->action([RecetaController::class, 'index']);

        //para mostrar la info en json
        //dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {
        //
        return view('recetas.show', compact('receta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        //

        $categorias = CategoriaReceta::all(['id', 'nombre']);


        return view('recetas.edit', compact('categorias', 'receta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {
        //revisar el policy
        $this->authorize('update', $receta);

        //asigna todo el request a data : VALIDATION
        $data = $request->validate([
            'titulo' => 'required|min:6',
            'categoria' => 'required',
            'ingredientes' => 'required',
            'preparacion' => 'required'
        ]);

        //asignar los valores
        $receta->titulo = $data['titulo'];
        $receta->categoria_id = $data['categoria'];
        $receta->ingredientes = $data['ingredientes'];
        $receta->preparacion = $data['preparacion'];

        //si el usuario sube una nueva imagen
        if(request('imagen')){
            $ruta_imagen = $request['imagen']->store('upload-recetas', 'public');

            //resize de la imagen
            $img = Image::make( \public_path("storage/{$ruta_imagen}"))->fit(1000,550);
            $img->save();

            //asignamos al objeto
            $receta->imagen = $ruta_imagen;
        }

        //graba todo en la DB
        $receta->save();

        //redireccionamos
        return redirect()->action([RecetaController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        //revisar el policy
        $this->authorize('delete', $receta);

        //eliminar la receta
        $receta->delete();

        //redireccionamos
        return redirect()->action([RecetaController::class, 'index']);
    }
}
