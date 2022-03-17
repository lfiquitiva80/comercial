<div class="modal fade" id="brand">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				
				<h4 class="modal-title">Crear Marca</h4>
				<button brand="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				{!! Form::open(['route' => 'brand.store', 'method'=>'POST','id'=>'FormCreatebrands']) !!}


<div class="form-group" >
        <label for="id">Marca</label>
        {!! Form::text('marca', null,['class' => 'form-control', 'placeholder' => 'Digite la marca','name'=>'marca']) !!}
    </div>



			</div>
			<div class="modal-footer">
				<center><button brand="submit" class="btn btn-primary" >Guardar</button>
    <button brand="reset" class="btn btn-danger">Borrar</button></center><p>
			</div>
	{!! Form::close() !!}		
		</div>
	</div>
</div>