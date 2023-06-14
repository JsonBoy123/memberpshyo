<table class="table table-bordered table-striped" id="myTable">
	<thead>
		<tr>
			<th>#</th>
			<th>Service Name</th>
			<th>Member Full Name</th>
			<th>Member O/N Status</th>
			<th>Mobile</th>
			<th>Payment Transaction ID</th>
			{{-- <th>Payment Verification</th> --}}
			<th>Service Status</th>
			<th>Applied Service Is Old/New</th>
			<th>Payment Status</th>
			<th>Action</th>

		</tr>
	</thead>
	<tbody>
		@php $count = 0 ;@endphp
		@foreach($services as $service)
		<tr>
			<td>{{++$count}}</td>
			<td>{{$service->service->name}}</td>
			<td>
				{{member_name($service->member) }}
			</td>
			<td>{{$service->member->old_or_new != '1' ? 'New' : 'Old'}} Member</td>
			<td>{{$service->member->mobile}}</td>
			<td>{{$service->payment_id}}</td>
			{{-- <td>
				@if($service->payment_id == '')
					{{__('Payment Pending')}}
				@else
					{{__('Payment Done')}}
				@endif
			</td> --}}
			<td>
				{{$service->status == 'A' ? 'Approved' : ($service->status == 'P' ? 'Pending' : 'Declined') }}	

			</td>
			<td>
				{{$service->old_or_new == '0' ? 'New Service' : 'Old Service'}}	

			</td>
			<td>
				@if($service->payment_status != '1')
					@if($service->payment_id !=null)
						<button class="btn btn-sm btn-success mr-2 pull-right approveBtn" id="{{$service->id}}" data-id="{{$service->payment_id}}">Approve Service Payment</button>
						{{--  --}}
						{{-- <button class="btn btn-sm btn-danger pull-right mr-2">Decline</button> --}}
						
					@endif
					<span class="text-muted">Pending</span>
				@else
					<span class="text-success">Approved</span>
				@endif

			</td>

			<td>
				<a href="{{url('approval/service_show/'.$service->id)}}"><i class="fa fa-eye btn btn-sm btn-primary pull-right mr-2"></i></a>

					{{-- @if($service->payment_id !=null)
						@if($service->payment_status ==0)
							<a href="" class="btn btn-sm btn-success mr-2 pull-right">Payment Approve</a>

							<button class="btn btn-sm btn-danger pull-right mr-2">Payment Decline</button>
						@endif
					@else
						<button class="btn btn-sm btn-danger pull-right mr-2">Payment Pending </button>
					@endif --}}
				{{-- @if($service->status != 'A')
					<a href="{{url('approval/service_approve/'.$service->id)}}" class="btn btn-sm btn-success mr-2 pull-right">Service Approve</a>
					<button class="btn btn-sm btn-danger pull-right">Service Decline</button>

				@else
					@if($service->payment_status !=0)
						<a href="" class="btn btn-sm btn-success mr-2 pull-right">Payment Approve</a>
						<button class="btn btn-sm btn-danger pull-right">Payment Decline</button>
					@endif
				@endif --}}
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

<script >
	$(document).ready(function () {		
    	$('#myTable').DataTable({
    		"ordering": false
    	});
    });
</script>