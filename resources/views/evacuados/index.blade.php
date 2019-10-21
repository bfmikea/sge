@extends('layouts.app')


@section('content')

<div class="row">
  <div class="col-12">
    
    <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table fa-lg"> <span>Evacuados</span></i></div>

          <!-- Notificación que es pasada luego de realizar una operación -->
          @if(session('notification'))
          <div class="alert alert-success pop-in">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            {{session('notification')}}
          </div> 
          @endif
          <!-- End Notificación que es pasada luego de realizar una operación -->

          <!-- Notificación de errores que es pasada desde el método store y update -->
          @if(count($errors) > 0)

            <div class="alert alert-danger pop-in">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>

              @foreach($errors->all() as $error)

                <li>{{$error}}</li>

              @endforeach

            </div>  

          @endif
          <!-- End Notificación de errores que es pasada desde el método store y update -->

        <div class="card-body">

       
         
        
        <div class="col d-flex justify-content-center pb-3">
                    
        

        <!-- Formulario para registrar una nueva localidad-->
        <form action="" method="POST">
            {{csrf_field()}}

          <div class="form-row">

            {{-- Col1 # Identificación, Nombres, Apellidos --}}
            <div class="col-md-4">
                <div class="form-group mx-sm-3">

                    <div class="col">
                      <label for="ci">Identificación</label>
                      <input type="text" class="form-control mb-2" name="ci" id="ci" onchange="calcedad(this.value)" placeholder="88103023168" 
                      value="{{old('ci')}}">
                    </div>
                    
                    <div class="col">
                      <label for="nombres-e">Nombre</label>
                      <input type="text" class="form-control mb-2" name="nombres" id="nombres-e" placeholder="Juan" 
                      value="{{old('nombres')}}">
                    </div>

                    <div class="col">
                      <label for="apellidos-e">Apellidos</label>
                      <input type="text" class="form-control mb-2" name="apellidos" id="apellidos-e" placeholder="Doe Matos" 
                      value="{{old('apellidos')}}">
                    </div>
                 
                </div>
            </div>

            
            {{-- Col2 Consejo popular, Evento, Sexo, Edad--}}
            <div class="col-md-4">

                <div class="form-group mx-sm-3">

                  <div class="col">
                    <label for="inputText2">Localidad</label>
                    <select class="form-control mb-2" name="reparto" id="evento">
                      
                      @foreach($repartos as $reparto)

                      <option value="{{$reparto->id}}">{{$reparto->nombre}}
                      </option>

                      @endforeach 
                                        
                    </select>
                  </div>

                  <div class="col">
                    <label for="inputText2">Evento</label>
                    {{-- <select class="form-control mb-2" name="evento" id="evento"> --}}
                      
                      @foreach($eventos as $evento)

                      @endforeach

                      {{-- <option value="{{$evento->id}}">{{$evento->nombre}}
                      </option> --}}

                      <input type="text" class="form-control mb-2" name="evento" id="evento"  
                      value="{{$evento->nombre}}" disabled>

                      
                                        
                    {{-- </select> --}}
                  </div>

                  <div class="form-row mx-2">

                    <div class="col-6 form-group">
                      <label for="inputText2" >Sexo</label>
                      <select class="form-control mb-2" name="sexo" id="sexo">
                        <option value="masculino">Masculino</option>
                        <option value="femenino">Femenino</option>
                        <option value="otro">Otro</option>
                      </select>
                    </div>

                    <div class="col-6 form-group">
                      <label for="edad-e" >Edad</label>
                      <input type="text" class="form-control mb-2" name="edad" id="edad-e" value="{{old('edad')}}">
                    </div>
                  </div>
                </div>
            </div>

            
            


            {{-- Col3 --}}
            <div class="col-md-4">
                
                  <div class="form-row mx-sm-3">
                    
                    <div class="col-6">
                      <label for="inputText2">Ubicación</label>
                      <select class="form-control mb-2" name="area" id="sexo">
                        

                        @foreach($areas as $area)

                        <option value="{{$area->id}}">{{$area->nombre}}
                        </option>

                        @endforeach
                        

                                          
                      </select>
                    </div>

                    <div class="col-6">
                      <label for="direc" >Cuarto o local</label>
                      <input type="text" class="form-control mb-2" name="local" id="local" value="{{old('local')}}">
                    </div>

                    

                    <div class="col-12">
                      <label for="observaciones">Observaciones</label>
                      <textarea class="form-control" id="observaciones" rows="4" placeholder="Observaciones" name="observaciones">{{old('observaciones')}}</textarea>
                    </div>
                 

                  </div>
                  <div class="col pt-2 d-flex justify-content-end">
                    <button id="registrar" type="submit" class="btn btn-success w-50 registrar">Registrar</button>
                  </div> 

                  
                
            </div>   

          </div>

          
            
          

        </form>
        <!-- End formulario para registrar una nueva localidad-->


          </div>
            <div class="container">
              <div class="row">
                <div class="col-sm-11 text-sm-right">
                  Edad mínima:
                </div>
                <div class="col-sm-1 mb-1 ">
                  <input class="form-control form-control-sm" type="text" id="min" name="min" value="">
                </div>
              </div>

              <div class="row">
                <div class="col-sm-11 text-sm-right">
                  Edad máxima:
                </div>
                <div class="col-sm-1 mb-1">                    
                  <input class="form-control form-control-sm" type="text" id="max" name="max" value="">
                </div>              
              </div>
            </div>  

          <div class="table-responsive">
            
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>CI</th>
                  <th>Nombres</th>
                  <th>Apellidos</th>
                  <th>Consejo popular</th>
                  <th>Edad</th>
                  <th>Ubicación</th>
                  <th>Acción</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>CI</th>
                  <th>Nombres</th>
                  <th>Apellidos</th>
                  <th>Consejo popular</th>
                  <th>Edad</th>
                  <th>Ubicación</th>
                  <th>Acción</th>
                </tr>
              </tfoot>
              <tbody>
              
              <!-- Mostrar los repartos en la tabla -->
              @foreach($evacuados as $evacuado)
                <tr>
                  <td>{{$evacuado->ci}}</td>
                  <td>{{$evacuado->nombres}}</td>
                  <td>{{$evacuado->apellidos}}</td>
                  {{-- De esta forma accedo a el nombre del evento --}}
                  <td>{{$evacuado->reparto->nombre}}</td>
                  <td>{{$evacuado->edad}}</td>
                  <td>{{$evacuado->area->nombre.': '.$evacuado->local}}</td>
                  
                  {{-- Edit y Delete --}}
                  <td class="text-center">
                  	<!-- Delete -->
                    <!-- Capturo el id de cada elemento para poder eliminar -->
                    <form class="d-inline" action="{{action('EvacuadoController@destroy', $evacuado->id)}}" method="POST">
                     
                      {{csrf_field()}}
                      <input name="_method" type="hidden" value="DELETE">

                      <button type="submit" class="btn btn-danger btn-sm">
                    	  <span class="fa fa-times" aria-hidden="true"></span>
                      </button>
                    </form>
                    <!-- End Delete -->
                    
                    <!-- Edit -->
                    <!-- Capturo el id de cada elemento para poder editar -->
                    <a href="{{action('EvacuadoController@edit', $evacuado->id)}}">
                      <button type="submit" class="btn btn-info btn-sm">
                    	  <span class="fa fa-pencil-square-o" aria-hidden="true"></span>
                      </button>
                    </a>
                    <!-- End Edit -->

                  </td>
                </tr>
              @endforeach
              <!-- End mostrar los repartos en la tabla -->

              

              </tbody>
            </table>

        
        @if(isset($evacuado))
        <div class="card-footer small text-muted d-flex">Última actualización:    {{$evacuado->updated_at}}
        
        <a class="ml-auto mr-1 btn-sm btn btn-danger" data-toggle="tooltip" data-placement="top" title="Exportar a: PDF" href="{{ route('evacuados.pdf') }}">
          <i class="fa fa-file-pdf-o"></i>
        </a>
        
        <a class="btn-sm btn btn-success mr-4" data-toggle="tooltip" data-placement="top" title="Exportar a: EXCEL" href="{{ route('evacuados.xls') }}">
          <i class="fa fa-file-excel-o"></i>
        </a>

          
        </div>

        @endif
        
        
      </div>
  </div>
</div> 
@endsection


@section('contentjs')
<!-- Page level plugin JavaScript-->
    <script src="/vendor/datatables/jquery.dataTables.js"></script>
    <script src="/vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for this page-->
    <script src="/js/sb-admin-datatables.js"></script>


<script>
/*
Luego de que por equivocación se hacen varios clic en 
el botón de envío del formulario, una vez que la solicitud 
se envía no podrá enviarse una y otra vez*/
$(document).ready(function() {
    $("form").submit(function() {
        $(this).submit(function() {
            return false;
        });
        return true;
    });
});


/* Custom filtering function which will search data in column four between two values */
$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min = parseInt( $('#min').val(), 10 );
        var max = parseInt( $('#max').val(), 10 );
        var age = parseFloat( data[4] ) || 0; // use data for the age column
 
        if ( ( isNaN( min ) && isNaN( max ) ) ||
             ( isNaN( min ) && age <= max ) ||
             ( min <= age   && isNaN( max ) ) ||
             ( min <= age   && age <= max ) )
        {
            return true;
        }
        return false;
    }
);
 
$(document).ready(function() {
    var table = $('#dataTable').DataTable();
     
    // Event listener to the two range filtering inputs to redraw on input
    $('#min, #max').keyup( function() {
        table.draw();
    } );
  
} );
</script>

<script>
//Function para calcular la edad por CI 
///////////////////////////////////////

  function calcedad(valor) {
    var edad = 0;
    var numero1 = valor[0];
    var numero2 = valor[1];
    var numero1y2 = numero1 + numero2;
    // Convertir el valor a un entero (número). 
    numero1y2 = parseInt(numero1y2);
    //Capturo el año actual
    var today = new Date();
    var year1 = today.getFullYear() - 2000;
    if (numero1y2 > year1) {
        var fnacimiento = 1900 + numero1y2;
    } else {
        var fnacimiento = 2000 + numero1y2;
    }
    //Calculo la edad
    var year = today.getFullYear();
    edad = year - fnacimiento;
    // Colocar el resultado de la edad en el campo edad.
    document.getElementById('edad-e').value = edad;
}

</script>



@endsection