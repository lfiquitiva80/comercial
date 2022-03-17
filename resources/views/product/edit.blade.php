<div class="modal fade" id="editar_product">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                
                <h4 class="modal-title">ACTUALIZAR</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">

                

<form class="" action="{{route('product.update', 'id' )}}"   method="post" id="FormEditproducts">

  {{method_field('patch')}}
  {{csrf_field()}}

<input type="hidden" id="id"  name="id" value="">

<div class="row">

    <div class="col-md-3">
    <div class="form-group" >
        <label for="id">Año</label>
        {!! Form::select('year_id',$year,  old('year_id') , ['class' => 'form-control','name'=>'year_id' ,'id'=>'year_id','placeholder'=>'Seleccione...']) !!}
    </div>

    </div>
    <div class="col-md-3">
    <div class="form-group" >
        <label for="id">Mes</label>
            {!! Form::select('month_id',$mes,  old('month_id') , ['class' => 'form-control','name'=>'month_id','id'=>'month_id','placeholder'=>'Seleccione...']) !!}
         </div>    
    </div>


    <div class="col-md-3">

    <div class="form-group" >
        <label for="id">Cliente</label>
            {!! Form::select('client_id',$cliente, old('client_id') , ['class' => 'form-control client_id_create','name'=>'client_id','id'=>'client_id']) !!}
            <a data-toggle="modal" href='#client'><i class="fas fa-plus-circle"></i> Add Cliente</a>
    </div>    

    </div>


    <div class="col-md-3">

    <div class="form-group" >
        <label for="id">Linea</label>
            {!! Form::select('line_id',$linea, old('line_id') , ['class' => 'form-control','name'=>'line_id','id'=>'line_id','placeholder'=>'Seleccione...']) !!}
    </div>    

    </div>
    </div> {{-- cierre primer row --}}

    <div class="row">

    <div class="col-md-3">
    <div class="form-group" >
        <label for="id">Fabricante</label>
        {!! Form::select('marker_id',$maker,  old('marker_id') , ['class' => 'form-control','name'=>'marker_id','id'=>'marker_id' ,'placeholder'=>'Seleccione...']) !!}
        <a data-toggle="modal" href='#maker'><i class="fas fa-plus-circle"></i> Add Fabricante</a>

    </div>

    </div>

    <div class="col-md-3">
    <div class="form-group" >
        <label for="id">Marca</label>
        {!! Form::select('brand_id',$marca,  old('brand_id') , ['class' => 'form-control','name'=>'brand_id','id'=>'brand_id' ,'placeholder'=>'Seleccione...']) !!}
        <a data-toggle="modal" href='#brand'><i class="fas fa-plus-circle"></i> Add Marca</a>
    </div>

    </div>

    <div class="col-md-3">
    <div class="form-group" >
        <label for="id">Presentación</label>
        {!! Form::select('presentation_id',$presentacion,  old('presentation_id') , ['class' => 'form-control','name'=>'presentation_id','id'=>'presentation_id' ,'placeholder'=>'Seleccione...']) !!}
        <a data-toggle="modal" href='#presentation'><i class="fas fa-plus-circle"></i> Add Presentación</a>
    </div>

    </div>
    <div class="col-md-3">
    <div class="form-group" >
        <label for="id">Precio-Iva </label>
        {!! Form::number('precio_iva', 0,['class' => 'form-control', 'placeholder' => 'Digite el precio','name'=>'precio_iva','id'=>'precio_iva']) !!}
    </div>

    </div>
    </div> {{-- cierre segundo row --}}

    <div class="form-group">
    <label for="id">Observaciones</label>
   {!! Form::textarea('observaciones', null, ['class' => 'form-control', 'placeholder' => 'Digite una Observación','name'=>'observaciones','id'=>'observaciones']) !!}
    </div>  

     <div class="form-group" >
        <label for="id">Usuario</label>
        {!! Form::select('user_id',$user,  \Auth::id() , ['class' => 'form-control','name'=>'user_id' ,'placeholder'=>'Seleccione...']) !!}
    </div>


    <center><button type="submit" class="btn btn-primary" >Actualizar</button>
    <button type="button" class="btn btn-default "data-dismiss="modal" >Cerrar</button></center><p>

</form>



  </div>
</div>

</div>
</div>
