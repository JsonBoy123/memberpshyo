@extends('dashboard.layouts.master')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Profile Approval</h1>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-md-4">
						<div class="row">
							<div class="col-md-12 mb-3">
								@if($member->photo !=null)
									<img src="{{asset('storage/'.$member->photo)}}"  alt="Profile Photo" style="height: 200px; width: 90%">
								@else
									<img src="{{asset('images/default.png')}}"  alt="Profile Photo" style="height: 200px; width: 90%">
								@endif
							</div>
							<div class="col-md-12 mb-3">
								@if($member->signature !=null)
									<img src="{{asset('storage/'.$member->signature)}}"  alt="Profile Photo" style="height: 90px; width: 90%">
								@else
									<img src="{{asset('images/signature_default.jpg')}}"  alt="Profile Photo" style="height:  90px; width: 90%">
								@endif
							</div>
						</div>

					</div>
					<div class="col-md-8">
						<div class="row">
							<div class="col-md-12">
								{{link_to('/approval/profile', $title = 'Back', $attributes = ['class' => 'btn btn-sm btn-primary ml-2 pull-right'], $secure = null)}}
								<button class="btn btn-sm btn-danger ml-2 pull-right" id="">Declined</button>
								
								{{link_to('/approval/profile_approve/'.$member->id, $title = 'Approve', $attributes = ['class' => 'btn btn-sm btn-success  pull-right'], $secure = null)}}

							
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

								<h5 class="">Country of Birth :  {{$member->country_of_birth !=null ? date('d-m-Y',strtotime($member->country_of_birth)) : 'nil' }} </h5>
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
							
							<div class="col-md-6">
								<h5>Permanent Address:</h5>
							
								<h6>{{$member->p_address !=null ? $member->p_address.', ' : 'nil'}}{{$member->p_city !=null ? city_name($member->p_city).', ' : ''}}{{$member->p_state !=null ? state_name($member->p_state).', ' : ''}}{{$member->p_country !=null ? country_name($member->p_country).', ' : ''}}{{$member->p_zip_code !=null ? $member->p_zip_code.', ' : ''}}</h6>
							</div>

							<div class="col-md-6">
								<h5>Correspondence Address:</h5>
								<h6>{{$member->c_address !=null ? $member->c_address.', ' : 'nil'}}{{$member->c_city !=null ? city_name($member->c_city).', ' : ''}}{{$member->c_state !=null ? state_name($member->c_state).', ' : ''}}{{$member->c_country !=null ? country_name($member->c_country).', ' : ''}}{{$member->c_zip_code !=null ? $member->c_zip_code.', ' : ''}}</h6>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-12">
								<h5>Documents</h5>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection