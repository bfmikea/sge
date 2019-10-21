<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Evento;
use App\Evacuado;
use App\Grupomando;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $eventos = Evento::all();
        return view('eventos.index', ['eventos' => $eventos]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('evento.create');
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

            'name'          => 'required|unique:eventos,nombre',
            'fechaevento'   => 'required|unique:eventos,fecha_evento',

            
        ];

        $messages = [
             
             'name.unique'              => 'Ya hay un evento registrado con el nombre: :input.',
             'name.required'            => 'La inserción de datos en el campo nombre es obligatoria.',
             'fechaevento.unique'       => 'Ya hay un evento registrado en la fecha: :input.',
             'fechaevento.required'     => 'La inserción de datos en el campo fecha es obligatoria.',
             
        ];

        $this->validate($request, $rules, $messages);
        //End Reglas de validación
        
        //
        $evento = new Evento();
        //El input tiene que coincidir con el name
        //del input del formulario 
        $evento->nombre = mb_strtoupper($request->input('name'));
        $evento->fecha_evento = mb_strtoupper($request->input('fechaevento'));
        $evento->descripcion = mb_strtoupper($request->input('descripcion'));
        $evento->save(); 
        return back()->with('notification', 'El evento: '.$evento->nombre.', ha sido registrado exitosamente');
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
        
           $eventos = Evento::find($id);    
           return view('eventos.edit', compact('id','eventos','descripcion'));

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

            'name'          => 'required',
            'fechaevento'   => 'required',

            
        ];

        $messages = [
             
            'name.required'            => 'La inserción de datos en el campo nombre es obligatoria.',
            'fechaevento.required'     => 'La inserción de datos en el campo fecha es obligatoria.',
             
        ];

        $this->validate($request, $rules, $messages);
        //End Reglas de validación

        $eventos = Evento::find($id);
        $eventos->nombre = mb_strtoupper($request->get('name'));
        $eventos->fecha_evento = mb_strtoupper($request->get('fechaevento'));
        $eventos->descripcion = mb_strtoupper($request->get('descripcion'));
        $eventos->save();
        return redirect('/eventos-ocurridos')->with('notification', 'Evento: ' .$eventos->nombre. ', actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eventos = Evento::find($id);
        $evacuados = Evacuado::all()->where('evento_id', $eventos->id);
        $grupomando = Grupomando::all()->where('evento_id', $eventos->id);
        
        //Validando la eliminación cuando tiene elementos asociados
        if (count($evacuados)) {
        return back()->with('notification', 'Evento: '.$eventos->nombre.', no se puede eliminar porque ya tiene evacuados asociados a él.');
        }
        elseif (count($grupomando)) {
            return back()->with('notification', 'Evento: '.$eventos->nombre.', no se puede eliminar porque ya tiene personas del grupo de mando asociados a él.');
        }
        //End validando la eliminación cuando tiene elementos asociados
        
        $eventos->delete();
        return back()->with('notification', 'Evento: '.$eventos->nombre.', eliminado exitosamente.');
    }
}
