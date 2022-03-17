
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
    <h3 class="panel-title">Consulta por rango de fechas</h3>
  </div>
  <div class="panel-body">
       {!! Form::open(['route' => 'consultacomercial', 'method'=>'GET', 'Class'=>'form-inline']) !!}
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

<h4><b><center>REGISTROS DE CHEQUEO DE PRECIOS</h4></b></center>

<h1>Total de Registros: <p class="text-primary">{{ $products->total()}}</p></h1>


<a class="btn btn-info" data-toggle="modal" href='#product'><i class="fas fa-plus-circle"></i> Crear Chequeo de Precios     </a>

{{-- <a href="#" class="btn btn-success"><i class="fas fa-file-excel"></i> Download Excel</a> --}}



  @include('product.create')

  @include('product.edit')

  @include('product.show')

  @include('maker.create')

  @include('brand.create')

  @include('presentation.create')

  @include('client.create')


<p>
<div class="table table-sm table-responsive">
<table class="table table-hover" >
  <thead>
    <tr>
      <td>  id  </td>
      <td>  Año </td>
      <td>  Mes</td>
      <td>  Cliente</td>
      <td>  Linea</td>
      <td>  Fabricante</td>
      <td>  Marca</td>
      <td>  Presenatción</td>
      <td>  Precio_Iva</td>
      <td>  Observaciones</td>
      <td>  Reg_usuario</td>
      <td>  Fecha de creación</td>
      <td>  Fecha de actualización</td>
      <td colspan="2">  Acciones</td>




    </tr>
  </thead>
  <tbody>

  @foreach($products as $row)
    <tr>

            <td>{{$row->id}}</td>
      			<td>{{$row->year->anio}}</td>
      			<td>{{$row->month->mes}}</td>
      			<td>{{$row->client->cliente}}</td>
      			<td>{{$row->line->linea}}</td>
      			<td>{{$row->marker->fabricante}}</td>
      			<td>{{$row->brand->marca}}</td>
      			<td>{{$row->presentation->presentacion}}</td>
      			<td>$ {{$row->precio_iva}}</td>
      			<td>{{$row->observaciones}}</td>
      			<td>{{$row->user->name}}</td>
      			<td>{{$row->created_at}}</td>
      			<td>{{$row->updated_at}}</td>




          



          <td><a   data-toggle="modal" data-target="#editar_product" data-id="{{$row->id}}"
            data-year_id="{{$row->year_id}}"
            data-month_id="{{$row->month_id}}"
            data-client_id="{{$row->client_id}}"
            data-line_id="{{$row->line_id}}"
            data-marker_id="{{$row->marker_id}}"
            data-brand_id="{{$row->brand_id}}"
            data-presentation_id="{{$row->presentation_id}}"
            data-precio_iva="{{$row->precio_iva}}"
            data-observaciones="{{$row->observaciones}}"
            data-user_id="{{$row->user_id}}"
            data-created_at="{{$row->created_at}}"
            data-updated_at="{{$row->updated_at}}" class="btn btn-default"



           ><i class="fas fa-eye" aria-hidden="true"></i>Editar</td></a> 
</td>
     

          <td>@include('product.destroy')</td>

       
        </td>

    </tr>
  </tbody>

  @endforeach


</table>
</div>

<center>{{ $products->links() }}</center>

</div>

</div>



@section('js')
    <script> 

      $(document).ready(function() {

$('#editar_product').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var id = button.data('id')
  var year_id = button.data('year_id')
  var month_id = button.data('month_id')
  var client_id = button.data('client_id')
  var line_id = button.data('line_id')
  var marker_id = button.data('marker_id')
  var brand_id = button.data('brand_id')
  var presentation_id = button.data('presentation_id')
  var precio_iva = button.data('precio_iva')
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
modal.find('.modal-body #line_id').val(line_id);
modal.find('.modal-body #marker_id').val(marker_id);
modal.find('.modal-body #brand_id').val(brand_id);
modal.find('.modal-body #presentation_id').val(presentation_id);
modal.find('.modal-body #precio_iva').val(precio_iva);
modal.find('.modal-body #observaciones').val(observaciones);
modal.find('.modal-body #user_id').val(user_id);


})


$(".client_id_create").select2();


});
        
     

    </script>
@stop



    @endsection

