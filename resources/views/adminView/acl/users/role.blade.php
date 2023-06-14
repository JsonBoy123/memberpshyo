@extends('dashboard.layouts.master')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Assign Role</h1>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Assign Role <a href="{{url('acl/user')}}" class="btn btn-sm btn-primary pull-right">Back</a></h5>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-12 mb-3">
						<h5 class="">User Name:- {{$user->name}}</h5>
					</div>
					{{Form::open(array('url' => '/acl/user/role_assign', 'method' => 'post'))}}

						@csrf
						<div class="col-md-12 form-group">
							@foreach($roles as $role)
								{{Form::checkbox('roles[]',$role->id, in_array($role->id,$user->roles->pluck('id')->toArray()) ? true : null )}} {{$role->display_name}}
								<br>
							@endforeach	
						</div>
						<div class="col-md-12 mt-4">
							{{Form::hidden('user_id',$user->id)}}
							{{Form::submit('Submit',['class' => 'btn btn-sm btn-success'])}}							
						</div>
					{{Form::close()}}				
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	@if($message = Session::get('success'))
    	alert('{{$message}}');
	@endif
</script>
@endsection