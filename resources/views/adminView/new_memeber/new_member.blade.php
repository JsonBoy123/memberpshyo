@extends('dashboard.layouts.master')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Members</h1>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-md-4">
						<h4 class="card-title">Members List</h4>
					</div>
				</div>
			</div>
			<div class="card-body" mem>			
				@if($message = Session::get('success'))
					<div class="alert alert-success">
						{{$message}}
					</div>
				@endif
				<div class="row">
					<div class="col-md-12 table-responsive" id="memberTable">
					
						<table class="table table-bordered table-striped" id="myTable">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>IAP Number</th>
									<th>Email</th>
									<th>Mobile</th>
									<th>Status</th>
									<th>Member O/N Status </th>
									<th>Registered Date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@php $count = 0; @endphp
								@foreach($members as $member)
								<tr>
									<td>{{++$count}}</td>
									<td>{{member_name($member)}}</td>
									<td>{{$member->iap_no}}</td>
									<td>{{$member->email}}</td>
									<td>{{$member->mobile}}</td>
									<td>{{$member->status =='A' ? 'Active' : 'Pending'}}</td>
									<td>{{$member->old_or_new =='1' ? 'Old Member' : 'New Member'}}</td>
									<td>
										{{date('d-m-Y',strtotime($member->regn_date))}}
									</td>
									<td><a href="{{url('new_members_list_detai/'.$member->id)}}"><i class="fa fa-eye btn btn-sm btn-primary pull-right mr-2"></i></a></td>
								</tr>
								@endforeach
							</tbody>
						</table>

					</div>
				</div>
			
			</div>
		</div>
	</div>

</div>
@endsection
