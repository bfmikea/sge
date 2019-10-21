@extends('layouts.app')


@section('content')

<!-- Breadcrumbs-->
<div class="row">
  <div class="col-12">
    
    <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table fa-lg"> <span>Grupos de mando</span></i></div>
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
          
          <div class="form-row">
            <div class="form-group mx-sm-3 mb-0">

              <label for="inputText2" class="sr-only">Nombres</label>
              <input type="text" class="form-control mb-2" name="nombres" id="inputText2" placeholder="Nombres">

              <label for="inputText2" class="sr-only">Apellidos</label>
              <input type="text" class="form-control mb-2" name="apellidos" id="inputText3" placeholder="Apellidos">
            </div>
            <div class="form-group mx-sm-3">
              <label for="inputText2" class="sr-only">Cargo</label>
              <input type="text" class="form-control mb-2" name="cargo" id="inputText4" placeholder="Cargo">
              
              <select class="form-control" name="evento" id="evento">
                <option value="">
  				Selecciona un evento
                </option>
                
                @foreach($eventos as $evento)
  				
  			  <option value="{{$evento->id}}">{{$evento->nombre}}
                </option>

                @endforeach 
                        
              </select>

             <button type="submit" class="btn btn-success mt-2 w-100 ">Registrar integrante</button>
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
                  <th width="140px">Nombres</th>
                  <th>Apellidos</th>
                  <th>Cargo</th>
                  <th>Evento</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Id</th>
                  <th width="140px">Nombres</th>
                  <th>Apellidos</th>
                  <th>Cargo</th>
                  <th>Evento</th>
                  <th>Acciones</th>
                </tr>
              </tfoot>
              <tbody>
              
              <!-- Mostrar los repartos en la tabla -->
              @foreach($gruposmando as $grupomando)
                <tr>
                  <td>{{$grupomando->id}}</td>
                  <td>{{$grupomando->nombres}}</td>
                  <td>{{$grupomando->apellidos}}</td>
                  <td>{{$grupomando->cargo}}</td>
                  {{-- De esta forma accedo a el nombre del evento --}}
                  <td>{{$grupomando->evento->nombre}}</td>
                  
                  {{-- Edit y Delete --}}
                  <td class="text-center">
                  	<!-- Delete -->
                    <!-- Capturo el id de cada elemento para poder eliminar -->
                    <form class="d-inline" action="{{action('GrupomandoController@destroy', $grupomando->id)}}" method="POST">
                     
                      {{csrf_field()}}
                      <input name="_method" type="hidden" value="DELETE">

                      <button type="submit" class="btn btn-danger btn-sm">
                    	  <span class="fa fa-times" aria-hidden="true"></span>
                      </button>
                    </form>
                    <!-- End Delete -->
                    
                    <!-- Edit -->
                    <!-- Capturo el id de cada elemento para poder editar -->
                    <a href="{{action('GrupomandoController@edit', $grupomando->id)}}">
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
        @if(isset($grupomando))
        <div class="card-footer small text-muted">Última actualización:    {{$grupomando->updated_at}}</div>
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