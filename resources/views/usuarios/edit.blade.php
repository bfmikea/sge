@extends('layouts.app')


@section('content')

<div class="row">
  <div class="col-12">
    
    <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table fa-lg"> <span>Editar usuario</span></i></div>
        <div class="card-body">

        <!-- Notificación que es pasada desde el método store -->
        <div class="col-12">
        @if(session('notification'))
        <div class="alert alert-danger">
          {{session('notification')}}
        </div> 
        @endif
        </div>
        
        
        <div class="row d-flex justify-content-center pt-3 pb-5">
             
        
            <!-- Formulario para registrar una nueva localidad-->
            <form action="{{action('UsuarioController@update', $id)}}" method="POST" class="justify-content-center d-flex">
              {{csrf_field()}}
              
              
              {{-- Campo oculto llamado _method , que será una solicitud PUT|PATCH 
                para el servidor para que podamos actualizar los datos --}}
              <input name="_method" type="hidden" value="PATCH">


              <div class="form-group row">
                  <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>

                  <div class="col-md-5 pb-1">
                      <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $usuarios->name }}" required autofocus>

                      @if ($errors->has('name'))
                          <span class="invalid-feedback">
                              <strong>{{ $errors->first('name') }}</strong>
                          </span>
                      @endif
                  </div>

                  <label for="email" class="col-md-4 col-form-label text-md-right">Dirección de correo</label>

                  <div class="col-md-5 pb-1">
                      <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $usuarios->email}}" required>

                      @if ($errors->has('email'))
                          <span class="invalid-feedback">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                      @endif
                  </div>

                  <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>

                  <div class="col-md-5 pb-1">
                      <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">

                      @if ($errors->has('password'))
                          <span class="invalid-feedback">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                      @endif
                  </div>

                 
                  <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmar contraseña</label>

                  <div class="col-md-5 pb-1">
                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                  </div>

                  <label for="rol" class="col-md-4 col-form-label text-md-right">Rol</label>

                  <div class="col-md-5">
                    <select class="form-control mb-2" name="role" id="role">
                      <option value="1" @if($usuarios->role=="1") selected @endif>Gestor de evacuados</option>
                      <option value="0" @if($usuarios->role=="0") selected @endif>Administrador del sistema</option>
                    </select>
                  </div>


                  <div class="col-md-9 d-flex justify-content-end">
                      <button type="submit" class="btn btn-primary">
                          Guardar cambios
                      </button>
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
   
<!-- Custom scripts for this page-->
    <script src="/js/sb-admin-datatables.min.js"></script>
@endsection