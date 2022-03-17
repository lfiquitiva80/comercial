
  @extends('adminlte::page')



    @section('content')

        
        <div class="panel-body">




          @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif




{{-- {!! Form::open(['route' => 'product.index', 'method'=>'GET', 'Class'=>'navbar-form navbar-right']) !!}
<!--<form class="navbar-form navbar-right" role="search">-->
  <div class="form-group">
    <input type="text" class="form-control" placeholder="Search" name="nombre" id="nombre">
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
{!! Form::close() !!} --}}
<div class="container">
<div class="panel panel-success">
  <div class="panel-heading">
    <h3 class="panel-title">CONSULTA POR RANGO DE FECHAS</h3>
  </div>
  <div class="panel-body">
       {!! Form::open(['route' => 'geolocalizacion', 'method'=>'GET', 'Class'=>'form-inline']) !!}
            <label>&nbsp; Fecha Inicial: </label>
            {!! Form::date('fecha', \Illuminate\Support\Carbon::now(), ['class' => 'form-control','name'=>'fecha','required']) !!}
            <label>&nbsp;  Fecha Final: </label>
            {!! Form::date('fechafinal', \Illuminate\Support\Carbon::now(), ['class' => 'form-control','name'=>'fechafinal','required']) !!}&nbsp; 
        <button type="submit" class="btn btn-success"><i class="far fa-file-excel"></i> Excel</button>
        {!! Form::close() !!}

  </div>
</div>

</p>
</p>
</p>
</p>

</div>
<hr>


  



<div class="panel panel-default">

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
        <a class="btn btn-link" data-toggle="modal" href='#product2'><i class="fas fa-plus-circle"></i> Registrar Otro Chequeo de Precios     </a>

    </div>
@endif  

<h4><b><center>Registro de Actividades Vendedores</h4></b></center>



<h1>Total de Registros: <p class="text-primary">{{ $exercises->total()}}</p></h1>


<a class="btn btn-info" data-toggle="modal" href='#exercise'><i class="fas fa-plus-circle"></i> Crear Actividad Diaria    </a>

{{-- <a href="#" class="btn btn-success"><i class="fas fa-file-excel"></i> Download Excel</a> --}}



  @include('exercise.create')
  @include('exercise.edit')


<p>
<div class="table table-sm table-responsive">
<table class="table table-condensed" > 
  <thead>
    <tr>

      <td>  id  </td>
      <td>  Año </td>   
      <td>  Mes</td>
      <td>  Cliente</td>
      <td>  Dirección</td>
      <td>  Ciudad</td>
      <td>  Latitud</td>
      <td>  Longitud</td>
      <td>  Mapa</td>
      <td>  Observaciones</td>
      <td>  Reg_usuario</td>
      <td>  Fecha de creación</td>
      <td>  Fecha de actualización</td>
      <td colspan="2">  Acciones</td>




    </tr>
  </thead>
  <tbody>

  @foreach($exercises as $row)
    <tr>

            <td>{{$row->id}}</td>
                <td>{{$row->year->anio}}</td>
                <td>{{$row->month->mes}}</td>
                <td>{{$row->client->cliente}}</td>
                <td>{{$row->direccion}}</td>
                <td>{{$row->ciudad}}</td>
                <td>{{$row->latitude}}</td>
                <td>{{$row->longitude}}</td>
                <td>{{$row->map}}</td>
                <td>{{$row->observaciones}}</td>
                <td>{{$row->user->name}}</td>
                <td>{{$row->created_at}}</td>
                <td>{{$row->updated_at}}</td>




          



          <td><a   data-toggle="modal" data-target="#editar_exercise" data-id="{{$row->id}}"
            data-year_id="{{$row->year_id}}"
            data-month_id="{{$row->month_id}}"
            data-client_id="{{$row->client_id}}"
            data-direccion="{{$row->direccion}}"
            data-ciudad="{{$row->ciudad}}"
            data-latitude="{{$row->latitude}}"
            data-longitude="{{$row->longitude}}"
            data-map="{{$row->map}}"
            data-observaciones="{{$row->observaciones}}"
            data-user_id="{{$row->user_id}}"
            data-created_at="{{$row->created_at}}"
            data-updated_at="{{$row->updated_at}}" class="btn btn-default"



           ><i class="fas fa-eye" aria-hidden="true"></i>Editar</td></a> 
</td>
     

          <td>@include('exercise.destroy')</td>

       
        </td>

    </tr>
  </tbody>

  @endforeach


</table>
</div>

<center>{{ $exercises->links() }}</center>

</div>

</div>



@section('js')
    <script> 

      $(document).ready(function() {

$('#editar_exercise').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var id = button.data('id')
  var year_id = button.data('year_id')
  var month_id = button.data('month_id')
  var client_id = button.data('client_id')
  var direccion = button.data('direccion')
  var ciudad = button.data('ciudad')
  var latitude = button.data('latitude')
  var longitude = button.data('longitude')
  var map = button.data('map')
  var observaciones = button.data('observaciones')
  var user_id = button.data('user_id')




// Extract info from data-* attributes
// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
var modal = $(this)
modal.find('.modal-body #id').val(id);
modal.find('.modal-body #year_id').val(year_id);
modal.find('.modal-body #month_id').val(month_id);
modal.find('.modal-body #client_id').val(client_id);
modal.find('.modal-body #direccion').val(direccion);
modal.find('.modal-body #ciudad').val(ciudad);
modal.find('.modal-body #latitude').val(latitude);
modal.find('.modal-body #longitude').val(longitude);
modal.find('.modal-body #map').val(map);
modal.find('.modal-body #observaciones').val(observaciones);
modal.find('.modal-body #user_id').val(user_id);


})


$(".client_id_create").select2();


});

var x = document.getElementById("demo");

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
  x.innerHTML = "Latitude: " + position.coords.latitude + 
  "<br>Longitude: " + position.coords.longitude;
  document.getElementById("latitude").value= position.coords.latitude;
  document.getElementById("longitude").value=position.coords.longitude;

function positionError(error) {
                alert('ERROR');
                switch (error.code) {
                    case error.PERMISSION_DENIED:
                        document.getElementById('theError').innerHTML = "User denied the request for Geolocation."
                        break;
                    case error.POSITION_UNAVAILABLE:
                        document.getElementById('theError').innerHTML = "Location information is unavailable."
                        break;
                    case error.TIMEOUT:
                        document.getElementById('theError').innerHTML = "The request to get user location timed out."
                        break;
                    case error.UNKNOWN_ERROR:
                        document.getElementById('theError').innerHTML = "An unknown error occurred."
                        break;
                }
            }  

}
</script>      


        
     

    </script>
@stop



    @endsection

