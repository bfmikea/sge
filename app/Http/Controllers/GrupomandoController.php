<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grupomando;
use App\Evento;

class GrupomandoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eventos = Evento::all(); 
        $gruposmando = Grupomando::all();
        return view('gruposmando.index', ['gruposmando' => $gruposmando, 'eventos' => $eventos]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('grupomando.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Reglas de validación, las llaves de los elementos del array
        //$rules son los value de los elementos del formulario.
        $rules = [

            'nombres'   => 'required|min:2|regex:/^[\pL\s\-]+$/u',
            'apellidos' => 'required|min:2|regex:/^[\pL\s\-]+$/u',
            'cargo'     => 'required',
            'evento'    => 'required',
           
        ];

        $messages = [

             'nombres.min'          => 'El nombre debe de tener al menos 2 caracteres.',
             'nombres.required'     => 'La inserción de datos en el campo nombre es obligatoria.',
             'nombres.regex'        => 'El valor introducido en el campo nombre no es válido.',
             'apellidos.regex'      => 'El valor introducido en el campo apellido no es válido.',
             'apellidos.required'   => 'La inserción de datos en el campo apellidos es obligatoria.',
             'apellidos.min'        => 'Los apellidos deben de tener al menos 2 caracteres.',
             'cargo.required'       => 'La inserción de datos en el campo cargo es obligatoria.',
             'evento.required'      => 'Debe de seleccionar un evento.',
             
        ];

        $this->validate($request, $rules, $messages);
        //
        $grupomando = new Grupomando();
        //El input tiene que coincidir con el name
        //del input del formulario 
        $grupomando->nombres = mb_strtoupper($request->input('nombres'));
        $grupomando->apellidos = mb_strtoupper($request->input('apellidos'));
        $grupomando->cargo = mb_strtoupper($request->input('cargo'));
        $grupomando->evento_id = mb_strtoupper($request->input('evento'));
        $grupomando->save(); 
        return back()->with('notification', 'El integrante del grupo de mando: '.$grupomando->nombres.' '.$grupomando->apellidos.', ha sido registrado exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
           
           $gruposmando = Grupomando::find($id); 
           $eventos = Evento::all(); 
           return view('gruposmando.edit', compact('gruposmando','id','eventos'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Reglas de validación, las llaves de los elementos del array
        //$rules son los value de los elementos del formulario.
        $rules = [

            'nombres'   => 'required|min:2|regex:/^[\pL\s\-]+$/u',
            'apellidos' => 'required|min:2|regex:/^[\pL\s\-]+$/u',
            'cargo'     => 'required',
            'evento'    => 'required',
           
        ];

        $messages = [

             'nombres.min'          => 'El nombre debe de tener al menos 2 caracteres.',
             'nombres.required'     => 'La inserción de datos en el campo nombre es obligatoria.',
             'nombres.regex'        => 'El valor introducido en el campo nombre no es válido.',
             'apellidos.regex'      => 'El valor introducido en el campo apellido no es válido.',
             'apellidos.required'   => 'La inserción de datos en el campo apellidos es obligatoria.',
             'apellidos.min'        => 'Los apellidos deben de tener al menos 2 caracteres.',
             'cargo.required'       => 'La inserción de datos en el campo cargo es obligatoria.',
             'evento.required'      => 'Debe de seleccionar un evento.',
             
        ];

        $this->validate($request, $rules, $messages);
        
        $grupomando = Grupomando::find($id);
        $grupomando->nombres = mb_strtoupper($request->get('nombres'));
        $grupomando->apellidos = mb_strtoupper($request->get('apellidos'));
        $grupomando->cargo = mb_strtoupper($request->get('cargo'));
        $grupomando->evento_id = mb_strtoupper($request->get('evento'));
        $grupomando->save(); 
        return redirect('/grupos-mando')->with('notification', 'El integrante del grupo de mando: '.$grupomando->nombres.' '.$grupomando->apellidos.', ha sido actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gruposmando = Grupomando::find($id);
        $gruposmando->delete();
        return back()->with('notification', 'El integrante del grupo de mando: '.$gruposmando->nombres.' '.$gruposmando->apellidos.', ha sido eliminado exitosamente.');
    }
}