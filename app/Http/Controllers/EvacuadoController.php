<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Evacuado;
use App\Reparto;
use App\Area;
use App\Evento;
use App\Grupomando;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;

class EvacuadoController extends Controller
{
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $eventos = Evento::all();
        foreach ($eventos as $evento) {
        }
        $eventoActual = $evento->id;
        $evacuados = Evacuado::all()->where('evento_id', $eventoActual); 
        $repartos = Reparto::all();
        $areas = Area::all();
        return view('evacuados.index', [

            'evacuados' => $evacuados,
    		 'repartos' => $repartos,
    		    'areas' => $areas,
    		  'eventos' => $eventos,
        ]);
        
    }


    public function charts()
    {
        //
        return view('reports.charts');
    }

    public function pdf()
    {
        $evacuados = Evacuado::all(); 
        $repartos = Reparto::all();
        $areas = Area::all();
        $eventos = Evento::all();
        $gruposmando = Grupomando::All();
        $pdf = PDF::loadView('reports.pdf-evacuados', compact('evacuados','repartos','areas','eventos' ,'gruposmando'));
        return $pdf->download('listado.pdf');
        
    }

    public function excel()
    {        
        /**
         * toma en cuenta que para ver los mismos 
         * datos debemos hacer la misma consulta
        **/
        
        $repartos = Reparto::all();
        $areas = Area::all();
        $eventos = Evento::all();
        $gruposmando = Grupomando::All(); 
        

        Excel::create('Evacuados en el ISMM', function($excel) {
            $excel->sheet('Listado Evacuados', function($sheet){
            
            //Header 
            $sheet->mergeCells('A1:F1'); 
            $sheet->row(1,['Listado General de Evacuados en el ISMMM']);  
            $sheet->row(2,['Identificación','Nombre','Apellidos','Reparto','Edad','Evento climatológico']); 

            //Datos
            $evacuados = Evacuado::all(); 
            
            foreach ($evacuados as $evacuado) {
                $row[0] = $evacuado->ci;
                $row[1] = $evacuado->nombres;
                $row[2] = $evacuado->apellidos;
                $row[3] = $evacuado->reparto->nombre;
                $row[4] = $evacuado->edad;
                $row[5] = $evacuado->evento->nombre;
                $sheet->appendRow($row);                                   
            }

                        
                
            });
        })->export('xls');
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('evacuado.create');
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

            'ci'        => 'required|size:11|unique:evacuados,ci,NULL,id,evento_id,'.$request->input('evento'),
            'nombres'   => 'required|min:2|regex:/^[\pL\s\-]+$/u',
            'apellidos' => 'required|min:2|regex:/^[\pL\s\-]+$/u',
            'sexo'      => 'required|in:masculino,femenino,otro',
            'edad'      => 'required|numeric|max:110',
           
        ];

        $messages = [

             'ci.required'          => 'La inserción de datos en el campo identificación es obligatoria.',
             'ci.size'              => 'El número de indentificación debe de tener 11 caracteres.',
             'ci.unique'            => 'Esta persona con # de identificación: :input ya ha sido registrada para este evento.',
             'nombres.min'          => 'El nombre debe de tener al menos 2 caracteres.',
             'nombres.required'     => 'La inserción de datos en el campo nombre es obligatoria.',
             'nombres.regex'        => 'El campo nombre solo puede contener letras.',
             'apellidos.required'   => 'La inserción de datos en el campo apellidos es obligatoria.',
             'apellidos.min'        => 'Los apellidos deben de tener al menos 2 caracteres.',
             'apellidos.regex'      => 'El campo apellidos solo puede contener letras.',
             'edad.required'        => 'La inserción de datos en el campo edad es obligatoria.',
             'edad.numeric'         => 'La edad tiene que ser un valor numérico.',
             'edad.max'             => 'La :attribute no puede ser mayor que :max años.',
            
        ];

        $this->validate($request, $rules, $messages);


        $evacuado = new Evacuado();
        //El input tiene que coincidir con el name
        //del input del formulario 
        $evacuado->ci = $request->input('ci');
        $evacuado->nombres = mb_strtoupper($request->input('nombres'));
        $evacuado->apellidos = mb_strtoupper($request->input('apellidos'));
        $evacuado->reparto_id = $request->input('reparto');

        $eventos = Evento::all();
        foreach ($eventos as $evento) {
        }
        $eventoActual = $evento->id;
        $evacuado->evento_id = $eventoActual;

        $evacuado->sexo = mb_strtoupper($request->input('sexo'));
        $evacuado->edad = $request->input('edad');
        $evacuado->area_id = $request->input('area');
        $evacuado->local = $request->input('local');
        $evacuado->observaciones = mb_strtoupper($request->input('observaciones'));
        $evacuado->save(); 
        return back()->with('notification', 'El evacuado: ' .$evacuado->nombres. ', ha sido registrado exitosamente.');
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
        return view('evacuado.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
           
        $evacuados = Evacuado::find($id); 
        $repartos = Reparto::all();
        $areas = Area::all();
        $eventos = Evento::all();
        return view('evacuados.edit', compact('evacuados','id','eventos','repartos','areas'));

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

            'ci'        => 'required|size:11',
            'nombres'   => 'required|min:2|regex:/^[\pL\s\-]+$/u',
            'apellidos' => 'required|min:2|regex:/^[\pL\s\-]+$/u',
            'sexo'      => 'required|in:masculino,femenino,otro',
            'edad'      => 'required|numeric|max:110',
           
        ];

        $messages = [

             'ci.required'          => 'La inserción de datos en el campo identificación es obligatoria.',
             'ci.size'              => 'El número de indentificación debe de tener 11 caracteres.',
             'ci.unique'            => 'Esta persona con # de identificación: :input ya ha sido registrada para este evento.',
             'nombres.min'          => 'El nombre debe de tener al menos 2 caracteres.',
             'nombres.required'     => 'La inserción de datos en el campo nombre es obligatoria.',
             'nombres.alpha'        => 'El campo nombre solo puede contener letras.',
             'apellidos.required'   => 'La inserción de datos en el campo apellidos es obligatoria.',
             'apellidos.min'        => 'Los apellidos deben de tener al menos 2 caracteres.',
             'apellidos.alpha'      => 'El campo apellidos solo puede contener letras.',
             'edad.required'        => 'La inserción de datos en el campo edad es obligatoria.',
             'edad.numeric'         => 'La edad tiene que ser un valor numérico.',
             'edad.max'             => 'La :attribute no puede ser mayor que :max años.',
            
            
        ];

        $this->validate($request, $rules, $messages);


        $evacuado = Evacuado::find($id);
        $evacuado->ci = $request->get('ci');
        $evacuado->nombres = mb_strtoupper($request->get('nombres'));
        $evacuado->apellidos = mb_strtoupper($request->get('apellidos'));
        $evacuado->reparto_id = $request->get('reparto');

        $eventos = Evento::all();
        foreach ($eventos as $evento) {
        }
        $eventoActual = $evento->id;
        $evacuado->evento_id = $eventoActual;
        $evacuado->sexo = mb_strtoupper($request->get('sexo'));
        $evacuado->edad = $request->get('edad');
        $evacuado->area_id = $request->get('area');
        $evacuado->local = $request->get('local');
        $evacuado->observaciones = mb_strtoupper($request->get('observaciones'));
        $evacuado->save(); 
        return redirect('/evacuados')->with('notification', 'Evacuado: ' .$evacuado->nombres. ', actualizado exitosamente.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $evacuados = Evacuado::find($id);
        $evacuados->delete();
        return back()->with('notification', 'Evacuado: '.$evacuados->nombres.', eliminado exitosamente.');
    }
}
