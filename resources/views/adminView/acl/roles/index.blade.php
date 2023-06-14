@extends('dashboard.layouts.master')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Role</h1>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Roles <a href="{{url('/acl/role/create')}}" class="btn btn-sm btn-primary pull-right">Add Role</a></h4>
			</div>
			<div class="card-body">
				@if($message = Session::get('success'))
				    <div class="alert alert-success">
				        {{$message}}
				    </div>
				@endif
				<table class="table table-bordered table-striped myTable">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Display Name</th>
							<th>Description</th>
							<th>Created At</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($roles as $role)
							<tr>
								<td>{{$role->id}}</td>
								<td>{{$role->name}}</td>
								<td>{{$role->display_name}}</td>
								<td>{{$role->description}}</td>
								<td>{{$role->created_at}}</td>
								<td>
									<a href="{{url('acl/role/'.$role->id.'/edit')}}" ><i class="fa fa-edit text-success"></i></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script >
	$(document).ready(function () {
    	$('.myTable').DataTable();
	});
</script>
@endsection