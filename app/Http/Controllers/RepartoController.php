<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reparto;
use App\Evacuado;

class RepartoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $repartos = Reparto::all();
        return view('repartos.index', ['repartos' => $repartos]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('repartos.create');
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
            'name'   => 'required|unique:repartos,nombre',
            
        ];

        $messages = [

             'name.required'     => 'La inserción de datos en el campo nombre es obligatoria.',
             'name.unique'       => 'Ya existe un reparto registrado con el nombre: :input.',
        ];
         $this->validate($request, $rules, $messages);
        //End Reglas de validación

        //
        $reparto = new Reparto();
        // El $request->name tiene que coincidir con el 'name': $('#reparto_add').val(), 
        // del javaScript
        $reparto->nombre = mb_strtoupper($request->name);
        $reparto->save(); 
        return back()->with('notification', 'Reparto: ' .$reparto->nombre. ', registrado exitosamente.');
        //return response()->json($reparto);
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
        
           $repartos = Reparto::find($id);    
           return view('repartos.edit', compact('repartos','id'));

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
            'name' => 'required',
            
        ];

        $messages = [

             'name.required'     => 'El campo nombre no puede estar vacío.',
             
        ];
         $this->validate($request, $rules, $messages);
        //End Reglas de validación


        $repartos = Reparto::find($id);
        $repartos->nombre = mb_strtoupper($request->get('name'));
        $repartos->save();
        return redirect('/repartos')->with('notification', 'Reparto: ' .$repartos->nombre. ', actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $repartos = Reparto::find($id);
        $evacuados = Evacuado::all()->where('reparto_id', $repartos->id);

        //Validando la eliminación cuando tiene elementos asociados
        if (count($evacuados)) {
        return back()->with('notification', 'Reparto: '.$repartos->nombre.', no se puede eliminar porque ya tiene evacuados asociados a él.');
        }
        //End validando la eliminación cuando tiene elementos asociados
        
        $repartos->delete();
        return back()->with('notification', 'Reparto: '.$repartos->nombre.', eliminado exitosamente.');
        
    }
}
