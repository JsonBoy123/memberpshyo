<table class="table table-striped table-bordered">
<thead>
	<tr>
		<td>#</td>
		<td>Name</td>
		<td>Charges</td>
		<td>Transaction Id</td>
		<td>Status</td>
	</tr>
</thead>
<tbody>
	@php $count = 0; @endphp
	@foreach($member_services as $member_service)
		<tr>
			<td>{{++$count}}</td>
			<td>{{-- {{$member_service->service->name}} --}}</td>
			<td>{{-- {{$member_service->service->charges}} --}}</td>
			<td>{{$member_service->payment_id}}</td>
			<td>{{$member_service->status =='A' ? 'Active' : 'Pending'}}</td>
		</tr>
	@endforeach
</tbody>
</table>