@extends('dashboard.layouts.master')
@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Services</h1>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">{{$service->name}}
					{{link_to('/service/'.$service->id, $title = 'Back', $attributes = ['class' => 'btn btn-sm btn-primary pull-right'], $secure = null)}}			
				</h5>	
			</div>
			<div class="card-body">
				{{Form::open(array('url' => '/service/photo_id_card/store','method' => 'POST','enctype' => 'multipart/form-data'))}}
{{-- 					<div class="row mt-3">
						@if($member->old_or_new =='1')
							<div class="col-md-6 form-group">
								<input type="radio" name="old_or_new" value="1" {{ old('old_or_new') == '1' ? 'checked="checked"' : (old('old_or_new') == '0' ? '' : 'checked="checked"' ) }}>
		                        <label for="old_or_new" class="ml-2 mr-3">{{ __('Old Service') }}</label>

		                        <input type="radio" name="old_or_new" value='0' {{ old('old_or_new') == '0' ? 'checked="checked"' : '' }}>
		                        <label for="old_or_new" class="ml-2" >{{ __('New Service') }}</label>
							</div>
							<div class="col-md-6 form-group" id="doc_url">
								{{Form::label('doc_url',$service->name)}}
								{{ Form::file('doc_url',['class' => 'form-control'])}}
								@error('doc_url')
			                        <span class="text-danger" role="alert">
			                            <strong>{{ $message }}</strong>
			                        </span>
			                    @enderror
			                  
							</div>	
						@endif
					</div>					 --}}	
					<div class="row mt-3">
						<div class="col-md-6 form-group">						
							{{Form::label('iap_no','IAP LIFE TIME MEMBERSHIP NUMBER',['class' => 'required'])}}
							{{Form::text('iap_no',old('iap_no') ?? $member->iap_no,['class' => 'form-control iap_no','readonly' =>'readonly'])}}
							@error('iap_no')
		                        <span class="text-danger" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </span>
		                    @enderror							
						</div>
						<div class="col-md-6 form-group">
							{{Form::label('iap_certificate','IAP Certificate Copy')}}
							{{ Form::file('iap_certificate',['class' => 'form-control'])}}
							@error('iap_certificate')
		                        <span class="text-danger" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </span>
		                    @enderror
		                    @if($member->iap_certificate !='')
			                   	 <a href="{{asset('storage/'.$member->iap_certificate)}}" class="mt-1" style="overflow: hidden;"><i class="fa fa-eye"></i> {{file_name($member->iap_certificate)}}
								</a>
							@endif
						</div>	

						<div class="col-md-12 form-group mt-2">
							<h6 class="text-muted">Fee : <i class="fa fa-rupee"></i> {{$service->charges}}</h6>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-12 form-group">
							<h5 class="text-muted">Application Details</h5>
						</div>
						<div class="col-md-4 form-group">
							{{Form::label('first_name','First Name',['class' => 'required'])}}
							{{Form::text('first_name',old('first_name') ?? $member->first_name,['class' => 'form-control'])}}
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
							{{Form::text('mobile',old('mobile') ?? $member->mobile,['class' => 'form-control'])}}
							@error('mobile')
		                        <span class="text-danger" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </span>
		                    @enderror
						</div>
						{{-- <div class="col-md-6 form-group">
							{{Form::label('mobile1','Alternate Mobile Number')}}

							{{Form::text('mobile1',old('mobile1') ?? $member->mobile1,['class' => 'form-control','oninput' =>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"])}}
							@error('mobile1')
		                        <span class="text-danger" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </span>
		                    @enderror
						</div> --}}
						<div class="col-md-6 form-group">
							{{Form::label('email','Email Address')}}
							<span class="text-muted">(This is username you can't change)</span>
							{{Form::email('email',old('email') ?? $member->email,['class' => 'form-control','readonly' => 'true'])}}
							@error('email')
		                        <span class="text-danger" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </span>
		                    @enderror
						</div>
						{{-- <div class="col-md-6 form-group">
							{{Form::label('email1','Alternate Email Address')}}
							{{Form::email('email1',old('email1') ?? $member->email1,['class' => 'form-control'])}}
							@error('email1')
		                        <span class="text-danger" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </span>
		                    @enderror
						</div> --}}
						<div class="col-md-6 form-group">
							{{Form::label('blood_group','Blood Group')}}
							{{Form::select('blood_group',BLOOD_GROUP,old('blood_group') ?? $member->blood_group,['class' => 'form-control blood_group'])}}
							@error('blood_group')
		                        <span class="text-danger" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </span>
		                    @enderror
						</div>
						<div class="col-md-6 form-group">
							{{ Form::label('gender', 'Gender:',['class' => 'required'])}}
							{{ Form::select('gender',GENDER, old('gender') ?? $member->gender,['class'=>'form-control gender'])}}
							@error('gender')
						        <span class="text-danger" role="alert">
						            <strong>{{ $message }}</strong>
						        </span>
						    @enderror	
						</div>
						<div class="col-md-4 form-group">
							{{ Form::label('dob', 'Date of Birth:',['class' => 'required'])}}
							{{ Form::text('dob',old('dob') ?? $member->dob,['class' => 'form-control datepicker dob'])}}
							@error('dob')
						        <span class="text-danger" role="alert">
						            <strong>{{ $message }}</strong>
						        </span>
						    @enderror
						</div>
						<div class="col-md-4 form-group">
							{{ Form::label('place_of_birth', 'Place of Birth:')}}
							{{ Form::text('place_of_birth',old('place_of_birth') ?? $member->place_of_birth,['class' => 'form-control place_of_birth'])}}
							@error('place_of_birth')
						        <span class="text-danger" role="alert">
						            <strong>{{ $message }}</strong>
						        </span>
						    @enderror
						</div>
						<div class="col-md-4 form-group">
							{{ Form::label('country_of_birth', 'Country Name:')}}
							{{ Form::select('country_of_birth',countries(), old('country_of_birth') ?? $member->country_of_birth,['class'=>'form-control country_of_birth'])}}	
							@error('country_of_birth')
								<span class="text-danger" role="alert">
								<strong>{{ $message }}</strong>
								</span>
							@enderror	
						</div>
						<div  class="col-md-12 form-group">
							<p class="text-muted">
								Applicant Father/ Mother/ Husband/Guardian.
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
							{{Form::text('rel_f_name',old('rel_f_name') ?? $member->rel_f_name,['class' => 'form-control'])}}
							@error('rel_f_name')
		                        <span class="text-danger" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </span>
		                    @enderror
						</div>
						<div class="col-md-4 form-group">
							{{Form::label('rel_m_name','Middle Name')}}
							{{Form::text('rel_m_name',old('rel_m_name') ?? $member->rel_m_name,['class' => 'form-control'])}}
							@error('rel_m_name')
		                        <span class="text-danger" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </span>
		                    @enderror
						</div>
						<div class="col-md-4 form-group">
							{{Form::label('rel_l_name','Last Name')}}
							{{Form::text('rel_l_name',old('rel_l_name') ?? $member->rel_l_name,['class' => 'form-control'])}}
							@error('rel_l_name')
		                        <span class="text-danger" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </span>
		                    @enderror
						</div>

						<div class="col-md-6 form-group">
							{{Form::label('qualification_type','Education Qualification Type')}}
							{{Form::select('qualification_type',QUALIFICATION_TYPE,old('qualification_type') ?? $member->qualification_type,['class' => 'form-control'])}}
						</div>
						<div class="col-md-6 form-group">
							{{Form::label('qualification_name','College/School Name')}}
							{{Form::text('qualification_name',old('qualification_name') ?? $member->qualification_name,['class' => 'form-control'])}}
							@error('qualification_name')
		                        <span class="text-danger" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </span>
		                    @enderror
						</div>
						<div class="col-md-6 form-group">
							{{Form::label('qualification_university','University/Board Name')}}
							{{Form::text('qualification_university',old('qualification_university')?? $member->qualification_university,['class' => 'form-control'])}}
							@error('qualification_university')
		                        <span class="text-danger" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </span>
		                    @enderror
						</div>
						<div class="col-md-6 form-group">
							{{Form::label('qualification_year_pass','Year of Passing')}}
							{{Form::text('qualification_year_pass',old('qualification_year_pass') ?? $member->qualification_year_pass,['class' => 'form-control'])}}
							@error('qualification_year_pass')
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
										{{Form::label('p_address','Address Line',['class' => 'required'])}}
										{{Form::text('p_address',old('p_address') ?? $member->p_address,['class'=>'form-control p_address','id' => 'address'])}}
										@error('p_address')
			                                <span class="text-danger" role="alert">
			                                    <strong>{{ $message }}</strong>
			                                </span>
				                        @enderror
									</div>
									<div class="col-md-4 from-group">
										{{ Form::label('p_country', 'Country Name:',['class' => 'required'])}}
										{{ Form::select('p_country',countries(), old('p_country') ?? $member->p_country,['class'=>'form-control p_country','id'=>'country'])}}	
										@error('p_country')
											<span class="text-danger" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror		
									</div>
									<div class="col-md-4 from-group">
										{{ Form::label('p_state', 'State Name:',['class' => 'required'])}}
										{{ Form::select('p_state',array(),'',['class'=>'form-control p_state','id' => 'state'])}}
										@error('p_state')
									        <span class="text-danger" role="alert">
									            <strong>{{ $message }}</strong>
									        </span>
									    @enderror	
									</div>
									<div class="col-md-4 from-group mt-2">
										{{ Form::label('p_city', 'City Name:',['class' => 'required'])}}
										{{ Form::select('p_city',array(),'',['class'=>'form-control p_city','id'=>'city'])}}
										@error('p_city')
									        <span class="text-danger" role="alert">
									            <strong>{{ $message }}</strong>
									        </span>
									    @enderror	
									</div>
									<div class="col-md-4 from-group mt-2">
										{{ Form::label('p_zip_code', 'Zip Code:',['class' => 'required'])}}
										{{ Form::text('p_zip_code',old('p_zip_code') ?? $member->p_zip_code,['class' => 'form-control zip_code','oninput' =>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');",'id' => 'zip_code'])}}
										@error('p_zip_code')
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
										{{Form::checkbox('same_as1',null,(old('same_as') != '0' ? true : null ) ?? ($member->same_as !='0' ? true : null),['id'=>'addr_check'])}}
										{{ Form::hidden('same_as',(old('same_as') != '0' ? '1' : '0') ?? ($member->same_as !='0' ? '1' : '0'),['id' => 'same_as']) }}
										{{Form::label('same_as','Same as Permanent Address(Click to copy permanent address data)')}}
									</div>
									<div class="col-md-4 from-group">
										{{Form::label('c_address','Address Line',['class' => 'required'])}}
										{{Form::text('c_address',old('c_address') ?? $member->c_address,['class'=>'form-control','id' => 'address1'])}}
										@error('c_address')
			                                <span class="text-danger" role="alert">
			                                    <strong>{{ $message }}</strong>
			                                </span>
				                        @enderror
									</div>
									<div class="col-md-4 from-group">
										{{ Form::label('c_country', 'Country Name:',['class' => 'required'])}}
										{{ Form::select('c_country',countries(), old('c_country') ?? $member->c_country,['class'=>'form-control c_country','id'=>'country1'])}}	
										@error('c_country')
											<span class="text-danger" role="alert">
											<strong>{{ $message }}</strong>
											</span>
										@enderror		
									</div>
									<div class="col-md-4 from-group">
										{{ Form::label('c_state', 'State Name:',['class' => 'required'])}}
										{{ Form::select('c_state',array(), '',['class'=>'form-control c_state','id'=>'state1'])}}
										@error('c_state')
									        <span class="text-danger" role="alert">
									            <strong>{{ $message }}</strong>
									        </span>
									    @enderror	
									</div>
									<div class="col-md-4 from-group mt-2">
										{{ Form::label('c_city', 'City Name:',['class' => 'required'])}}
										{{ Form::select('c_city',array(), '',['class'=>'form-control c_city','id'=>'city1'])}}
										@error('c_city')
									        <span class="text-danger" role="alert">
									            <strong>{{ $message }}</strong>
									        </span>
									    @enderror	
									</div>
									<div class="col-md-4 from-group mt-2">
										{{ Form::label('c_zip_code', 'Zip Code:',['class' => 'required'])}}
										{{ Form::text('c_zip_code',old('c_zip_code') ?? $member->c_zip_code,['class' => 'form-control c_zip_code','oninput' =>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');",'id' => 'zip_code1'])}}
										@error('c_zip_code')
											<span class="text-danger" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>
								</div>
								</div>
							</div>
						</div>
						{{-- <div  class="col-md-12 form-group">
							<ul>
								<li>
									Address proof. 
								</li>
							</ul>
						</div> --}}
							
						{{-- <div  class="col-md-12 form-group">
							<p class="text-muted">
								Documents  to be Attach by Applicant
							</p>
						</div>
						<div class="col-md-4 form-group">
							{{Form::label('address_proof_type','Address Proof')}}
							{{Form::select('address_proof_type',ADDRESS_PROOF_TYPE,old('address_proof_type') ?? $member->address_proof_type,['class' => 'form-control address_proof_type'])}}
							@error('address_proof_type')
		                        <span class="text-danger" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </span>
		                    @enderror		              
						</div>
						<div class="col-md-4 form-group">
							{{Form::label('address_proof_doc','Address Proof Document')}}
							{{Form::file('address_proof_doc',['class' => 'form-control'])}}
							@error('address_proof_doc')
		                        <span class="text-danger" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </span>
		                    @enderror
						</div>	
						<div class="col-md-4 form-group">
							<br>
							<a href="" class="form-control mt-1" style="overflow: hidden;" ><i class="fa fa-eye"></i>
								@php
									$file = explode('/', $member->address_proof_doc);
									 $doc = explode('_', $file[4]);
									echo $doc[1];
								@endphp
							</a>
						</div>					
					</div> --}}
					{{-- <div class="row">
						<div class="col-md-12">
							<table class="table">
								<thead>
									<tr>
										<th>Dcoument Type</th>
										<th>Document Upload</th>
										<th>Old Document</th>		
									</tr>
								</thead>
								<tbody>
									<tr>
										<th>{{__('Applicant Signature')}}</th>
										<th>{{ Form::file('signature',['class' => 'form-control','accept'=>"image/*"])}}
											@error('signature')
						                        <span class="text-danger" role="alert">
						                            <strong>{{ $message }}</strong>
						                        </span>
						                    @enderror
										</th>
										<th>		
										@if($member->signature !='')				
										<a href="" class="form-control mt-1" style="overflow: hidden;" ><i class="fa fa-eye"></i>
											@php
												$file = explode('/', $member->signature);
												 $doc = explode('_', $file[4]);
												echo $doc[1];
											@endphp
										</a>
										@endif
										</th>
									</tr>
									<tr>
										<th>{{__('Applicant Photo')}}</th>
										<th>{{ Form::file('photo',['class' => 'form-control','accept'=>"image/*"])}}
										@error('photo')
					                        <span class="text-danger" role="alert">
					                            <strong>{{ $message }}</strong>
					                        </span>
					                    @enderror
										</th>
										@if($member->photo !='')	
										<th>
											<a href="" class="form-control mt-1" style="overflow: hidden;"><i class="fa fa-eye"></i>
												@php
													$file = explode('/', $member->photo);
													 $doc = explode('_', $file[4]);
													echo $doc[1];
												@endphp
											</a>
										</th>
										@endif
									</tr>
									<tr>
										<th>{{__('10th Marksheet')}}</th>
										<th>
										{{ Form::file('ten_doc',['class' => 'form-control','accept'=>"image/*"])}}
										@error('ten_doc')
					                        <span class="text-danger" role="alert">
					                            <strong>{{ $message }}</strong>
					                        </span>
					                    @enderror
										</th>
										@if($member->ten_doc !='')	
										<th>
											<a href="" class="form-control mt-1" style="overflow: hidden;"><i class="fa fa-eye"></i>
												@php
													$file = explode('/', $member->ten_doc);
													 $doc = explode('_', $file[4]);
													echo $doc[1];
												@endphp
											</a>
										</th>
										@endif
									</tr>
									<tr>
										<th>{{__('12th Marksheet')}}</th>
										<th>
										{{ Form::file('twelve_doc',['class' => 'form-control','accept'=>"image/*"])}}
										@error('twelve_doc')
					                        <span class="text-danger" role="alert">
					                            <strong>{{ $message }}</strong>
					                        </span>
					                    @enderror
										</th>
										@if($member->twelve_doc !='')	
										<th>
											<a href="" class="form-control mt-1" style="overflow: hidden;"><i class="fa fa-eye"></i>
												@php
													$file = explode('/', $member->twelve_doc);
													 $doc = explode('_', $file[4]);
													echo $doc[1];
												@endphp
											</a>
										</th>
										@endif
									</tr>
									<tr>
										<th>{{__('Internship Certificate')}}</th>
										<th>
										{{ Form::file('internship_doc',['class' => 'form-control','accept'=>"image/*"])}}
										@error('internship_doc')
					                        <span class="text-danger" role="alert">
					                            <strong>{{ $message }}</strong>
					                        </span>
					                    @enderror
										</th>
										@if($member->internship_doc !='')	
										<th>
											<a href="" class="form-control mt-1" style="overflow: hidden;"><i class="fa fa-eye"></i>
												@php
													$file = explode('/', $member->internship_doc);
													 $doc = explode('_', $file[4]);
													echo $doc[1];
												@endphp
											</a>
										</th>
										@endif
									</tr>
									<tr>
										<th>{{__('Bachelor of Physiotherapy (B.P.T.)')}}</th>
										<th>
										{{ Form::file('bpt_doc',['class' => 'form-control','accept'=>"image/*"])}}
										@error('bpt_doc')
					                        <span class="text-danger" role="alert">
					                            <strong>{{ $message }}</strong>
					                        </span>
					                    @enderror
										</th>
										@if($member->bpt_doc !='')
										<th>
											<a href="" class="form-control mt-1" style="overflow: hidden;"><i class="fa fa-eye"></i>
												@php
													$file = explode('/', $member->bpt_doc);
													 $doc = explode('_', $file[4]);
													echo $doc[1];
												@endphp
											</a>
										</th>
										@endif
									</tr>
									<tr>
										<th>{{__('Master of Physiotherapy (M.P.T.)')}}</th>
										<th>
										{{ Form::file('mpt_doc',['class' => 'form-control','accept'=>"image/*"])}}
										@error('mpt_doc')
					                        <span class="text-danger" role="alert">
					                            <strong>{{ $message }}</strong>
					                        </span>
					                    @enderror
										</th>
										@if($member->mpt_doc !='')
										<th>
											<a href="" class="form-control mt-1" style="overflow: hidden;"><i class="fa fa-eye"></i>
												@php
													$file = explode('/', $member->mpt_doc);
													 $doc = explode('_', $file[4]);
													echo $doc[1];
												@endphp
											</a>
										</th>
										@endif
									</tr>
									<tr>
										<th>{{__('Any Goverment Proof')}}</th>
										<th>
										{{ Form::file('gov_proof',['class' => 'form-control','accept'=>"image/*"])}}
										@error('gov_proof')
					                        <span class="text-danger" role="alert">
					                            <strong>{{ $message }}</strong>
					                        </span>
					                    @enderror
										</th>
										@if($member->gov_proof !='')
										<th>
											<a href="" class="form-control mt-1" style="overflow: hidden;"><i class="fa fa-eye"></i>{
												@php
													$file = explode('/', $member->gov_proof);
													 $doc = explode('_', $file[4]);
													echo $doc[1];
												@endphp
											</a>
										</th>
										@endif
									</tr>
									<tr>
										<th>{{__('Any Goverment Proof')}}</th>
										<th>
										{{ Form::file('gov_proof1',['class' => 'form-control','accept'=>"image/*"])}}
										@error('gov_proof1')
					                        <span class="text-danger" role="alert">
					                            <strong>{{ $message }}</strong>
					                        </span>
					                    @enderror
										</th>
										@if($member->gov_proof1 !='')
										<th>

											<a href="" class="form-control mt-1" style="overflow: hidden;"><i class="fa fa-eye"></i>
												@php
													$file = explode('/', $member->gov_proof1);
													 $doc = explode('_', $file[4]);
													echo $doc[1];
												@endphp
											</a>
										</th>
										@endif
									</tr>
									<tr>
										<th>{{__('Any Other Document')}}</th>
										<th>
										{{ Form::file('any_other_doc',['class' => 'form-control','accept'=>"image/*"])}}
										@error('any_other_doc')
					                        <span class="text-danger" role="alert">
					                            <strong>{{ $message }}</strong>
					                        </span>
					                    @enderror
										</th>
										@if($member->any_other_doc !='')
										<th>

											<a href="" class="form-control mt-1" style="overflow: hidden;"><i class="fa fa-eye"></i>
												@php
													$file = explode('/', $member->any_other_doc);
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
 --}}
				</div>
				<div class="card-footer">
					{{Form::hidden('service_id',$service->id)}}
					{{Form::submit('Submit',['class' => 'btn btn-sm btn-success'])}}		
				</div>
				{{Form::close()}}
		</div>
	</div>
</div>
<script >
	$(document).ready(function(){
		$(function() {
			$('.dob').datepicker({
				format:'yyyy-mm-dd'
			});
		});

		$('.select2').select2();
		
		$('.required').append('<span class="text-danger">*</span>');


		var state_id = 'state';
		var state_id1 = 'state1';
		var city_id = 'city';
		var city_id1 = 'city1';


		var country_code = "{{old('p_country') !='' ? old('p_country') : ($member->p_country !='' ? $member->p_country : '')}}";
		var country_code1 = "{{old('c_country') !='' ? old('c_country') : ($member->c_country !='' ? $member->c_country : '')}}";

		var state_code = "{{old('p_state') !=null ? old('p_state') : ($member->p_state !='' ? $member->p_state : '')}}";
		var city_code = "{{old('p_city') !=null ? old('p_city') : ($member->p_city !='' ? $member->p_city : '') }}";		
		var state_code1 = "{{old('c_state') !=null ? old('c_state') : ($member->c_state !='' ? $member->c_state : '')}}";
		var city_code1 = "{{old('c_city') !=null ? old('c_city') : ($member->c_city !='' ? $member->c_city : '') }}";		
	
		if(country_code !='' ){
			states(country_code,state_id,state_code);
			cities(state_code,city_id,city_code1);
		}
		if(country_code1 !=''){
			
			states(country_code1,state_id1,state_code1);
			cities(state_code1,city_id1,city_code1);
		}



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
			// console.log(check);
			if(check == 'on'){
				$('#same_as').val('1');
				var address = $('#address').val();
				var zip_code = $('#zip_code').val();
				var country_code = $('#country').val();
				var state_code = $('#state').val();
				var city_code = $('#city').val();


				$('#country1').val(country_code);
				states(country_code,state_id1,state_code);
				cities(state_code,city_id1,city_code);

				$('#address1').val(address);
				$('#zip_code1').val(zip_code);
			
			}else{
				$('#same_as').val('0');
				$('#address1').val('');
				$('#zip_code1').val('');

				var country_code = '';
				var state_code = '';

				states(country_code,state_id1,state_code);
				cities(state_code,city_id1,city_code);				
			}
		});

		$('input[name="old_or_new"]').on('change',function(e){
            e.preventDefault();
            var old_or_new = $(this).val();
            status_change(old_or_new);
        });
        var old_or_new = "{{old('old_or_new') !='' ? old('old_or_new') : ''}}";
        if(old_or_new != ''){
            status_change(old_or_new);
        }

        function status_change(old_or_new){
            if(old_or_new == '1'){
                $('#doc_url').show();
            }else{
                $('#doc_url').hide();
            }
        }

	})

</script>
@endsection
