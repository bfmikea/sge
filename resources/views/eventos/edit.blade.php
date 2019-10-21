@extends('layouts.app')


@section('content')
<link href="/vendor/jquery-ui/jquery-ui-1.11.4.custom.css" rel="stylesheet">
<link href="/vendor/bootstrap-datepicker/bootstrap-datepicker.standalone.min.css" rel="stylesheet">
<div class="row">
  <div class="col-12">
    
    <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table fa-lg"> <span>Editar evento ocurrido</span></i></div>
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

        
        
        
        <div class="col-12 d-flex justify-content-center pt-3 pb-5">
             
        
            <!-- Formulario para registrar una nueva localidad-->
            <form action="{{action('EventoController@update', $id)}}" method="POST" class="justify-content-center d-flex">
              {{csrf_field()}}
              
              
              {{-- Campo oculto llamado _method , que será una solicitud PUT|PATCH 
                para el servidor para que podamos actualizar los datos --}}
              <input name="_method" type="hidden" value="PATCH">


              <div class="form-group mx-sm-3">
              
                <label for="inputText2">Nombre del evento</label>
                <input type="text" class="form-control mb-2" name="name" id="inputText2" value="{{$eventos->nombre}}">

                <label for="fechaevento">Fecha del evento</label>
                <input type="text" class="form-control mb-2" name="fechaevento" id="fechaevento" value="{{$eventos->fecha_evento}}">

                <label for="Textarea1">Descripción del evento</label>
                <textarea class="form-control mb-2" id="Textarea1" rows="4" placeholder="Descripción del evento" name="descripcion">{{$eventos->descripcion}}</textarea>

                <div class="form-group">      
                <button type="submit" class="btn btn-success w-100">Guardar cambios</button>
                </div> 
                
              </div>

              
              
              
            </form>
            <!-- End formulario para registrar una nueva localidad-->
        </div>
          
        </div>
        
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