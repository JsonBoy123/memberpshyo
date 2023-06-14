@extends('dashboard.layouts.master')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Form Request</h1>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				@if($message = Session::get('success'))
				    <div class="alert alert-success">
				        {{$message}}
				    </div>
				@endif
				<div class="row">
					<div class="col-md-4">
						<div class="row">
							<div class="col-md-12 mb-3">
								<h5>Profile Photo</h5>
								@if($service->photo !=null)
									<img src="{{asset('storage/'.$service->photo)}}"  alt="Profile Photo" style="height: 200px; width: 90%">
								@else
									<img src="{{asset('images/default.png')}}"  alt="Profile Photo" style="height: 200px; width: 90%">
								@endif
							</div>
							<hr>
							<div class="col-md-12 mb-3">
								<h5>Signature</h5>
								@if($service->signature !=null)
									<img src="{{asset('storage/'.$service->signature)}}"  alt="Profile Photo" style="height: 90px; width: 90%">
								@else
									<img src="{{asset('images/signature_default.jpg')}}"  alt="Profile Photo" style="height:  90px; width: 90%">
								@endif
							</div>
							<hr>
							@if($service->iap_certificate !=null)
								<div class="col-md-12 mb-3">
								<h5>IAP Certificate</h5>
								<a href="{{asset('storage/'.$service->iap_certificate)}}" class="form-control mt-1" style="overflow: hidden;"><i class="fa fa-eye"></i>
									@php
										$file = explode('/', $service->iap_certificate);
										 $doc = explode('_', $file[4]);
										echo $doc[1];
									@endphp
								</a>
							</div>
							@endif
						</div>

					</div>
					<div class="col-md-8">
						<div class="row">
							<div class="col-md-12">
								{{link_to('new_members_list', $title = 'Back', $attributes = ['class' => 'btn btn-sm btn-primary pull-right'], $secure = null)}}	

								@if($service->status != 'A' && $service->status != 'S')	

									<button class="btn btn-sm btn-success pull-right mr-2" id="serviceApprove">Service Approve</button>

									<button class="btn btn-sm btn-danger pull-right mr-2" id="serviceDecline">Service Decline</button>

								@elseif($service->status == 'S')
									<span class="btn btn-sm btn-info text-white pull-right mr-2">Service Declined </span>
								@else		
									@if($service->payment_id ==null)										
										<button class="btn btn-sm btn-danger pull-right mr-2">Payment Pending </button>
									@endif
								@endif

								{{-- <button class=" btn btn-sm text-white pull-right {{$service->approval !=0 ? 'btn-primary' : 'btn-info'}} ">{{$service->approval !=0 ? 'Approved' : 'Pending For Approval'}}</button> --}}
							</div>
						</div>
						
						
						<div class="row">
							<div class="col-md-12">
								<h3 class="font-weight-bold">{{member_name($service)}}</h3>
							</div>
						</div>
						{{-- <div class="row">
							<div class="col-md-12">
								<h5 class="">Service Name: {{$service->name}}</h5>
							</div>
						</div> --}}
						<div class="row">
							<div class="col-md-6">
								<h5 class="">IAP Number : {{$service->iap_no !=null ? $service->iap_no  : 'nil'}}</h5>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<h5 class="">Mobile Number : {{$service->mobile !=null ? $service->mobile  : 'nil'}}</h5>
							</div>
							<div class="col-md-6">
								<h5 class="">Alternate Mobile Number : {{$service->mobile1 !=null ? $service->mobile1  : 'nil'}}</h5>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<h5 class="">Email : {{$service->email !=null ? $service->email  : 'nil'}}</h5>
							</div>
							<div class="col-md-6">
								<h5 class="">Alternate Email : {{$service->email1 !=null ? $service->email1  : 'nil'}}</h5>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								@if($service->relation_type !=null)
								<h5>{{$service->relation_type !=null ? Arr::get(RELATION_TYPE,$service->relation_type) : 'nil' }} Name: {{$service->rel_f_name.($service->rel_m_name !=null ? ' '.$service->rel_m_name : '' )." ". $service->rel_l_name}}</h5>
								@endif
							</div>
						</div>
						
						<hr>

						<div class="row">
							<div class="col-md-6">
								<h5 class="">Gender :  {{$service->gender !=null ? Arr::get(GENDER,$service->gender) : 'nil' }} </h5>
							</div>
							<div class="col-md-6">
								<h5 class="">Blood Group : {{$service->blood_group !=null ? Arr::get(BLOOD_GROUP,$service->blood_group) : 'nil' }}</h5>
							</div>
						</div>

						<div class="row">
							{{-- <div class="col-md-6">
								<h5 class="">Marital Status : {{$service->marital_status !=null ? Arr::get(MARITALSTATUS,$service->marital_status) : 'nil' }}</h5>
							</div> --}}

							<div class="col-md-6">
								<h5 class="">Date of Birth :  {{$service->dob !=null ? date('d-m-Y',strtotime($service->dob)) : 'nil' }} </h5>
							</div>
							
						</div>

						<div class="row">
							<div class="col-md-6">
								<h5 class="">Place of Birth : {{$service->place_of_birth !=null ? $service->place_of_birth : 'nil' }}</h5>
							</div>
							<div class="col-md-6">

								<h5 class="">Country of Birth :  {{$service->country_of_birth ==102 ? 'India' : 'nil' }} </h5>
							</div>
							
						</div>

						<hr>

						<div class="row">
							<div class="col-md-12 ">
								<h5 class="">College Name : {{$service->college !=null ? $service->college->college_name : $service->college_name }}</h5>	
							</div>	

						</div>
						<hr>
						<div class="row">
							<div class="col-md-6 ">
								<h5 class=""> Education Qualification Type : {{$service->qualification_type !=null ? Arr::get(QUALIFICATION_TYPE,$service->qualification_type) : '' }}</h5>	
							</div>	
							<div class="col-md-6 ">
								<h5 class=""> College/School Name: {{$service->qualification_name !=null ? $service->qualification_name : '' }}</h5>	
							</div>	
							<div class="col-md-6 ">
								<h5 class=""> University/Board Name: {{$service->qualification_university !=null ? $service->qualification_university : '' }}</h5>	
							</div>	
							<div class="col-md-6 ">
								<h5 class=""> Year of Passing: {{$service->qualification_year_pass !=null ? $service->qualification_year_pass : '' }}</h5>	
							</div>	

						</div>

						<hr>
						<div class="row">
							
							<div class="col-md-6">
								<h5>Permanent Address:</h5>
							
								<h6>{{$service->p_address !=null ? $service->p_address.', ' : 'nil'}}{{$service->p_city !=null ? city_name($service->p_city).', ' : ''}}{{$service->p_state !=null ? state_name($service->p_state).', ' : ''}}{{$service->p_country !=null ? country_name($service->p_country).', ' : ''}}{{$service->p_zip_code !=null ? $service->p_zip_code.', ' : ''}}</h6>
							</div>

							<div class="col-md-6">
								<h5>Correspondence Address:</h5>
								<h6>{{$service->c_address !=null ? $service->c_address.', ' : 'nil'}}{{$service->c_city !=null ? city_name($service->c_city).', ' : ''}}{{$service->c_state !=null ? state_name($service->c_state).', ' : ''}}{{$service->c_country !=null ? country_name($service->c_country).', ' : ''}}{{$service->c_zip_code !=null ? $service->c_zip_code.', ' : ''}}</h6>
							</div>
						</div>
						<hr>
						
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 form-group">
						{{Form::label('address_proof_type','Address Proof')}}
						{{Form::select('address_proof_type',ADDRESS_PROOF_TYPE,old('address_proof_type') ?? $service->address_proof_type,['class' => 'form-control address_proof_type','readonly' => 'readonly'])}}
						@error('address_proof_type')
				            <span class="text-danger" role="alert">
				                <strong>{{ $message }}</strong>
				            </span>
				        @enderror		              
					</div>
					<div class="col-md-6 form-group">
						<br>
						<a href="{{asset('storage/'.$service->address_proof_doc)}}" class="form-control mt-1" style="overflow: hidden;" ><i class="fa fa-eye"></i>
							@php
								$file = explode('/', $service->address_proof_doc);
								 $doc = explode('_', $file[4]);
								echo $doc[1];
							@endphp
						</a>
					</div>					
				</div>
				<div class="row">
					<div class="col-md-12">
						<table class="table">
							<thead>
								<tr>
									<th>Dcoument Type</th>		
									<th>Document File</th>		
								</tr>
							</thead>
							<tbody>
								<tr>
									<th>{{__('Applicant Signature')}}</th>
									
									<th>		
									@if($service->signature !='')				
									<a href="{{asset('storage/'.$service->signature)}}" class="form-control mt-1" style="overflow: hidden;" ><i class="fa fa-eye"></i>
										@php
											$file = explode('/', $service->signature);
											 $doc = explode('_', $file[4]);
											echo $doc[1];
										@endphp
									</a>
									@endif
									</th>
								</tr>
								<tr>
									<th>{{__('Applicant Photo')}}</th>
									
									@if($service->photo !='')	
									<th>
										<a href="{{asset('storage/'.$service->photo)}}" class="form-control mt-1" style="overflow: hidden;"><i class="fa fa-eye"></i>
											@php
												$file = explode('/', $service->photo);
												 $doc = explode('_', $file[4]);
												echo $doc[1];
											@endphp
										</a>
									</th>
									@endif
								</tr>
								<tr>
									<th>{{__('10th Marksheet')}}</th>
									
									@if($service->ten_doc !='')	
									<th>
										<a href="{{asset('storage/'.$service->ten_doc)}}" class="form-control mt-1" style="overflow: hidden;"><i class="fa fa-eye"></i>
											@php
												$file = explode('/', $service->ten_doc);
												 $doc = explode('_', $file[4]);
												echo $doc[1];
											@endphp
										</a>
									</th>
									@endif
								</tr>
								<tr>
									<th>{{__('12th Marksheet')}}</th>
									
									@if($service->twelve_doc !='')	
									<th>
										<a href="{{asset('storage/'.$service->twelve_doc)}}" class="form-control mt-1" style="overflow: hidden;"><i class="fa fa-eye"></i>
											@php
												$file = explode('/', $service->twelve_doc);
												 $doc = explode('_', $file[4]);
												echo $doc[1];
											@endphp
										</a>
									</th>
									@endif
								</tr>
								<tr>
									<th>{{__('Internship Certificate')}}</th>
									
									@if($service->internship_doc !='')	
									<th>
										<a href="{{asset('storage/'.$service->internship_doc)}}" class="form-control mt-1" style="overflow: hidden;"><i class="fa fa-eye"></i>
											@php
												$file = explode('/', $service->internship_doc);
												 $doc = explode('_', $file[4]);
												echo $doc[1];
											@endphp
										</a>
									</th>
									@endif
								</tr>
								<tr>
									<th>{{__('Bachelor of Physiotherapy (B.P.T.)')}}</th>
								
									@if($service->bpt_doc !='')
									<th>
										<a href="{{asset('storage/'.$service->bpt_doc)}}" class="form-control mt-1" style="overflow: hidden;"><i class="fa fa-eye"></i>
											@php
												$file = explode('/', $service->bpt_doc);
												 $doc = explode('_', $file[4]);
												echo $doc[1];
											@endphp
										</a>
									</th>
									@endif
								</tr>
								<tr>
									<th>{{__('Master of Physiotherapy (M.P.T.)')}}</th>
									
									@if($service->mpt_doc !='')
									<th>
										<a href="{{asset('storage/'.$service->mpt_doc)}}" class="form-control mt-1" style="overflow: hidden;"><i class="fa fa-eye"></i>
											@php
												$file = explode('/', $service->mpt_doc);
												 $doc = explode('_', $file[4]);
												echo $doc[1];
											@endphp
										</a>
									</th>
									@endif
								</tr>
								<tr>
									<th>{{__('Any Goverment Proof')}}</th>
									
									@if($service->gov_proof !='')
									<th>
										<a href="{{asset('storage/'.$service->gov_proof)}}" class="form-control mt-1" style="overflow: hidden;"><i class="fa fa-eye"></i>
											@php
												$file = explode('/', $service->gov_proof);
												 $doc = explode('_', $file[4]);
												echo $doc[1];
											@endphp
										</a>
									</th>
									@endif
								</tr>
								<tr>
									<th>{{__('Any Goverment Proof')}}</th>
									
									@if($service->gov_proof1 !='')
									<th>

										<a href="{{asset('storage/'.$service->gov_proof1)}}" class="form-control mt-1" style="overflow: hidden;"><i class="fa fa-eye"></i>
											@php
												$file = explode('/', $service->gov_proof1);
												 $doc = explode('_', $file[4]);
												echo $doc[1];
											@endphp
										</a>
									</th>
									@endif
								</tr>
								<tr>
									<th>{{__('Any Other Document')}}</th>
									
									@if($service->any_other_doc !='')
									<th>

										<a href="{{asset('storage/'.$service->any_other_doc)}}" class="form-control mt-1" style="overflow: hidden;"><i class="fa fa-eye"></i>
											@php
												$file = explode('/', $service->any_other_doc);
												 $doc = explode('_', $file[4]);
												echo $doc[1];
											@endphp
										</a>
									</th>
									@endif
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal modal-fade " id="modalService">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
         <h4 class="modal-title">Active Member Profile Form</h4>
       	 <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" >
        <div class="row">
        	<div class="col-md-12 form-group">
				{{Form::label('start_date','Start Date',['class' => 'required'])}}
				{{Form::text('start_date',date('Y-m-d'),['class' => 'form-control datepicker','required' => 'required'])}}
					</div>
				<div class="col-md-12 form-group">
				{{Form::label('end_date','End Date',['class' => 'required'])}}
				{{Form::text('end_date',date('Y-m-d'),['class' => 'form-control datepicker','required' => 'required'])}}				
				</div>	
        </div>	
      </div>
      <div class="modal-footer">
      	 {{Form::submit('Submit',['class' => 'btn btn-sm btn-secondary','id' => 'approve_submit'])}}   
     
      </div>
    </div>
  </div>              
