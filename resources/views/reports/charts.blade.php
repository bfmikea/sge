@extends('layouts.app')



@section('content')

<div class="row">
  <div class="col-md-6">
    <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-line-chart"> <span span class="h6">Cantidad de evacuados por eventos ocurridos.</span></i>
        </div>
        
            <div class="ml-md-3">
                {!! $chart1->container() !!}
            </div>
         

            {!! $chart1->script() !!}

    </div>
  </div> 

  <div class="col-md-6">
    <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-pie-chart"> <span class="h6">Localidaes con mayor cantidad de evacuados.</span></i>
        </div>
        
            <div class="ml-md-3">
                {!! $chart2->container() !!}
            </div>
         

            {!! $chart2->script() !!}

    </div>
  </div>   
</div> 
@endsection


@section('contentjs')
<!-- Page level plugin JavaScript-->
    <script src="/vendor/datatables/jquery.dataTables.js"></script>
    <script src="/vendor/datatables/dataTables.bootstrap4.js"></script>
    <script src="/vendor/chart.js/2.7.1/chart.min.js" charset="utf-8"></script>
<!-- Custom scripts for this page-->
    <script src="/js/sb-admin-datatables.min.js"></script>


@endsection