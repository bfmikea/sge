@extends('layouts.app')


@section('content')

<div class="row">
  <div class="col-12">
    
    <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table fa-lg"> <span>Editar integrante de grupo de mando</span></i></div>
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
            <form action="{{action('GrupomandoController@update', $id)}}" method="POST" class="justify-content-center d-flex">
              {{csrf_field()}}
              
              
              {{-- Campo oculto llamado _method , que será una solicitud PUT|PATCH 
                para el servidor para que podamos actualizar los datos --}}
              <input name="_method" type="hidden" value="PATCH">


              <div class="form-group mx-sm-3">
              
                <label for="inputText2">Nombres</label>
                <input type="text" class="form-control mb-2" name="nombres" id="inputText2" value="{{$gruposmando->nombres}}">

                <label for="inputText2">Apellidos</label>
                <input type="text" class="form-control mb-2" name="apellidos" id="inputText2" value="{{$gruposmando->apellidos}}">
              </div>
              
              <div class="form-group mx-sm-3">
                <label for="inputText2">Cargo</label>
                <input type="text" class="form-control mb-2" name="cargo" id="inputText4" value="{{$gruposmando->cargo}}">
                
                <label for="inputText2">Seleccione el evento</label>
                <select class="form-control" name="evento" id="evento">
                   
                {{-- Recorro los elementos para mostrarlos en el select, voy comparando por medio una if
                     para que el elemento selected se corresponda con el elemento a editar 
                  --}}
                   @foreach($eventos as $evento)
                   <option @if($gruposmando->evento->id==$evento->id)selected @endif value="{{$evento->id}}">
                    
                    {{$evento->nombre}}

                   </option>
                   @endforeach 
                        
                </select>
         
                
              </div>

              <div class="form-group align-self-end mx-sm-3 mb-4">      
                <button type="submit" class="btn btn-success ">Guardar cambios</button>
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
   
<!-- Custom scripts for this page-->
    <script src="/js/sb-admin-datatables.min.js"></script>
@endsection