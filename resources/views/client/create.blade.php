<div class="modal fade" id="client">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				
				<h4 class="modal-title">Crear Cliente</h4>
				<button client="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				{!! Form::open(['route' => 'client.store', 'method'=>'POST','id'=>'FormCreateclients']) !!}


<div class="form-group" >
        <label for="id">Cliente</label>
        {!! Form::text('cliente', null,['class' => 'form-control', 'placeholder' => 'Digite el cliente nuevo']) !!}
    </div>



			</div>
			<div class="modal-footer">
				<center><button client="submit" class="btn btn-primary" >Guardar</button>
    <button client="reset" class="btn btn-danger">Borrar</button></center><p>
			</div>
	{!! Form::close() !!}		
		</div>
	</div>
</div>