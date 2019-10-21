<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;
use App\Evacuado;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $areas = Area::all();
        return view('areas.index', ['areas' => $areas]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('areas.create');
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

            'name' => 'required|unique:areas,nombre|max:20',

            
        ];

        $messages = [
             
             'name.unique'       => 'Ya hay un área registrada con el nombre: :input.',
             'name.required'     => 'La inserción de datos en el campo nombre es obligatoria.',
             
        ];

        $this->validate($request, $rules, $messages);


        $area = new Area();
        //El input tiene que coincidir con el name
        //del input del formulario 
        $area->nombre = mb_strtoupper($request->input('name'));
        $area->descripcion = mb_strtoupper($request->input('descripcion'));
        $area->save(); 
        return back()->with('notification', 'El área: ' .$area->nombre. ', ha sido registrada exitosamente.');
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
        //
    //     $repartosid = Reparto::find($id);
    //     $repartos = Reparto::all();
    //     return view('repartos.edit', ['repartosid' => $repartosid, 'repartos'=>$repartos]);
    // 
           $areas = Area::find($id);    
           return view('areas.edit', compact('id','areas','descripcion'));

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

            'name' => 'required|max:20',

            
        ];

        $messages = [
             
             'name.required'     => 'El campo nombre no puede estar vacío.',
             
        ];

        $this->validate($request, $rules, $messages);


        $areas = Area::find($id);
        $areas->nombre = mb_strtoupper($request->get('name'));
        $areas->descripcion = mb_strtoupper($request->get('descripcion'));
        $areas->save();
        return redirect('areas')->with('notification', 'Área actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $areas = Area::find($id);
        $evacuados = Evacuado::all()->where('area_id', $areas->id);

        //Validando la eliminación cuando tiene elementos asociados
        if (count($evacuados)) {
        return back()->with('notification', 'Area: '.$areas->nombre.', no se puede eliminar porque ya tiene evacuados asociados a él.');
        }
        
        //End validando la eliminación cuando tiene elementos asociados
        
        $areas->delete();
        return redirect('/areas');
    }
}