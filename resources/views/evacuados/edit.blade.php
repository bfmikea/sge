@extends('layouts.app')


@section('content')


<!-- Breadcrumbs-->
<div class="row">
  <div class="col-12">
    
    <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table fa-lg"> <span>Editar datos de Evacuados</span></i></div>
        <div class="card-body">

        <!-- Notificación que es pasada desde el método store -->
        <div class="col-12">
        @if(session('notification'))
        <div class="alert alert-success">
          {{session('notification')}}
        </div> 
        @endif
        </div>
        
        
      <div class="col .d-flex .justify-content-center pb-3">
             
        
            <!-- Formulario para actualizar un nuevo evento-->
        <form action="{{action('EvacuadoController@update', $id)}}" method="POST">
              {{csrf_field()}}
              
              
              {{-- Campo oculto llamado _method , que será una solicitud PUT|PATCH 
                para el servidor para que podamos actualizar los datos --}}
              <input name="_method" type="hidden" value="PATCH">


          <div class="form-row">

            {{-- Col1 # Identificación, Nombres, Apellidos --}}
            <div class="col-md-4">
                <div class="form-group mx-sm-3">

                    <div class="col">
                      <label for="ci"># Identificación</label>
                      <input type="text" class="form-control mb-2" name="ci" id="ci" value="{{$evacuados->ci}}">
                    </div>
                    
                    <div class="col">
                      <label for="nombres-e">Nombres</label>
                      <input type="text" class="form-control mb-2" name="nombres" id="nombres-e" value="{{$evacuados->nombres}}">
                    </div>

                    <div class="col">
                      <label for="apellidos-e">Apellidos</label>
                      <input type="text" class="form-control mb-2" name="apellidos" id="apellidos-e" value="{{$evacuados->apellidos}}">
                    </div>
                 
                </div>
            </div>

            
            {{-- Col2 Consejo popular, Evento, Sexo, Edad--}}
            
            <div class="col-md-4">

                <div class="form-group mx-sm-3">

                  <div class="col">
                    <label for="inputText2">Consejo popular</label>
                    <select class="form-control mb-2" name="reparto" id="evento">
                      
                      {{-- Recorro los elementos para mostrarlos en el select, voy comparando por medio una if
                     para que el elemento selected se corresponda con el elemento a editar--}}

                       @foreach($repartos as $reparto)
                       <option @if($evacuados->reparto->id==$reparto->id)selected @endif value="{{$reparto->id}}">
                        
                        {{$reparto->nombre}}

                       </option>
                       @endforeach 
                                            
                    </select>
                  </div>

                  <div class="col">
                    <label for="inputText2">Evento</label>
                    <select class="form-control mb-2" name="evento" id="evento" disabled>
                      
                      {{-- Recorro los elementos para mostrarlos en el select, voy comparando por medio una if
                     para que el elemento selected se corresponda con el elemento a editar--}}

                       @foreach($eventos as $evento)
                       <option @if($evacuados->evento->id==$evento->id)selected @endif value="{{$evento->id}}">
                        
                        {{$evento->nombre}}

                       </option>
                       @endforeach
                                        
                    </select>
                  </div>

                  <div class="form-row mx-2">

                    <div class="col-6 form-group">
                      <label for="inputText2">Sexo</label>
                      <select class="form-control mb-2" name="sexo" id="sexo">
                        
                        <option value="masculino" @if($evacuados->sexo =="masculino") selected @endif>Masculino</option>
                        <option value="femenino" @if($evacuados->sexo =="femenino") selected @endif>Femenino</option>
                        <option value="otro" @if($evacuados->sexo =="otro") selected @endif>Otro</option>
                                
                      </select>
                    </div>

                    <div class="col-6 form-group">
                      <label for="edad-e">Edad</label>
                      <input type="text" class="form-control mb-2" name="edad" id="edad-e" value="{{$evacuados->edad}}">
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
                            <option @if($evacuados->area->id==$area->id)selected @endif value="{{$area->id}}">
                        
                            {{$area->nombre}}

                            </option>
                            @endforeach
                          
                          </select>
                        </div>

                        <div class="col-6">
                          <label for="direc" >Cuarto o local</label>
                          <input type="text" class="form-control mb-2" name="local" id="local" value="{{$evacuados->local}}">
                        </div>

                      

                        <div class="col-12">
                          <label for="observaciones">Observaciones</label>
                          <textarea class="form-control" id="observaciones" rows="5" placeholder="Observaciones" name="observaciones">{{$evacuados->observaciones}}</textarea>
                        </div>                       

                  </div>
                        <div class="col pt-2 d-flex justify-content-end">
                          <button type="submit" class="btn btn-success w-50">Guardar</button>
                        </div> 
            </div>   
                    
        </form>
           

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