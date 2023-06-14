@extends('dashboard.layouts.master')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Services</h1>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Services 
					@role('super_admin') 
						{{link_to('/service/create', $title = 'Add Service', $attributes = ['class' => 'btn btn-sm btn-primary pull-right'], $secure = null)}}
					@endrole
					{{-- @role('member')
						{{link_to('',$title = 'Service Allocate', $attributes = ['class' => 'btn btn-sm btn-primary pull-right'])}}
					@endrole --}}
				</h5>
			</div>
			<div class="card-body table-responsive">
				@if($message = Session::get('success'))
				    <div class="alert alert-success">
				        {{$message}}
				    </div>
				@endif
				
				<table class="table table-bordred table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
						@role('super_admin|member_admin')
							<th>Member_type</th>
						@endrole
							<th>Service Type</th>
							<th>Charges</th>
							<th>Tax Charges</th>
						@role('super_admin|member_admin')
							<th>Status</th>
							<th>Url Name</th>							
						@endrole
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@php $count = 1; @endphp
						@foreach(get_services() as $service)

						@role('member')
					
							@if(in_array($service->id, json_decode(get_member_details()->services)->show))
								@include('adminView.services.table_data')

							@php $count++; @endphp
							@endif
						@else
							@include('adminView.services.table_data')
							@php $count++; @endphp
						@endrole
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection
