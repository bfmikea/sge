@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">Dashboard</div>
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

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h6>Bienvenido {{ Auth::user()->name }}.</h6><br> <p>A su izquierda, encontrará todas las opciones que le permitirán usar el sistema para la gestión del personal evacuado en el ISMMM.</p> 
                    <p>Esperemos que sea de su agrado.</p> 
                    Atte.<br>
                    <a href='http://di.ismm.edu.cu'>Equipo de soporte</a>

                    <div class="row pt-4">
                        <div class="col-sm-6 mb-3">
                        <div class="card text-white bg-danger o-hidden h-100">
                        <div class="card-body">
                        <div class="card-body-icon">
                        <i class="fa fa-fw fa-list"></i>
                        </div>
                        <div class="mr-5 h6">Evacuados!</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="/evacuados">
                        <span class="float-left">Ver Detalles</span>
                        <span class="float-right">
                        <i class="fa fa-angle-right"></i>
                        </span>
                        </a>
                        </div>
                        </div>

                        <div class="col-sm-6 mb-3">
                        <div class="card text-white bg-primary o-hidden h-100">
                        <div class="card-body">
                        <div class="card-body-icon">
                        <i class="fa fa-fw fa-charts"></i>
                        </div>
                        <div class="mr-5 h6">Gráficos!</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="/charts">
                        <span class="float-left">Ver Detalles</span>
                        <span class="float-right">
                        <i class="fa fa-angle-right"></i>
                        </span>
                        </a>
                        </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
