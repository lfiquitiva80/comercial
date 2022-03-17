<div class="modal fade" id="presentation">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				
				<h4 class="modal-title">Crear Presentaciòn</h4>
				<button presentation="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				{!! Form::open(['route' => 'presentation.store', 'method'=>'POST','id'=>'FormCreatepresentations']) !!}


<div class="form-group" >
        <label for="id">Presentación</label>
        {!! Form::text('presentacion', null,['class' => 'form-control', 'placeholder' => 'Digite la Presentación','name'=>'presentacion']) !!}
    </div>



			</div>
			<div class="modal-footer">
				<center><button presentation="submit" class="btn btn-primary" >Guardar</button>
    <button presentation="reset" class="btn btn-danger">Borrar</button></center><p>
			</div>
	{!! Form::close() !!}		
		</div>
	</div>
</div>