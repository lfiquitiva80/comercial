<div class="modal fade" id="maker">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				
				<h4 class="modal-title">Crear Fabricante</h4>
				<button maker="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				{!! Form::open(['route' => 'maker.store', 'method'=>'POST','id'=>'FormCreatemakers']) !!}


<div class="form-group" >
        <label for="id">Fabricante</label>
        {!! Form::text('fabricante', null,['class' => 'form-control', 'placeholder' => 'Digite el Fabricante','name'=>'fabricante']) !!}
    </div>



			</div>
			<div class="modal-footer">
				<center><button maker="submit" class="btn btn-primary" >Guardar</button>
    <button maker="reset" class="btn btn-danger">Borrar</button></center><p>
			</div>
	{!! Form::close() !!}		
		</div>
	</div>
</div>