<tr>
	<td>{{$count}}</td>
	<td>{{$service->name}}</td>		
	@role('super_admin|member_admin')
		<td>{{$service->member !=null ? $service->member->display_name : ''}}</td>
	@endrole	
	<td>{{$service->service_type == "L" ? 'Long Time' : 'Short Time'}}</td>				
	<td><i class="fa fa-rupee"></i> {{$service->charges != null ? $service->charges : '0' }}</td>
	<td><i class="fa fa-rupee"></i> {{$service->tax_charges != null ? $service->tax_charges : '0' }}</td>
	@role('super_admin|member_admin')
		<td>{{$service->status == 1 ? 'Active' : 'Not Active'}}</td>
		<td>{{$service->form_name}}</td>								
	@endrole
	<td>
		<a href="{{url('/service/'.$service->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>
		@role('super_admin|admin')
			<a href="{{url('/service/'.$service->id.'/edit')}}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
			<a href="{{url('/service/destroy/'.$service->id)}}" class="btn btn-sm btn-danger"><i class="fa fa-trash "></i></a>
		@endrole
		@if(count($userServices) !='0')
			@foreach($userServices as $userService)

				@if($userService->service_id == $service->id)
																							
					@if($userService->status == 'A')
						@if($userService->payment_id != null)
							@if($userService->payment_status == '0')
								<span class="text-danger">{{'Pending for payment approval'}}</span>
							@else
								<span class="text-success">{{'Payment approved | '}}</span>
							@endif
						@else
							<a href="{{url('service/payment/'.$userService->id)}}" class="btn btn-sm btn-primary">Payment UTR number</a>
						@endif

						<span class="text-success">{{'Service approved'}}</span>
					@elseif($userService->status == 'P')
						@if($service->id !='2' && $service->id !='5')
						<a href="{{url('service/'.$service->form_name.'_edit/'.$userService->user_id)}}" class="btn btn-sm btn-success">Edit</a>
						@endif
						<span class="text-danger">{{'Pending for service approval'}}</span>
						{{-- <button class="btn btn-sm btn-info text-white">{{'Pending For Approval'}}</button> --}}
					@else
						@if($service->id !='2' && $service->id !='5')
							<a href="{{url('service/'.$service->form_name.'_edit/'.$userService->user_id)}}" class="btn btn-sm btn-success">Edit</a>
						@endif
						<span class="text-danger">Service Declined</span>
					@endif
						
				@endif
					
			@endforeach
		{{-- @else
			<a href="{{url('/service/'.$service->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>	 --}}
		@endif
	</td>											
</tr>