@extends('dashboard.layouts.master')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">User</h1>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Users <a href="{{url('acl/user/create')}}" class="btn btn-sm btn-primary pull-right">Add User</a></h4>
			</div>
			<div class="card-body">
				@if($message = Session::get('success'))
				    <div class="alert alert-success">
				        {{$message}}
				    </div>
				@endif

				<table class="table table-bordered table-striped" id="myTable">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Email</th>
							<th>Mobile</th>
							<th>Status</th>
							<th>Created At</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($users as $user)
							<tr>
								<td>{{$user->id}}</td>
								<td>{{$user->name}}</td>
								<td>{{$user->email}}</td>
								<td>{{$user->phone}}</td>
								<td>{{$user->email_verified_at != null ? 'Email Verified' : 'Pending For Email Verifying'}}
									<br>
									<br>
									{{$user->phone_verified_at != null ? 'Mobile Verified' : 'Pending For Mobile Verifying'}}
								</td>
								<td>{{date('Y-m-d',strtotime($user->created_at))}}</td>
								<td>
									<a href="{{url('/acl/user/'.$user->id.'/edit')}}" class="mr-2"> <i class="fa fa-edit text-success"></i> </a>
									<div class="dropdown pull-right">
										<button class="btn btn-sm btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fa fa-gear"></i>
										</button>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a class="dropdown-item" href="{{url('/acl/user/role/'.$user->id)}}">Assign Role</a>
										<a class="dropdown-item" href="{{url('/acl/user/permission/'.$user->id)}}">Assign Permission</a>
										</div>
									</div>
									{{-- <ul class="dropdown" style="float: right;" >
								 		<a class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown">
								 			<i class="fa fa-gear" ></i>
								 		</a>
								 		<div class="dropdown-menu" style="left: -90px;color:black">
								 			<li class=dropdown-item>
								 				<a href="" style="">Assign Role</a>
								 			</li>
								 			<li class=dropdown-item>
								 				<a href=""  style="">Assign Permission</a>
								 			</li>
								 		</div>
								 	</ul> --}}
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
    	$('#myTable').DataTable();
	});
</script>
@endsection