</div>

<div class="modal modal-fade " id="modalDeclineService">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
         <h4 class="modal-title">Decline Member Profile Form</h4>
       	 <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" >
        <div class="row">        	
        	<div class="col-md-12">
        	{{Form::open(array('url' => 'service_form_decline','method' => 'POST'))}}
				
        		{{Form::label('reason','Enter Decline Reason')}}
						{{Form::textarea('reason',old('reason'),['class' => 'form-control','placeholder' => 'Enter decline reason','required' => 'required'])}}
							
        </div>	
      </div>
      <div class="modal-footer">
      	    
        {{Form::hidden('service_id',$service->id)}}
			{{Form::submit('submit',['class' => 'btn btn-sm btn-secondary'])}}	
    	{{Form::close()}}
      </div>
    </div>
  </div>              
</div>

<script>
	$(document).ready(function () {

	@if($message = Session::get('success'))
		$.notify('{{$message}}', "success");
	@endif
		$(function() {
			$('.datepicker').datepicker({
				format:'yyyy-mm-dd'
			});
		});
		$('.required').append('<span class="text-danger">*</span>');


    	$('#serviceApprove').on('click',function(e){
    		var service_type = "{{$service->service_type}}";
    		if(service_type == 'L'){
    			service_form_approve();
    		}else{
    			$('#modalService').modal('show');

    		}
    	});
    	

    	$('#approve_submit').on('click',function(e){
    		var start_date = new Date($('input[name="start_date"]').val());
    		var end_date = new Date($('input[name="end_date"]').val());
    		
    		if(start_date !='' && end_date !=''){
    			if(start_date < end_date){
    				start_date = $('input[name="start_date"]').val();
    				end_date = $('input[name="end_date"]').val();
    				service_form_approve(start_date,end_date);
    			}else{
    				$.notify('End date greater than start date.', "error");
    			}
    		}else{
    			  $.notify('Select start date & end date.', "error");
    		}
    	});

    	$('#serviceDecline').on('click',function(e){
    		$('#modalDeclineService').modal('show');
    	});
	});


	function service_form_approve(start_date ='',end_date=''){
		var user_service_id = "{{$service->id}}"; 
		$.ajax({
			type:'POST',
			url:"{{url('service_form_approve')}}",
			data:{id:user_service_id,start_date:start_date,end_date:end_date},
			success:function(res){
				 // console.log(res);
				 // exit;
				 //return false;
				$.notify(res, "success");
				// window.location.href = '/approval/service_request';
			
			}

		})
	}
</script>

@endsection