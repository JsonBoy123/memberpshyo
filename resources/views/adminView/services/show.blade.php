@extends('dashboard.layouts.master')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Services</h1>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Service 
					{{link_to('/service', $title = 'Back', $attributes = ['class' => 'btn btn-sm btn-primary pull-right'], $secure = null)}}
								
				</h5>	
			</div>
			<div class="card-body">
				@if($message = Session::get('warning'))
				    <div class="alert alert-warning">
				        {{$message}}
				    </div>
				@endif
				<div class="col-md-10">
					<h4 class="font-weight-bold text-capitalize">{{$service->name}}</h4>
					{{-- <p class="font-weight-bold">Service Start Date: {{date('d-m-Y',strtotime($service->from))}} @if($service->service_type == 'S')<span class="font-weight-bold pull-right text-right">Service End Date: {{date('d-m-Y',strtotime($service->from))}}</span> @endif</p> --}}
					<h6 class="font-weight-bold">Service Charges + Tax Charges : <i class="fa fa-rupee"></i> {{$service->charges}} + <i class="fa fa-rupee"></i> {{$service->tax_charges}} = <i class="fa fa-rupee"></i> {{$service->charges + $service->tax_charges}}</h6>
				</div>

				<div class="col-md-12">
					<p>@php
						echo $service->description;
					@endphp</p>
					
					<input type="hidden" value="{{$service->id}}" name="ids">

					<p>@php
						echo $service->id;
					@endphp</p>

					{{-- @if (isset($id))
					    {!! Form::type($id) !!}
					@endif --}}
					
				 	{{-- @if($service->id == '10' || $service->id == '12' || $service->id == '11' || $service->id == '13') --}}
				 	<hr>
				 	@if($member !=null)
				 	<input type="hidden" value="{{$service->id}}" name="ids">
						@if($member->status == 'A')
							@if($member->payment_id != null)
								@if($member->payment_status == '0')
									<span class="text-danger">{{'Pending for payment approval'}}</span>
								@else
									<span class="text-success">{{'Payment approved |'}}</span>
								@endif
							@else
								<a href="{{url('service/payment/'.$member->id)}}" class="btn btn-sm btn-primary">Payment UTR number</a>
							@endif

							<span class="text-success">{{'Service approved'}}</span>
						@elseif($member->status == 'P')
							@if($service->id !='2' && $service->id !='5')
								<a href="{{url('service/'.$service->form_name.'_edit/'.$member->user_id)}}" class="btn btn-sm btn-success">Edit</a>
							@endif
							<span class="text-danger">{{'Pending for service approval'}}</span>
							{{-- <button class="btn btn-sm btn-info text-white">{{'Pending For Approval'}}</button> --}}
						@else
							@if($service->id !='2' && $service->id !='5')
								<a href="{{url('service/'.$service->form_name.'_edit/'.$member->user_id)}}" class="btn btn-sm btn-success">Edit</a>
							@endif
							
							<span class="text-danger">Service Declined</span>
						@endif



				 		{{-- @if($userservice->payment_id == null)
							{{__('Pending For Payment')}}
							<br>
							<a href="{{url('service/payment/'.$userservice->user_id)}}" class="btn btn-sm btn-primary">Payment Now</a>
							<a href="{{url('service/'.$service->form_name.'_edit/'.$userservice->user_id)}}" class="btn btn-sm btn-success">Edit</a>
						@endif
						@if($userservice->status == 'P')
							<button class="btn btn-sm btn-info text-white">{{'Pending For Approval'}}</button>
						@else
							<button class="btn btn-sm btn-success text-white">{{'Approved'}}</button>
						@endif --}}
					@else
						@if($service->id == '10' || $service->id == '11' || $service->id == '12' || $service->id == '13' || $service->id == '14' )

							@if(member_service_check())
							@role('member')
							    @if($member->address_proof_type !=null)
                               
							    @else
								<a href="{{url('service/'.$service->form_name.'/'.$service->id)}}" class="btn btn-sm btn-primary">Apply</a>  
								@endif
								@endrole 

							@else
								<span class="text-success">Another Member Service Already Applied</span>
							@endif
						@else
							@if(member_service_check())
								<span class="text-danger">Firstly Apply member service, after that you can apply other services </span>		
							@else
							    
								<a href="{{url('service/'.$service->form_name.'/'.$service->id)}}" class="btn btn-sm btn-primary">Apply</a>
								
							@endif
							
						@endif
						
				 	@endif
				</div>

				
				{{-- @if($service->doc_url !=null)
					<div class="col-md-12 mt-4">
						<h4 class="font-weight-bold">Attachments</h4>
						<a href="{{url('services_docs/'.$service->id)}}" class="text-primary">Download application form for {{$service->name}}</a>
					</div>

					@role('member')
						<div class="col-md-12 mt-4">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Attachment Submit</h5>
								</div>
								<div class="card-body">
									{{Form::open(array('url' => '/member_document','method' => 'post' , 'enctype' => 'multipart/form-data'))}}
									<div class="form-group row">
										<div class="col-md-6">
											{{Form::label('file','Attachment Submit here...')}}
											{{Form::file('file',['class' => 'form-control', 'accept' => 'application/pdf,application/*'])}}
											@error('file')
												<span class="text-danger" role="alert">
						                            <strong>{{ $message }}</strong>
						                        </span>
											@enderror
										</div>
									</div>
									<div class="form-group row mt-2">
										<div class="col-md-6">
											{{Form::hidden('service_id',$service->id)}}
											{{Form::submit('Submit',['class' => 'btn btn-sm btn-primary'])}}
										</div>
									</div>
									{{Form::close()}}
								</div>
							</div>
						</div>
					@endrole
				@endif --}}
			</div> 


		</div>
	</div>
</div>
@endsection