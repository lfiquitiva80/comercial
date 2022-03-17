{!! Form::open(['route' => ['exercise.destroy', $row->id],'method'=>'DELETE']) !!}


<button  onclick="return confirm('Esta seguro de Eliminar el exercise')"><i class="fa fa-trash" aria-hidden="true"></i> Delete </button>
{!! Form::close() !!}