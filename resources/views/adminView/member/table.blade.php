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
			<td>
				@if($member->status == 'P')
					@if(count($member->applied_services) !='0')
						<span class="text-success">Member already applied member service</span>
					@else
						<span class="text-danger">Member not applied any member service</span>
					@endif
					@if($member->old_or_new !=0)
						{{-- <button class="btn btn-sm btn-success modalService"  id="{{$member->user_id}}">Active</button> --}}
					@endif
				@else
					<button class="btn btn-sm btn-primary memberServices" id="{{$member->user_id}}">services</button>

					<!-- @if($member->iap_no ==null)
						<button class="btn btn-sm btn-success assignService" id="{{$member->user_id}}">Assign Iap Number</button>
					@endif -->
				@endif
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
<script >
	$(document).ready(function () {
    	$('#myTable').DataTable();
    });
</script>