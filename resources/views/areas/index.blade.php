@extends('layouts.app')


@section('content')
<!-- Breadcrumbs-->
<div class="row">
  <div class="col-12">
    
    <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table fa-lg"> <span>Áreas de evacuación</span></i></div>
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

            
        
        <div class="col-12 d-flex justify-content-end pb-3">
             
        
        <!-- Formulario para registrar una nueva localidad-->
        <form action="" method="POST" class="d-flex">
          {{csrf_field()}}
          <div class="form-row justify-content-center">
            <div class="form-group mx-sm-3">
              <label for="inputPassword2" class="sr-only">Nombre del área</label>
              <input type="text" class="form-control mb-2" name="name" id="inputText2" placeholder="Nombre del área">


              <label for="Textarea1" class="sr-only">Descripción del área</label>
              <textarea class="form-control" id="Textarea1" rows="2" placeholder="Descripción del área" name="descripcion"></textarea>
              
              <div class="justify-content-end d-flex">
                <button type="submit" class="btn btn-success mt-2 w-100">Registrar área</button>
              </div>
            </div>
                  
          </div>
        </form>
        <!-- End formulario para registrar una nueva localidad-->


          </div>
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Nombre</th>
                  <th>Descripción</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Nombre</th>
                  <th>Descripción</th>
                  <th>Acciones</th>
                </tr>
              </tfoot>
              <tbody>
              
              <!-- Mostrar los repartos en la tabla -->
              @foreach($areas as $area)
                <tr>
                  <td>{{$area->id}}</td>
                  <td>{{$area->nombre}}</td>
                  <td>{{$area->descripcion}}</td>
                  
                  {{-- Edit y Delete --}}
                  <td class="text-center">
                  	<!-- Delete -->
                    <!-- Capturo el id de cada elemento para poder eliminar -->
                    <form class="d-inline" action="{{action('AreaController@destroy', $area->id)}}" method="POST">
                     
                      {{csrf_field()}}
                      <input name="_method" type="hidden" value="DELETE">

                      <button type="submit" class="btn btn-danger btn-sm">
                    	  <span class="fa fa-times" aria-hidden="true"></span>
                      </button>
                    </form>
                    <!-- End Delete -->
                    
                    <!-- Edit -->
                    <!-- Capturo el id de cada elemento para poder editar -->
                    <a href="{{action('AreaController@edit', $area->id)}}">
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
        @if(isset($area))
        <div class="card-footer small text-muted">Última actualización:    {{$area->updated_at}}</div>
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
    <script src="/js/sb-admin-datatables.min.js"></script>
@endsection