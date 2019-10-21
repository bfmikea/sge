<?php

namespace App\Http\Controllers;

use App\Charts\EvacuadosChart;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ChartsController extends Controller
{

    public function chart()
    {
        //Gráfico 1-Cantidad de evacuados por eventos ocurridos
        $eventos = DB::table('eventos')->get();

        //Valido que existan datos en la base de datos para mostrar los gráficos
        if (!is_array($eventos) == ""){

        return back()->with('notification', 'No existen datos que mostrar. Llene los datos de evacuados para poder mostrar gráficos.');
        }
                
        foreach ($eventos as $evento) {
           $evento_id = $evento->id;
           $evento_nombre[] = $evento->nombre;

           $cantEvacpEvent[] = DB::table('evacuados')
                            ->where('evento_id', $evento_id)
                            ->count();
        }
                   
        
        $chart1 = new EvacuadosChart;
        $chart1->labels($evento_nombre);
        $chart1->dataset('Cantidad de evacuados por eventos ocurridos.', 'line', $cantEvacpEvent)
        ->options([
        'borderColor' => 'rgba(220, 53, 69, 0.47)',
        'backgroundColor' => 'rgba(255, 193, 7, 0.4)',
        'pointBackgroundColor' => ['#dc3545','#ffc107','#17a2b8','#28a745','#6c757d'],
            
        ]);


        //Gráfico 2-Cantidad de evacuados por repartos en todos los eventos ocurridos
        $repartos = DB::table('repartos')->get();
        foreach ($repartos as $reparto) {
           $reparto_id = $reparto->id;
           $reparto_nombre[] = $reparto->nombre;
           
           $cantEvacpRepart[] = DB::table('evacuados')
                            ->where('reparto_id', $reparto_id)
                            ->count();
        }

        $chart2 = new EvacuadosChart;
        $chart2->labels($reparto_nombre);
        $chart2->dataset('Localidaes con mayor cantidad de evacuados.', 'pie', $cantEvacpRepart)
        ->options([
        'borderColor' => 'rgba(220, 53, 69, 0.47)',
        'backgroundColor' => ['#dc3545','#ffc107','#17a2b8','#28a745','#6c757d'],
            
        ]);
        
        return view('reports.charts', ['chart1' => $chart1, 'chart2' => $chart2]);
    }


    public function test()
    {
        /*$evacXevent = DB::table('evacuados')
                            ->where('evento_id', 1)
                            ->count();
        echo $evacXevent;*/                    
        $repartos = DB::table('repartos')->get();
        foreach ($repartos as $reparto) {
           $reparto_id = $reparto->id;
           
           $cantEvacpRepart[] = DB::table('evacuados')
                            ->where('reparto_id', $reparto_id)
                            ->count();
        }

        
        
        
    }
}
