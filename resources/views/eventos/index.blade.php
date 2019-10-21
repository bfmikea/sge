@extends('layouts.app')


@section('content')
<link href="/vendor/jquery-ui/jquery-ui-1.11.4.custom.css" rel="stylesheet">
<link href="/vendor/bootstrap-datepicker/bootstrap-datepicker.standalone.min.css" rel="stylesheet">

<div class="row">
  <div class="col-12">
    
    <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table fa-lg"> <span>Eventos ocurridos</span></i></div>
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

        
                 
          <!-- Formulario para registrar una nueva localidad-->
          <form action="" method="POST" class="">
            {{csrf_field()}}
            
            <div class="form-row justify-content-sm-end justify-content-center"> 
              
              <div class="form-row">
                <div class="form-group">
                  <label for="nombrevento" class="sr-only">Nombre del evento</label>
                  <div class="col">
                    <input type="text" class="form-control mb-2" name="name" id="nombrevento" placeholder="Nombre del evento">
                  </div>

                  <label for="fechaevento" class="sr-only">Fecha del evento</label>
                  <div class="col">
                    <input type="text" class="form-control mb-2" name="fechaevento" id="fechaevento" placeholder="Fecha del evento">
                  </div>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group">
                  <label for="descripcion" class="sr-only">Descripción del evento</label>
                  <div class="col">
                   <textarea class="form-control px-4" id="Textarea1" rows="3" placeholder="Descripción del evento" name="descripcion"></textarea>

                   <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success w-100 mt-2">Registrar evento</button>
                   </div>

                  </div>
                  
                </div>
              </div>
              
            </div>

          </form>
          <!-- End formulario para registrar una nueva localidad-->

        

          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Id</th>
                  <th width="140px">Fecha ocurrencia</th>
                  <th>Nombre</th>
                  <th>Descripción</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Fecha ocurrencia</th>
                  <th>Nombre</th>
                  <th>Descripción</th>
                  <th>Acciones</th>
                </tr>
              </tfoot>
              <tbody>
              
              <!-- Mostrar los repartos en la tabla -->
              @foreach($eventos as $evento)
                <tr>
                  <td>{{$evento->id}}</td>
                  <td>{{$evento->fecha_evento}}</td>
                  <td>{{$evento->nombre}}</td>
                  <td>{{$evento->descripcion}}</td>
                  
                  {{-- Edit y Delete --}}
                  <td class="text-center">
                  	<!-- Delete -->
                    <!-- Capturo el id de cada elemento para poder eliminar -->
                    <form class="d-inline" action="{{action('EventoController@destroy', $evento->id)}}" method="POST">
                     
                      {{csrf_field()}}
                      <input name="_method" type="hidden" value="DELETE">

                      <button type="submit" class="btn btn-danger btn-sm">
                    	  <span class="fa fa-times" aria-hidden="true"></span>
                      </button>
                    </form>
                    <!-- End Delete -->
                    
                    <!-- Edit -->
                    <!-- Capturo el id de cada elemento para poder editar -->
                    <a href="{{action('EventoController@edit', $evento->id)}}">
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
          </div>
        </div>
        @if(isset($evento))
        <div class="card-footer small text-muted">Última actualización:    {{$evento->updated_at}}</div>
        @endif
        
      </div>
  </div>
</div> 
@endsection


@section('contentjs')
<!-- Page level plugin JavaScript-->
    <script src="/vendor/datatables/jquery.dataTables.js"></script>
    <script src="/vendor/datatables/dataTables.bootstrap4.js"></script>
    <script src="/vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<!-- Custom scripts for this page-->
    <script src="/js/sb-admin-datatables.min.js"></script>

<script type="text/javascript">
    // Datepicker de page tarjetas
    $("#fechaevento").datepicker({
        
     });
    
</script>
@endsection