@extends('layouts.default')

@section('content')

	<div class="row">
		<div class="col=lg=12 margin-tb">
			<div class="pull-left">
				<h2>Tasks CRUD</h2>
			</div>
			
			<div class="pull-right">
				<a class="btn btn-success" href="{{ route('taskCRUD.create') }}">Create new Task</a>
			</div>
		</div>
	</div>
	
	
	@if ($message = Session::get('success'))
		<div class="alert alert-success">
			<p>{{ $message }}</p>
		</div>
	@endif
	
	<table class="table table-bordered">
		<tr>
           <th>No</th>
           <th>Name</th>
           <th width="280px">Action</th>
		</tr>
		
		@foreach($tasks as $key => $task) <!--Go through each task in the tasks array -->
			<tr>
				<td>{{ ++$i }}</td>
				<td>{{ $task->name }} </td>
				
				<td>
					<a class="btn btn-info" href="{{ route('taskCRUD.show', $task->id) }}">Show</a>
					<a class="btn btn-primary" href="{{ route('taskCRUD.edit', $task->id) }}">Edit</a>
						<!--These forms are defined using html but also using Laravel's collective!-->
						{!! Form::open(['method' => 'DELETE', 'route' => ['taskCRUD.destroy', $task->id],'style'=>'display:inline']) !!}
							{!! Form::submit('Delete', ['class'=> 'btn btn-danger']) !!}
								{!! Form::close() !!}
				</td>
			</tr>
			@endforeach
	</table>
	
	{!! $tasks->render() !!}
	
@endsection