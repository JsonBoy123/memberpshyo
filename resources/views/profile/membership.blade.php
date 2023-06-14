@extends('dashboard.layouts.membermaster')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 ml-3 text-gray-800">Profile</h1>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			
			<div class="card-body">
				{{Form::open(array('url' => '/membership/store','method' => 'POST','enctype' => 'multipart/form-data'))}}

					<div class="row mt-3">	
					
						<div class="col-md-6 form-group"> 
							{{-- @if($service->id == '10' || $service->id == '12') --}} 
							{{Form::label('college_code','Select your college name(List of IAP recognised college)')}}
							{{Form::select('college_code',colleges(),old('college_code') ?? $member->college_code,['class' => 'form-control college_code select2','id'=>'a'])}}
							@error('college_code')
		                        <span class="text-danger" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </span>
		                    @enderror
		                </div>
						{{-- @else --}}
						<div class="col-md-6 form-group">
							{{Form::label('college_name','College Name',['class' => 'required'])}}
							{{-- {{Form::text('college_name',old('college_name') ?? $member->college_name,['class' => 'form-control college_name','id'=>'collegess'])}} --}}
							{{Form::text('college_name',old('college_name') ?? $member->college_name,['class' => 'form-control college_name','id'=>'collegess'])}}
							{{-- {!! Form::email(‘Email’, ‘ ‘,[‘class’ => ‘form-control’]) !!} --}}
							@error('college_name')
		                        <span class="text-danger" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </span>
		                    @enderror

						{{-- @endif --}}
						</div>

	                   {{--  @endif --}}

					</div>
					<hr>
					<div class="row">
						@if($member->old_or_new =='1')
							<div class="col-md-6 form-group">
								{{Form::label('iap_no','IAP Number',['class' => 'required'])}}
								<div class="input-group mb-3">
	                                {{-- <div class="input-group-prepend">
	                                    <span class="input-group-text" id="basic-addon1">L - </span>
	                                </div> --}}

									{{Form::text('iap_no',old('iap_no') ?? $member->iap_no ,['class' => 'form-control',
									'readonly' => 'true','oninput' =>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"])}}
									@error('iap_no')
				                        <span class="text-danger" role="alert">
				                            <strong>{{ $message }}</strong>
				                        </span>
				                    @enderror
			                	</div>
							</div>
							<div class="col-md-6 form-group">
								{{Form::label('iap_certificate','IAP Certificate',['class' => 'required'])}}
								{{ Form::file('iap_certificate',['class' => 'form-control'])}}
								@error('iap_certificate')
			                        <span class="text-danger" role="alert">
			                            <strong>{{ $message }}</strong>
			                        </span>
			                    @enderror
							</div>

						@endif

						<div class="col-md-12 form-group">
							<h5 class="text-muted">Application Details</h5>
						</div>
						<div class="col-md-4 form-group">
							{{-- {{Form::label('first_name','First Name',['class' => 'required'])}} --}}
							{{-- {{Form::text('first_name',old('first_name') ?? $member->first_name ,['class' => 'form-control'])}} --}}

							<label class="required">First name</label>
							<input type="text" name="first_name" value="{{$member->first_name}}" class="form-control">
							@error('first_name')
		                        <span class="text-danger" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </span>
		                    @enderror
						</div>
						<div class="col-md-4 form-group">
							{{Form::label('middle_name','Middle Name')}}
							{{Form::text('middle_name',old('middle_name') ?? $member->middle_name,['class' => 'form-control'])}}
							@error('middle_name')
		                        <span class="text-danger" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </span>
		                    @enderror
						</div>
						<div class="col-md-4 form-group">
							{{Form::label('last_name','Last Name',['class' => 'required'])}}
							{{Form::text('last_name',old('last_name') ?? $member->last_name,['class' => 'form-control'])}}
							@error('last_name')
		                        <span class="text-danger" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </span>
		                    @enderror
						</div>
						<div class="col-md-6 form-group">
							{{Form::label('mobile','Mobile Number')}}
							{{Form::text('mobile',old('mobile') ?? Auth::user()->phone,['class' => 'form-control'])}}
							@error('mobile')
		                        <span class="text-danger" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </span>
		                    @enderror
						</div>
						<div class="col-md-6 form-group">
							{{Form::label('mobile1','Alternate Mobile Number')}}
							{{Form::text('mobile1',old('mobile1')  ?? $member->mobile1,['class' => 'form-control','oninput' =>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"])}}
							@error('mobile1')
		                        <span class="text-danger" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </span>
		                    @enderror
						</div>
						<div class="col-md-6 form-group">
							{{Form::label('email','Email Address')}}
							{{Form::email('email',old('email') ?? Auth::user()->email,['class' => 'form-control','readonly' => 'true'])}}
							@error('email')
		                        <span class="text-danger" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </span>
		                    @enderror
						</div>
						<div class="col-md-6 form-group">
							{{Form::label('email1','Alternate Email Address')}}
							{{Form::email('email1',old('email1') ?? $member->email1,['class' => 'form-control'])}}
							@error('email1')
		                        <span class="text-danger" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </span>
		                    @enderror
						</div>
						<div class="col-md-6 form-group">
							{{Form::label('blood_group','Blood Group')}}
							{{Form::select('blood_group',BLOOD_GROUP,'',['class' => 'form-control blood_group'])}}
							@error('blood_group')
		                        <span class="text-danger" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </span>
		                    @enderror
						</div>
						<div class="col-md-6 form-group">
							{{ Form::label('gender', 'Gender:',['class' => 'required'])}}
							{{-- {{ Form::select('gender',GENDER,old('gender'),['class'=>'form-control gender'])}} --}}
							{{ Form::select('gender',GENDER, old('gender') ?? $member->gender,['class'=>'form-control gender']) }}
							
							@error('gender')
						        <span class="text-danger" role="alert">
						            <strong>{{ $message }}</strong>
						        </span>
						    @enderror	
						</div>
						<div class="col-md-4 form-group">
							{{ Form::label('dob', 'Date of Birth:',['class' => 'required'])}}
							{{ Form::text('dob',old('dob') ?? $member->dob ,['class' => 'form-control datepicker dob'])}}
							@error('dob')
						        <span class="text-danger" role="alert">
						            <strong>{{ $message }}</strong>
						        </span>
						    @enderror
						</div>
						<div class="col-md-4 form-group">
							{{ Form::label('place_of_birth', 'Place of Birth:')}}
							{{ Form::text('place_of_birth',old('place_of_birth')  ?? $member->place_of_birth ,['class' => 'form-control place_of_birth'])}}
							@error('place_of_birth')
						        <span class="text-danger" role="alert">
						            <strong>{{ $message }}</strong>
						        </span>
						    @enderror
						</div>
						<div class="col-md-4 form-group">
							{{ Form::label('country_of_birth', 'Country Name:')}}
							{{-- {{ Form::select('country_of_birth',countries(), '',['class'=>'form-control country_of_birth'])}} --}}

							<select name="country_of_birth" class="form-control">
							<option value="">Select Country </option>
							@foreach ($country as  $value)
	                    	<option @if($value->country_code == $member->country_of_birth) selected  @endif value="{{ $value->country_code }}">{{ $value->country_name }}</option>
	                     	@endforeach
	                        </select>

							@error('country_of_birth')
								<span class="text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror	
						</div>
					</div>
					<hr>	
					<div class="row">
						<div  class="col-md-12 mt-3">
							<p class="text-muted">
								Applicant Father/ Mother/ Husband/ Guardian.
							</p>
						</div>
						<div class="col-md-12 form-group">
							{{Form::label('relation_type','Relation Type')}}
							{{Form::select('relation_type',RELATION_TYPE,old('relation_type') ?? $member->relation_type,['class' => 'form-control relation_type'])}}
							@error('relation_type')
		                        <span class="text-danger" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </span>
		                    @enderror
						</div>
						<div class="col-md-4 form-group">
							{{Form::label('rel_f_name','First Name')}}
							{{Form::text('rel_f_name',old('rel_f_name') ?? $member->rel_f_name ,['class' => 'form-control'])}}
							@error('rel_f_name')
		                        <span class="text-danger" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </span>
		                    @enderror
						</div>
						<div class="col-md-4 form-group">
							{{Form::label('rel_m_name','Middle Name')}}
							{{Form::text('rel_m_name',old('rel_m_name') ?? $member->rel_m_name ,['class' => 'form-control'])}}
							@error('rel_m_name')
		                        <span class="text-danger" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </span>
		                    @enderror
						</div>
						<div class="col-md-4 form-group">
							{{Form::label('rel_l_name','Last Name')}}
							{{Form::text('rel_l_name',old('rel_l_name') ?? $member->rel_l_name ,['class' => 'form-control'])}}
							@error('rel_l_name')
		                        <span class="text-danger" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </span>
		                    @enderror
						</div>

						</div>
						<hr>	
						<br>
						<div class="row">
						<div class="col-md-6 form-group">
							{{Form::label('qualification_type','Education Qualification Type',['class' => 'required'])}}
							{{-- {{Form::select('qualification_type',QUALIFICATION_TYPE,'',['class' => 'form-control'])}} --}}
							{{Form::select('qualification_type',QUALIFICATION_TYPE,old('qualification_type') ?? $member->qualification_type,['class' => 'form-control'])}}
						</div>
						<div class="col-md-6 form-group">
							{{Form::label('qualification_name','College/School Name',['class' => 'required'])}}
							{{-- {{Form::text('qualification_name',old('qualification_name') ?? $member->qualification_name ,['class' => 'form-control'])}} --}}
							{{Form::text('qualification_name',old('qualification_name') ?? $member->qualification_name,['class' => 'form-control'])}}
							@error('qualification_name')
		                        <span class="text-danger" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </span>
		                    @enderror
						</div>
						<div class="col-md-6 form-group">
							{{Form::label('qualification_university','University/Board Name',['class' => 'required'])}}
							{{Form::text('qualification_university',old('qualification_university')  ?? $member->qualification_university ,['class' => 'form-control'])}}
							@error('qualification_university')
		                        <span class="text-danger" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </span>
		                    @enderror
						</div>

						<div class="col-md-6 form-group">
							{{Form::label('qualification_year_pass','Year of Passing',['class' => 'required'])}}
							{{Form::text('qualification_year_pass',old('qualification_year_pass')  ?? $member->qualification_year_pass,['class' => 'form-control','oninput' =>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"])}}
							@error('qualification_year_pass')
		                        <span class="text-danger" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </span>
		                    @enderror
						</div>

						<div class="col-md-6 form-group mt-2">
							{{Form::label('address_proof_type','Address Proof',['class' => 'required'])}}
							{{Form::select('address_proof_type',ADDRESS_PROOF_TYPE,old('address_proof_type') ?? $member->address_proof_type,['class' => 'form-control address_proof_type'])}}
							@error('address_proof_type')
		                        <span class="text-danger" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </span>
		                    @enderror
						</div>

						<div class="col-md-6 form-group mt-2">
							{{Form::label('address_proof_doc','Address Proof Document',['class' => 'required'])}}
							{{ Form::file('address_proof_doc',['class' => 'form-control'])}}
							@if($member->address_proof_doc !='')				
								<a href="{{asset('storage/'.$member->address_proof_doc)}}" class="mt-1" style="overflow: hidden;"><i class="fa fa-eye"></i><img src="{{asset('storage/'.$member->address_proof_doc)}}" >
								</a>
							
							@endif
							@error('address_proof_doc')
		                        <span class="text-danger" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </span>
		                    @enderror
						</div>

						<div class="col-md-6 form-group mt-2">
							{{Form::label('signature','Applicant Signature',['class' => 'required'])}}
							{{ Form::file('signature',['class' => 'form-control','accept'=>"image/*"])}}
							@if($member->signature !='')				
								<a href="{{asset('storage/'.$member->signature)}}" class="mt-1" style="overflow: hidden;"><i class="fa fa-eye"></i><img src="{{asset('storage/'.$member->signature)}}" >
								</a>
							
							@endif
							@error('signature')
						        <span class="text-danger" role="alert">
						            <strong>{{ $message }}</strong>
						        </span>
						    @enderror
						</div>
						<div class="col-md-6 form-group mt-2">
							{{ Form::label('photo','Applicant Photo',['class' => 'required'])}}
							{{ Form::file('photo',['class' => 'form-control','accept'=>"image/*"])}}
							@if($member->photo !='')	
								<th>
									<a href="{{asset('storage/'.$member->photo)}}" class="mt-1" style="overflow: hidden;"><i class="fa fa-eye"></i><img src="{{asset('storage/'.$member->photo)}}" >
									</a>
							
								</th>
							@endif
							@error('photo')
					            <span class="text-danger" role="alert">
					                <strong>{{ $message }}</strong>
					            </span>
					        @enderror
						</div>
						
					</div>
					

				</div>
				<div class="card-footer">
					{{-- {{Form::hidden('service_id',$service->id)}} --}}
					{{Form::submit('Save & Continue',['class' => 'btn btn-sm btn-secondary'])}}		
				</div>
				{{Form::close()}}
		</div>
	</div>
</div>
<script >
	$(document).ready(function(){
		$('.select2').select2();
		
		$('.required').append('<span class="text-danger">*</span>');

		$(function() {
			$('.dob').datepicker({
				format:'yyyy-mm-dd'
			});
		});
		
        $('input[name="status"]').on('change',function(e){
            e.preventDefault();
            var status = $(this).val();

            status_change(status);
        });
        var status = "{{old('status') !='' ? old('status') : ''}}";
        if(status != ''){
            status_change(status);
        }

        function status_change(status){
            if(status == '1'){
                $('#text_college').show();
                $('#select_college').hide();

            }else{
                $('#text_college').hide();
                $('#select_college').show();
            }
        }

        $(document).ready(function(){
		    $("#a").change(function(){
		        let a = $("#a").val();
		        
		        jQuery.ajax({
				url:'/college_dropdown',
				type:'post',
				data:'a='+a+'&_token={{csrf_token()}}',
				success:function(result){
					// alert(result);
					if(result){
						$("#collegess").val(result);
		             	// $("#college").empty();
		              // 	$("#college").append('<option>College Name</option>');
		              // 	$.each(result,function(value){
		              //      $("#college").append('<option>'+value+'</option>');
		              // 	});
		         
		          	}else{
		             	$("#college").empty();
		          	}
				}
				})
		        // $("#b").val(a);
		    });
		});

	})

</script>
@endsection
