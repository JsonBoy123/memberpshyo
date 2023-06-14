@extends('dashboard.layouts.master')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Profile</h1>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-sm-3"><!--left col-->   
					  	<div class="text-center">
					        <img src="{{asset($member->image_url !='' ? $member->image_url : 'images/default.png' )}}" class="avatar rounded-circle img-thumbnail mb-2" alt="member" style="width: 150px;height: 150px;">
					        <h6>Upload a different photo...</h6>
					    {{ Form::open(array('url' => '/member/'.$member->id,'method' => 'post','enctype'=>'multipart/form-data'))}}
						@method('patch')
						
					        {{ Form::file('file',['class' => 'form-control disabled','style' => 'padding:0px !important','accept'=>"image/*",'disabled'=>true])}}

					    </div><hr>
					     <div class="card mb-4">
					        <div class="card-header">Profile Verified </div>
					        <div class="card-body">
					        	{{$member->status == 'P' ? 'Pending' : ($member->status == 'A' ? 'Verified' : 'Suspended')}}
					        </div>
					    </div>
					    <div class="card mb-4">
					        <div class="card-header">Website <i class="fa fa-link fa-1x"></i></div>
					        <div class="card-body">
					        	<a href="#">{{$member->www}}</a>
					        </div>
					    </div>
					    {{-- <div class="card">
					        <div class="card-header">Website <i class="fa fa-link fa-1x"></i></div>
					        <div class="card-body"><a href=""></a></div>
					    </div> --}}
					    <ul class="list-group mt-2">
				            <li class="list-group-item text-muted">Activity <i class="fa fa-dashboard fa-1x"></i></li>
				            <li class="list-group-item text-right"><span class="pull-left"><strong>Shares</strong></span> 125</li>
				            <li class="list-group-item text-right"><span class="pull-left"><strong>Likes</strong></span> 13</li>
				            <li class="list-group-item text-right"><span class="pull-left"><strong>Posts</strong></span> 37</li>
				            <li class="list-group-item text-right"><span class="pull-left"><strong>Followers</strong></span> 78</li>
				        </ul> 
					</div>
					<div class="col-sm-9 p-3">
						
						<div class="row">
							<div class="col-md-12 from-group">
								<a href="javascript:void(0)" class="btn btn-sm btn-success pull-right editBtn">Edit</a>
							  	<a href="javascript:void(0)" class="btn btn-secondary btn-sm pull-right cancelBtn" style="display: none">Cancel</a>
							  	{{Form::submit('Update',['class' => 'btn btn-sm btn-success pull-right updateBtn mr-3','style'=>'display:none'])}}

							</div>
						</div>
						<div class="row">							
							<div class="col-md-6 from-group mt-3">
								{{ Form::label('name', 'Name:')}}
								{{ Form::text('name',old('name') ?? $member->name,['class' => 'form-control name readonly','readonly'=>'true'])}}
								@error('name')
	                                <span class="text-danger" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                </span>
		                        @enderror
							</div>
							<div class="col-md-6 from-group mt-3">
								{{ Form::label('iap_no', 'IAP Number:')}}
								{{ Form::text('iap_no',old('iap_no') ?? $member->iap_no,['class' => 'form-control iap_no','readonly'=>'true'])}}
								@error('iap_no')
	                                <span class="text-danger" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                </span>
		                        @enderror
							</div>
							<div class="col-md-6 from-group mt-3">
								{{ Form::label('email', 'Email Address:')}}
								{{ Form::text('email',old('email') ?? $member->email,['class' => 'form-control email','readonly'=>'true'])}}
								@error('email')
	                                <span class="text-danger" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                </span>
		                        @enderror
							</div>
							<div class="col-md-6 from-group mt-3">
								{{ Form::label('mobile', 'Mobile Number:')}}
								{{ Form::text('mobile',old('mobile') ?? $member->mobile,['class' => 'form-control mobile','readonly'=>'true'])}}
								@error('mobile')
	                                <span class="text-danger" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                </span>
		                        @enderror
							</div>
							
							<div class="col-md-6 from-group mt-3">
								{{ Form::label('gender', 'Gender:')}}
								{{ Form::select('gender',array('' => 'Select Gender','M' => 'Male','F'=>'Female', 'o' => 'Other'), old('gender') ?? $member->gender,['class'=>'form-control gender disabled','disabled'=>'true'])}}
								@error('gender')
							        <span class="text-danger" role="alert">
							            <strong>{{ $message }}</strong>
							        </span>
							    @enderror	
							</div>
							<div class="col-md-6 from-group mt-3">
								{{ Form::label('dob', 'Date of Birth:')}}
								{{ Form::text('dob',old('dob') ?? $member->dob,['class' => 'form-control datepicker dob disabled', 'disabled' => 'true' ])}}
								@error('dob')
							        <span class="text-danger" role="alert">
							            <strong>{{ $message }}</strong>
							        </span>
							    @enderror	
							</div>
							
							<div class="col-md-6 from-group mt-3">
								{{ Form::label('mobile1', 'Alternate Mobile Number:')}}
								{{ Form::text('mobile1',old('mobile1') ?? $member->mobile1,['class' => 'form-control mobile1 readonly','readonly'=>'true', 'oninput' =>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"])}}
								@error('mobile1')
	                                <span class="text-danger" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                </span>
		                        @enderror
							</div>
							
							<div class="col-md-6 from-group mt-3">
								{{ Form::label('clinic_name', 'Clinic Name:')}}
								{{ Form::text('clinic_name',old('clinic_name') ?? $member->clinic_name,['class' => 'form-control clinic_name readonly','readonly'=>'true'])}}
								@error('clinic_name')
	                                <span class="text-danger" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                </span>
		                        @enderror
							</div>
							<div class="col-md-6 from-group mt-3">
								{{ Form::label('www', 'Website:')}}
								{{ Form::text('www',old('www') ?? $member->www,['class' => 'form-control www readonly','readonly'=>'true'])}}
								@error('www')
	                                <span class="text-danger" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                </span>
		                        @enderror
							</div>

							<div class="col-md-6 from-group mt-3">
								{{ Form::label('regn_date', 'Registration Date:')}}
								{{ Form::text('regn_date',old('regn_date') ?? $member->regn_date,['class' => 'form-control regn_date disabled','disabled'=>'true'])}}
								@error('regn_date')
	                                <span class="text-danger" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                </span>
		                        @enderror
							</div>
							<div class="col-md-6 from-group mt-3">
								{{ Form::label('father_name', 'Father Full Name:')}}
								{{ Form::text('father_name',old('father_name') ?? $member->father_name,['class' => 'form-control father_name readonly','readonly'=>'true'])}}
								@error('father_name')
	                                <span class="text-danger" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                </span>
		                        @enderror
							</div>
							<div class="col-md-6 from-group mt-3">
								{{ Form::label('mother_name', 'Mother Full Name:')}}
								{{ Form::text('mother_name',old('mother_name') ?? $member->mother_name,['class' => 'form-control mother_name readonly','readonly'=>'true'])}}
								@error('mother_name')
	                                <span class="text-danger" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                </span>
		                        @enderror
							</div>
							<div class="col-md-6 from-group mt-3">
								{{ Form::label('marital_status', 'Marital Status:')}}
								{{ Form::select('marital_status',array('' => 'Select marital status','S' => 'Single', 'M' => 'Married','W' => 'Widowed', 'D' => 'Divorced'),old('marital_status') ?? $member->marital_status,['class'=>'form-control marital_status disabled','disabled'=>'true'])}}
								@error('marital_status')
	                                <span class="text-danger" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                </span>
		                        @enderror
							</div>


							<div class="col-md-12 from-group  mt-3">
								<div class="card">
									<div class="card-header p-2">
										<h5>Permanent Address:</h5>
									</div>
									<div class="card-body">	
										<div class="row">
										<div class="col-md-4 from-group">
											{{Form::label('address','Address Line')}}
											{{Form::text('address',old('address') ?? $member->address,['class'=>'form-control readonly address','readonly'=>'true','id' => 'address'])}}
											@error('address')
				                                <span class="text-danger" role="alert">
				                                    <strong>{{ $message }}</strong>
				                                </span>
					                        @enderror
										</div>
										<div class="col-md-4 from-group">
											{{ Form::label('country_code', 'Country Name:')}}
											{{ Form::select('country_code',$countries, old('country_code') ?? ($member->country_code !='' ? $member->country_code : '102'),['class'=>'form-control country_code disabled','disabled'=>'true','id'=>'country'])}}	
											@error('country_code')
											<span class="text-danger" role="alert">
											<strong>{{ $message }}</strong>
											</span>
											@enderror		
										</div>
										<div class="col-md-4 from-group">
											{{ Form::label('state_code', 'State Name:')}}
											{{ Form::select('state_code',array(), '',['class'=>'form-control state_code disabled','disabled'=>'true','id' => 'state'])}}
											@error('state_code')
										        <span class="text-danger" role="alert">
										            <strong>{{ $message }}</strong>
										        </span>
										    @enderror	
										</div>
										<div class="col-md-4 from-group mt-2">
											{{ Form::label('city_code', 'City Name:')}}
											{{ Form::select('city_code',array(), '',['class'=>'form-control city_code disabled','disabled'=>'true','id'=>'city'])}}
											@error('city_code')
										        <span class="text-danger" role="alert">
										            <strong>{{ $message }}</strong>
										        </span>
										    @enderror	
										</div>
										<div class="col-md-4 from-group mt-2">
											{{ Form::label('zip_code', 'Zip Code:')}}
											{{ Form::text('zip_code',old('zip_code') ?? $member->zip_code,['class' => 'form-control zip_code readonly','readonly'=>'true','oninput' =>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');",'id' => 'zip_code'])}}
											@error('zip_code')
											<span class="text-danger" role="alert">
											<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-12 from-group  mt-3">
								<div class="card">
									<div class="card-header p-2">
										<h5>Correspondence Address:</h5>
									</div>
									<div class="card-body">	
										<div class="row">
										<div class="col-md-12">
											{{-- <input type="checkbox" name="same_as" id="addr_check" disabled="true"> --}}
											{{Form::checkbox('same_as1',null,$member->same_as !=0 ? true : (old('same_as') != 0 ? true : null),['id'=>'addr_check','class'=>'disabled','disabled'=>'true'])}}
											{{ Form::hidden('same_as', $member->same_as !=0 ? '1' : (old('same_as') != 0 ? '1' : '0') ,['id' => 'same_as']) }}
											{{Form::label('same_as','Same as Permanent Address(Click to copy permanent address data)')}}
										</div>
										<div class="col-md-4 from-group">
											{{Form::label('address1','Address Line')}}
											{{Form::text('address1',old('address1') ?? $member->address1,['class'=>'form-control readonly address1','readonly'=>'true','id' => 'address1'])}}
											@error('address1')
				                                <span class="text-danger" role="alert">
				                                    <strong>{{ $message }}</strong>
				                                </span>
					                        @enderror
										</div>
										<div class="col-md-4 from-group">
											{{ Form::label('country_code1', 'Country Name:')}}
											{{ Form::select('country_code1',$countries, old('country_code1') ?? ($member->country_code !='' ? $member->country_code : '102'),['class'=>'form-control country_code1 disabled','disabled'=>'true','id'=>'country1'])}}	
											@error('country_code1')
												<span class="text-danger" role="alert">
												<strong>{{ $message }}</strong>
												</span>
											@enderror		
										</div>
										<div class="col-md-4 from-group">
											{{ Form::label('state_code1', 'State Name:')}}
											{{ Form::select('state_code1',array(), '',['class'=>'form-control state_code1 disabled','disabled'=>'true','id'=>'state1'])}}
											@error('state_code1')
										        <span class="text-danger" role="alert">
										            <strong>{{ $message }}</strong>
										        </span>
										    @enderror	
										</div>
										<div class="col-md-4 from-group mt-2">
											{{ Form::label('city_code1', 'City Name:')}}
											{{ Form::select('city_code1',array(), '',['class'=>'form-control city_code1 disabled','disabled'=>'true','id'=>'city1'])}}
											@error('city_code1')
										        <span class="text-danger" role="alert">
										            <strong>{{ $message }}</strong>
										        </span>
										    @enderror	
										</div>
										<div class="col-md-4 from-group mt-2">
											{{ Form::label('zip_code1', 'Zip Code:')}}
											{{ Form::text('zip_code1',old('zip_code') ?? $member->zip_code,['class' => 'form-control zip_code1 readonly','readonly'=>'true','oninput' =>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');",'id' => 'zip_code1'])}}
											@error('zip_code1')
											<span class="text-danger" role="alert">
											<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-12 from-group mt-3">
								{{ Form::label('about', 'About:')}}
								{{ Form::textarea('about',old('about') ?? $member->about, ['class'=>'form-control readonly','readonly'=>'true', 'rows' => 2, 'cols' => 40,'id'=>'mytextarea']) }}
								@error('about')
	                                <span class="text-danger" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                </span>
		                        @enderror
							</div>
							{{ Form::close() }}
						</div>			
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
@if($message = Session::get('success'))
    alert('Profile Updated Successfully');
@endif

	$(document).ready(function(){
		 $(function() {
		   $('.dob, .regn_date').datepicker({
		   	format:'yyyy-mm-dd'
		   });
		 });

		var state_id = 'state';
		var state_id1 = 'state1';
		var city_id = 'city';
		var city_id1 = 'city1';

		tinymce.activeEditor.setMode('readonly');

		var country_code = "{{$member->country_code !='' ? $member->country_code : '102'}}";
		var country_code1 = "{{$member->country_code !='' ? $member->country_code : '102'}}";
		var state_code = "{{$member->state_code !=null ? $member->state_code : '1'}}";
		var city_code = "{{$member->city_code !=null ? $member->city_code : '' }}";		
		var state_code1 = "{{$member->state_code1 !=null ? $member->state_code1 : '1'}}";
		var city_code1 = "{{$member->city_code1 !=null ? $member->city_code1 : '' }}";


		if(country_code !='' ){
			states(country_code,state_id,state_code);
			cities(state_code,city_id,city_code1);
		}
		if(country_code1 !=''){
			
			states(country_code1,state_id1,state_code1);
			cities(state_code1,city_id1,city_code1);
		}

		var CheckUpdateMode = "{{old('same_as')}}";
		if(CheckUpdateMode !=''){
			editMode();
		} 

		$('.editBtn').on('click',function(){
			// alert('hello');
			editMode();

		});

		function editMode(){
			tinymce.activeEditor.setMode('design'); 
			$('.readonly').attr('readonly',false);
			$('.disabled').attr('disabled',false);
			$('.editBtn').hide();
			$('.cancelBtn').show();
			$('.updateBtn').show();

			states(country_code,state_id,state_code);
			cities(state_code,city_id,city_code1);

			states(country_code1,state_id1,state_code1);
			cities(state_code1,city_id1,city_code1);
			var same_as = $('#same_as').val();

			if(same_as == '1'){
				addressMode(status=true);
			}
		}
		$('.cancelBtn').on('click',function(){
			location.reload();			
		});


		$('#country, #country1').on('change',function(e){	
			e.preventDefault();
			var country_id = $(this).attr('id');
			// console.log(country_id);
			var country_code = $(this).val();
			if(country_id == 'country'){
				states(country_code,state_id);
			}else{
				states(country_code,state_id1);			
			}
		});
		$('#state, #state1').on('change',function(e){
			e.preventDefault();
			var state = $(this).attr('id');
			var state_code = $(this).val();	

			if(state == 'state'){
				cities(state_code,city_id);
			}else{
				cities(state_code,city_id1);
			}

		});

		$('#addr_check').on('change',function(){
			var check = $("[name='same_as1']:checked").val();
			if(check == 'on'){
				$('#same_as').val('1');
				var address = $('#address').val();
				var zip_code = $('#zip_code').val();
				var country_code = $('#country').val();
				var state_code = $('#state').val();
				var city_code = $('#city').val();

				states(country_code,state_id1,state_code);
				cities(state_code,city_id1,city_code);

				$('#address1').val(address);
				$('#zip_code1').val(zip_code);

				addressMode(status=true);
			
			}else{
				$('#same_as').val('0');
				$('#address1').val('');
				$('#zip_code1').val('');

				var country_code = 102;
				var state_code = 0;

				states(country_code,state_id1,state_code);
				cities(state_code,city_id1,city_code);

				addressMode(status=false);
				
			}
		});

		function addressMode(status){
			$('#address1').attr('readonly',status);
			$('#zip_code1').attr('readonly',status);
			$('#state1').attr('disabled',status);
			$('#city1').attr('disabled',status);
			$('#country1').attr('disabled',status);
		}
	});
</script>
@endsection
