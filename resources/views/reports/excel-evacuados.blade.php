

     <h3 align="center">Evacuados en el ISMMM</h3>
        
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>CI</th>
                  <th>Nombres</th>
                  <th>Apellidos</th>
                  <th>Consejo popular</th>
                  <th>Edad</th>
                  <th>Evento</th>                
                </tr>
              </thead>
              
              <tbody>
              
              <!-- Mostrar los repartos en la tabla -->
              @foreach($evacuados as $evacuado)
                <tr>
                  <td>{{$evacuado->ci}}</td>
                  <td>{{$evacuado->nombres}}</td>
                  <td>{{$evacuado->apellidos}}</td>
                  {{-- De esta forma accedo a el nombre del evento --}}
                  <td>{{$evacuado->reparto->nombre}}</td>
                  <td>{{$evacuado->edad}}</td>
                  <td>{{$evacuado->evento->nombre}}</td>
                               
                </tr>
              @endforeach
              <!-- End mostrar los repartos en la tabla -->
                           
              </tbody>
            </table>
          </div>
          
          

          

          
       



