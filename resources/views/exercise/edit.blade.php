<div class="modal fade" id="editar_exercise">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                
                <h4 class="modal-title">ACTUALIZAR</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">

                

<form class="" action="{{route('exercise.update', 'id' )}}"   method="post" id="FormEditexercises">

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
        <label for="id">Dirección</label>
            {!! Form::text('direccion',old('direccion'),['class' => 'form-control','name'=>'direccion','placeholder'=>'Digite la Dirección','id'=>'direccion']) !!}
         
    </div>    
   

    </div>
    </div> {{-- cierre primer row --}}

    <div class="row">

   <div class="col-md-3">
           <div class="form-group" >
        <label for="id">Ciudad</label>
            {!! Form::text('ciudad','BOGOTA',['class' => 'form-control ','name'=>'ciudad','placeholder'=>'Digite la ciudad','id'=>'ciudad']) !!}
         
    </div>

    </div>

    <div class="col-md-3">
     <div class="form-group" >
        <label for="id">Latitud</label>
        {!! Form::text('latitude',null,['class' => 'form-control ','name'=>'latitude','placeholder'=>'Digite la latitud ','id'=>'latitude']) !!}

    </div>

    </div>

    <div class="col-md-3">

             <div class="form-group" >
        <label for="id">Longitud</label>
        {!! Form::text('longitude',null,['class' => 'form-control ','name'=>'longitude','placeholder'=>'Digite la longitud','id'=>'longitude']) !!}
        
    </div>   
    </div>
    <div class="col-md-3">

             <div class="form-group" >
        <label for="id">Mapa</label>
        {!! Form::text('map',null,['class' => 'form-control ','name'=>'map','placeholder'=>'Digite la map','id'=>'map']) !!}
        
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
