 @extends('dashboard.layouts.master')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Profile</h1>
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
								@if($member->photo !=null)
									<img src="{{asset('storage/'.$member->photo)}}"  alt="Profile Photo" style="height: 200px; width: 90%">
								@else
									<img src="{{asset('images/default.png')}}"  alt="Profile Photo" style="height: 200px; width: 90%">
								@endif
							</div>
							<hr>
							<div class="col-md-12 mb-3">
								<h5>Signature</h5>
								@if($member->signature !=null)
									<img src="{{asset('storage/'.$member->signature)}}"  alt="Profile Photo" style="height: 90px; width: 90%">
								@else
									<img src="{{asset('images/signature_default.jpg')}}"  alt="Profile Photo" style="height:  90px; width: 90%">
								@endif
							</div>
							<hr>
							
							<div class="col-md-12 mb-3">
								<h5>IAP Certificate</h5>

								{{-- @if($member->iap_certificate !='')
									<a href="{{asset('storage/'.$member->iap_certificate)}}" class="mt-1" style="overflow: hidden;"><i class="fa fa-eye"></i> {{file_name($member->iap_certificate)}}</a>
								@endif --}}
							</div>
						</div>

					</div>
					<div class="col-md-8">
						<div class="row">
							<div class="col-md-12">
								{{-- {{link_to('/member/'.$member->user_id.'/edit', $title = 'Edit', $attributes = ['class' => 'btn btn-sm btn-success ml-2 pull-right'], $secure = null)}} --}}

								<button class=" btn btn-sm text-white pull-right {{$member->approval !=0 ? 'btn-primary' : 'btn-info'}} ">{{$member->approval !=0 ? 'Approved' : 'Pending For Approval'}}</button>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-12">
								<h3 class="font-weight-bold">{{member_name($member)}}</h3>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<h5 class="">IAP Number : {{$member->iap_no !=null ? $member->iap_no  : 'nil'}}</h5>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<h5 class="">Mobile Number : {{$member->mobile !=null ? $member->mobile  : 'nil'}}</h5>
							</div>
							<div class="col-md-6">
								<h5 class="">Alternate Mobile Number : {{$member->mobile1 !=null ? $member->mobile1  : 'nil'}}</h5>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<h5 class="">Email : {{$member->email !=null ? $member->email  : 'nil'}}</h5>
							</div>
							<div class="col-md-6">
								<h5 class="">Alternate Email : {{$member->email1 !=null ? $member->email1  : 'nil'}}</h5>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								@if($member->relation_type !=null)
								<h5>{{$member->relation_type !=null ? Arr::get(RELATION_TYPE,$member->relation_type) : 'nil' }} Name: {{$member->rel_f_name.($member->rel_m_name !=null ? ' '.$member->rel_m_name : '' )." ". $member->rel_l_name}}</h5>
								@endif
							</div>
						</div>
						
						<hr>

						<div class="row">
							<div class="col-md-6">
								<h5 class="">Gender :  {{$member->gender !=null ? Arr::get(GENDER,$member->gender) : 'nil' }} </h5>
							</div>
							<div class="col-md-6">
								<h5 class="">Blood Group : {{$member->blood_group !=null ? Arr::get(BLOOD_GROUP,$member->blood_group) : 'nil' }}</h5>
							</div>
						</div>

						<div class="row">
							{{-- <div class="col-md-6">
								<h5 class="">Marital Status : {{$member->marital_status !=null ? Arr::get(MARITALSTATUS,$member->marital_status) : 'nil' }}</h5>
							</div> --}}

							<div class="col-md-6">
								<h5 class="">Date of Birth :  {{$member->dob !=null ? date('d-m-Y',strtotime($member->dob)) : 'nil' }} </h5>
							</div>
							
						</div>

						<div class="row">
							<div class="col-md-6">
								<h5 class="">Place of Birth : {{$member->place_of_birth !=null ? $member->place_of_birth : 'nil' }}</h5>
							</div>
							<div class="col-md-6">

								<h5 class="">Country of Birth :  {{$member->country_of_birth ==102 ? 'India' : 'nil' }} </h5>
							</div>
							
						</div>

						<hr>

						<div class="row">
							<div class="col-md-12 ">
								<h5 class="">College Name : {{$member->college !=null ? $member->college->college_name : $member->college_name }}</h5>	
							</div>	

						</div>
						<hr>
						<div class="row">
							<div class="col-md-6 ">
								<h5 class=""> Education Qualification Type : {{$member->qualification_type !=null ? Arr::get(QUALIFICATION_TYPE,$member->qualification_type) : '' }}</h5>	
							</div>	
							<div class="col-md-6 ">
								<h5 class=""> College/School Name: {{$member->qualification_name !=null ? $member->qualification_name : '' }}</h5>	
							</div>	
							<div class="col-md-6 ">
								<h5 class=""> University/Board Name: {{$member->qualification_university !=null ? $member->qualification_university : '' }}</h5>	
							</div>	
							<div class="col-md-6 ">
								<h5 class=""> Year of Passing: {{$member->qualification_year_pass !=null ? $member->qualification_year_pass : '' }}</h5>	
							</div>	

						</div>

						<hr>
						<div class="row">
							
							<div class="col-md-6">
								<h5>Permanent Address:</h5>
							
								<h6>{{$member->p_address !=null ? $member->p_address.', ' : 'nil'}}{{$member->p_city !=null ? city_name($member->p_city).', ' : ''}}{{$member->p_state !=null ? state_name($member->p_state).', ' : ''}}{{$member->p_country !=null ? country_name($member->p_country).', ' : ''}}{{$member->p_zip_code !=null ? $member->p_zip_code.', ' : ''}}</h6>
							</div>

							<div class="col-md-6">
								<h5>Correspondence Address:</h5>
								<h6>{{$member->c_address !=null ? $member->c_address.', ' : 'nil'}}{{$member->c_city !=null ? city_name($member->c_city).', ' : ''}}{{$member->c_state !=null ? state_name($member->c_state).', ' : ''}}{{$member->c_country !=null ? country_name($member->c_country).', ' : ''}}{{$member->c_zip_code !=null ? $member->c_zip_code.', ' : ''}}</h6>
							</div>
						</div>
					</div>
				</div>
				<hr>
				{{-- @if($member->old_or_new == 0) --}}
				{{-- <div class="row">
					<div class="col-md-6 form-group">
						{{Form::label('address_proof_type','Address Proof')}}
						{{Form::input('address_proof_type',Arr::get(ADDRESS_PROOF_TYPE,$member->address_proof_type),'',['class' => 'form-control address_proof_type','readonly' => 'readonly'])}}
						@error('address_proof_type')
				            <span class="text-danger" role="alert">
				                <strong>{{ $message }}</strong>
				            </span>
				        @enderror		              
					</div>
					<div class="col-md-6 form-group">
						<br>
						<a href="{{asset('storage/'.$member->address_proof_doc)}}" class="form-control mt-1" style="overflow: hidden;" ><i class="fa fa-eye"></i>
							@php
								$file = explode('/', $member->address_proof_doc);
								 $doc = explode('_', $file[4]);
								echo $doc[1];
							@endphp
						</a>
					</div>					
				</div> --}}
				<div class="row">
					<div class="col-md-12">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Dcoument Type</th>		
									<th>Document File</th>		
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										@if($member->address_proof_type !='')
											{{Arr::get(ADDRESS_PROOF_TYPE,$member->address_proof_type)}}
										@endif
									</td>
									
									@if($member->address_proof_doc !='')	
									<td>
										<a href="{{asset('storage/'.$member->address_proof_doc)}}" class="mt-1" style="overflow: hidden;"><i class="fa fa-eye"></i> {{file_name($member->address_proof_doc)}}
										</a>
									</td>
									@endif
								</tr>

								{{-- <tr>
									<td>{{__('Internship Certificate')}}</td>
									
									@if($member->internship_doc !='')	
									<td>
										<a href="{{asset('storage/'.$member->internship_doc)}}" class="form-control mt-1" style="overflow: hidden;"><i class="fa fa-eye"></i>
											@php
												$file = explode('/', $member->internship_doc);
												 $doc = explode('_', $file[4]);
												echo $doc[1];
											@endphp
										</a>
									</td>
									@endif
								</tr> --}}
								<tr>
									<td>{{__('Any Goverment Proof')}}</td>
									
									@if($member->gov_proof !='')
									<td>
										<a href="{{asset('storage/'.$member->gov_proof)}}" class="mt-1" style="overflow: hidden;"><i class="fa fa-eye"></i> {{file_name($member->gov_proof)}}
										</a>
									</td>
									@endif
								</tr>
								<tr>
									<td>{{__('Any Goverment Proof')}}</td>
									
									@if($member->gov_proof1 !='')
									<td>
										<a href="{{asset('storage/'.$member->gov_proof1)}}" class="mt-1" style="overflow: hidden;"><i class="fa fa-eye"></i> {{file_name($member->gov_proof1)}}
										</a>
									</td>
									@endif
								</tr>
								<tr>
									<td>{{__('Any Other Document')}}</td>
									
									@if($member->any_other_doc !='')
									<td>
										<a href="{{asset('storage/'.$member->any_other_doc)}}" class="mt-1" style="overflow: hidden;"><i class="fa fa-eye"></i> {{file_name($member->any_other_doc)}}
										</a>									
									</td>
									@endif
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				{{-- @endif				 --}}
			</div>
		</div>
	</div>
</div>
@endsection