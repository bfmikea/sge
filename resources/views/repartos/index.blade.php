@extends('layouts.app')

<meta name="_token" content="{{csrf_token()}}" />

@section('content')

<div class="row">
  <div class="col-12">
    
    <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table fa-lg"> <span>Consejos populares</span></i></div>
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
        <form action="" method="POST">
          {{csrf_field()}}
        <div class="form-row justify-content-end d-flex">
          <div class="form-group">
            <label for="name" class="sr-only">Nombre de la comunidad</label>
            <input type="text" class="form-control " name="name" id="name" placeholder="Nombre de la comunidad">
            <input type="hidden" id="reparto_id" name="reparto_id" value="0">
                            
            <button type="submit" class="btn btn-success w-100 mt-2" id="btn-save" value="add">Registrar comunidad</button>
            
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
                  <th>Acciones</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Nombre</th>
                  <th>Acciones</th>
                </tr>
              </tfoot>
              <tbody id="repartos-list" name="repartos-list">
              
              <!-- Mostrar los repartos en la tabla -->
              @foreach($repartos as $reparto)
                <tr id="reparto{{$reparto->id}}">
                  <td>{{$reparto->id}}</td>
                  <td>{{$reparto->nombre}}</td>
                  
                  {{-- Edit y Delete --}}
                  <td class="text-center">
                  	<!-- Delete -->
                    <!-- Capturo el id de cada elemento para poder eliminar -->
                    <form class="d-inline" action="{{action('RepartoController@destroy', $reparto->id)}}" method="POST">
                     
                      {{csrf_field()}}
                      <input name="_method" type="hidden" value="DELETE">

                      <button type="submit" class="btn btn-danger btn-sm">
                        <span class="fa fa-times" aria-hidden="true"></span>
                      </button>
                    </form>
                    <!-- End Delete -->
                    
                    <!-- Edit -->
                    <!-- Capturo el id de cada elemento para poder editar -->
                    <a href="{{action('RepartoController@edit', $reparto->id)}}">
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

        @if(isset($reparto))
        <div class="card-footer small text-muted">Última actualización:    {{$reparto->updated_at}}</div>
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

<script>
  
            
</script>
@endsection