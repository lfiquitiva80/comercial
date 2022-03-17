<div class="modal fade" id="exercise">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                
                <h4 class="modal-title">Registro de Actividades de <strong>{{ \Auth::user()->name}}</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">

                         <h2>Sus coordenadas son:</h2>

<button onclick="getLocation()" class="btn btn-danger"><i class="fas fa-map-marked-alt"></i> Click Aqui</button>

            <p id="demo"></p>          



                {!! Form::open(['route' => 'exercise.store', 'method'=>'POST','id'=>'FormCreateexercises']) !!}

    <div class="row">

    <div class="col-md-3">
    <div class="form-group" >
        <label for="id">Año</label>
        {!! Form::select('year_id',$year,  3, ['class' => 'form-control','name'=>'year_id' ,'placeholder'=>'Seleccione...']) !!}
    </div>

    </div>
    <div class="col-md-3">
    <div class="form-group" >
        <label for="id">Mes</label>
            {!! Form::select('month_id',$mes,  \Carbon\Carbon::now()->month , ['class' => 'form-control','name'=>'month_id','placeholder'=>'Seleccione...']) !!}
         </div>    
    </div>


    <div class="col-md-3">

    <div class="form-group" >
        <label for="id">Cliente</label>
            {!! Form::select('client_id',$cliente, 288 , ['class' => 'form-control client_id_create','name'=>'client_id','placeholder'=>'Seleccione...']) !!}
            <a data-toggle="modal" href='#client'><i class="fas fa-plus-circle"></i> Add Cliente</a>
    </div>    

    </div>

        <div class="col-md-3">

    <div class="form-group" >
        <label for="id">Dirección</label>
            {!! Form::text('direccion',null,['class' => 'form-control','name'=>'direccion','placeholder'=>'Digite la Dirección']) !!}
         
    </div>    

    </div>

    </div> {{-- cierre primer row --}}

    <div class="row">

    <div class="col-md-3">
           <div class="form-group" >
        <label for="id">Ciudad</label>
            {!! Form::text('ciudad','BOGOTA',['class' => 'form-control ','name'=>'ciudad','placeholder'=>'Digite la ciudad']) !!}
         
    </div>

    </div>

    <div class="col-md-3">
     <div class="form-group" >
        <label for="id">Latitud</label>
        {!! Form::text('latitude',null,['class' => 'form-control ','name'=>'latitude','placeholder'=>'Digite la latitud ','id'=>'latitude','readonly']) !!}

    </div>

    </div>

    <div class="col-md-3">

             <div class="form-group" >
        <label for="id">Longitud</label>
        {!! Form::text('longitude',null,['class' => 'form-control ','name'=>'longitude','placeholder'=>'Digite la longitud','id'=>'longitude', 'readonly']) !!}
        
    </div>   
    </div>
    <div class="col-md-3">

             <div class="form-group" >
        <label for="id">Mapa</label>
        {!! Form::text('map',null,['class' => 'form-control ','name'=>'map','placeholder'=>'Digite la map']) !!}
        
    </div>  

    </div>
    </div> {{-- cierre segundo row --}}

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

        </div>
    </div>
    <div class="form-group">
    <label for="id">Observaciones</label>
   {!! Form::textarea('observaciones', null, ['class' => 'form-control', 'placeholder' => 'Digite una Observación','name'=>'observaciones']) !!}
    </div>  

     <div class="form-group" >
        <label for="id">Usuario</label>
        {!! Form::select('user_id',$user,  \Auth::id() , ['class' => 'form-control','name'=>'user_id' ,'placeholder'=>'Seleccione...']) !!}
    </div>



            <div class="modal-footer">
   

                <center><button type="submit" class="btn btn-primary" >Guardar</button>
    <button type="reset" class="btn btn-danger">Borrar</button></center><p>
            </div>
    {!! Form::close() !!}       
        </div>
    </div>
</div>

</div>
