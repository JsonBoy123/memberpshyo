@extends('dashboard.layouts.membermaster')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 ml-3 text-gray-800">Update Address</h1>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">

		@if(session('success'))
		    <div class="alert alert-success">
		        {{ session('success') }}
		    </div>
		@endif

			<div class="card-body">
				
				<form action="{{url('/membership/update_address')}}" method="POST">
					@csrf
					<div class="row">	
						<div class="col-md-12 form-group">
							<div class="card">
								<div class="card-header p-2">
									<h5>Permanent Address:</h5>
								</div>
							<div class="card-body">	
								<div class="row">
									<div class="col-md-4 from-group">
										<input type="hidden" name="address_type" value="{{$memberP->address_type}}">
										<label class="required">Address Line</label>
										<input type="text" name="addr" value="{{$memberP->addr}}" id="addr" class="form-control">
										@error('addr')
                      <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
									</div>									
									<div class="col-md-4 from-group">
											
										<label class="required">Country Name:</label>
										<select name="country" class="form-control" id="country">
	                    <option value="">Select Country </option>
	                    @foreach ($country as  $value)
	                    <option @if($value->country_code == $memberP->country_code) selected  @endif value="{{ $value->country_code }}">{{ $value->country_name }}</option>
	                     @endforeach
		                   
		                </select>

		               {{--  <select name="country" class="form-control" id="country">
                      <option value="" selected="selected" >Select country</option>
                        @foreach($country as $key => $value)
                          <option {{ $country->category == $value->id ? 'selected':''}} value="{{ $key }}">{{ $value }}</option>
                        @endforeach
	                  </select> --}}

										@error('country_code')
											<span class="text-danger" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror		
									</div>

									<div class="col-md-4 from-group">
										<label class="required">State Name:</label>
										<select id="state" class="form-control" name="state_code">
											@foreach ($states as  $state)
	                     <option @if($state->state_code == $memberP->state_code) selected  @endif value="{{ $state->state_code }}">{{ $state->state_name }}</option>
	                     @endforeach
		                </select>

										@error('state_code')
								        <span class="text-danger" role="alert">
								            <strong>{{ $message }}</strong>
								        </span>
									  @enderror	
									</div>
									
									<div class="col-md-4 from-group mt-2">
										<label class="required">City Name:</label>
										<select class="form-control" name="city_code" id="city">
											@foreach ($cities as  $city)
	                     <option @if($city->city_code == $memberP->city_code) selected  @endif value="{{ $city->city_code }}">{{ $city->city_name }}</option>
	                     @endforeach
		                </select>

										@error('city_code')
								        <span class="text-danger" role="alert">
								            <strong>{{ $message }}</strong>
								        </span>
									   @enderror	
									</div>	

									<div class="col-md-4 from-group mt-2">
										<label class="required">Zip Code</label>
										<input type="text" name="zip" value="{{$memberP->zip}}" id="zip" class="form-control">
										
										@error('zip')
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
							<div class="card">
								<div class="card-header p-2">
									<h5>Correspondence Address:</h5>
								</div>
								<div class="card-body">	
								<div class="row">
									<div class="col-md-12 ml-4">
										<input type="hidden" name="address_type1" value="{{$memberC->address_type}}">
										<input type="checkbox" id="checker" name="checker">
										<label name="same_as">Same as Permanent Address(Click to copy permanent address data)</label>
										<p id="text" style="display:none">Checkbox is CHECKED!</p>
										
									</div>
									<div class="col-md-4 from-group">

										<label class="required">Address Line</label>
										<input type="text" name="addr1" value="{{$memberC->addr}}" id="addr1" class="form-control">
										@error('addr')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
									</div>
									<div class="col-md-4 from-group">
										<label class="required">Country Name:</label>
										
										<select name="country1" id="country1" class="form-control">
		                    <option value="">Select Country </option>
	                    @foreach ($country as  $value)
	                     <option @if($value->country_code == $memberC->country_code) selected  @endif value="{{ $value->country_code }}">{{ $value->country_name }}</option>
	                     @endforeach
		                </select>
										@error('country_code')
											<span class="text-danger" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror		
									</div>

									<div class="col-md-4 from-group">
										<label class="required">State Name:</label>
										<select name="state_code1" id="state1" class="form-control">
											@foreach ($states as  $state)
	                     <option @if($state->state_code == $memberC->state_code) selected  @endif value="{{ $state->state_code }}">{{ $state->state_name }}</option>
	                     @endforeach
		                </select>

										@error('state_code')
							        <span class="text-danger" role="alert">
							            <strong>{{ $message }}</strong>
							        </span>
								    @enderror	
									</div>

									<div class="col-md-4 from-group mt-2">
										<label class="required">City Name:</label>
										<select id="city1" name="city_code1" class="form-control">
											@foreach ($cities as  $city)
	                     <option @if($city->city_code == $memberC->city_code) selected  @endif value="{{ $city->city_code }}">{{ $city->city_name }}</option>
	                     @endforeach
		                </select>

										@error('city_code')
							        <span class="text-danger" role="alert">
							            <strong>{{ $message }}</strong>
							        </span>
								    @enderror	
									</div>
									<div class="col-md-4 from-group mt-2">
										<label class="required">Zip Code:</label>
										<input type="text" name="zip1" value="{{$memberC->zip}}" id="zip1" class="form-control">
										
										@error('zip')
											<span class="text-danger" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>
									
								</div>
	
						
								</div>
							</div>
						</div>
						
					</div>
					
				</div>
				<div class="card-footer">
					<button type="submit" name="submit" value="submit" class="btn btn-sm btn-secondary">Submit</button>
					{{-- {{Form::hidden('service_id',$service->id)}} --}}
					{{-- {{Form::submit('Save & Continue',['class' => 'btn btn-sm btn-secondary'])}} --}}		
				</div>
				</form>
				{{-- {{Form::close()}} --}}
		</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
	jQuery(document).ready(function(){
		jQuery('#country').change(function(){
			let cid=jQuery(this).val();

			jQuery.ajax({
				url:'/country_dropdown',
				type:'post',
				data:'cid='+cid+'&_token={{csrf_token()}}',
				success:function(result){
				 	if(result){
              $("#state").empty();
              $("#state").append('<option>Select State</option>');
              $.each(result,function(key,value){
                  $("#state").append('<option value="'+key+'">'+value+'</option>');
              });
         
          }else{
              $("#state").empty();
          }
				}
			})
		})
	});

	jQuery(document).ready(function(){
		jQuery('#state').change(function(){
			let sid=jQuery(this).val();
			jQuery.ajax({
				url:'/state_dropdown',
				type:'post',
				data:'sid='+sid+'&_token={{csrf_token()}}',
				success:function(result){
					if(result){
              $("#city").empty();
              $("#city").append('<option>Select City</option>');
              $.each(result,function(key,value){
                  $("#city").append('<option value="'+key+'">'+value+'</option>');
              });
         
          }else{
             $("#city").empty();
          }
				}
			})
		})
	});

	jQuery(document).ready(function(){
		jQuery('#country1').change(function(){
			let cid1=jQuery(this).val();
			jQuery.ajax({
				url:'/country_dropdown1',
				type:'post',
				data:'cid1='+cid1+'&_token={{csrf_token()}}',
				success:function(result){
					if(result){
              $("#state1").empty();
              $("#state1").append('<option>Select State</option>');
              $.each(result,function(key,value){
                  $("#state1").append('<option value="'+key+'">'+value+'</option>');
              });
         
          }else{
             $("#state1").empty();
          }
				}
			})
		})
	});

	jQuery(document).ready(function(){
		jQuery('#state1').change(function(){
			let sid1=jQuery(this).val();
			jQuery.ajax({
				url:'/state_dropdown1',
				type:'post',
				data:'sid1='+sid1+'&_token={{csrf_token()}}',
				success:function(result){
					if(result){
              $("#city1").empty();
              $("#city1").append('<option>Select City</option>');
              $.each(result,function(key,value){
                  $("#city1").append('<option value="'+key+'">'+value+'</option>');
              });
         
          }else{
             $("#city1").empty();
          }
				}
			})
		})
	});
		

	$(document).ready(function(){
    $("input#checker").bind("click",function(o){
      if($("input#checker:checked").length){
          $("#addr1").val($("#addr").val());
          $("#country1").val($("#country").val());	
          $("#state1").val($("#state").val());
          $("#city1").val($("#city").val());
          $("#zip1").val($("#zip").val());

      }else{
          $("#addr1").val("");
          $("#country1").val("");
          $("#state1").val("");
          $("#city1").val("");
          $("#zip1").val("");
      }
    });
  	});

		
</script>

{{-- <script >
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


		var country_code = "{{old('p_country') !='' ? old('p_country') : ($memberP->p_country !='' ? $memberP->p_country : '')}}";
		var country_code1 = "{{old('c_country') !='' ? old('c_country') : ($memberC->c_country !='' ? $memberC->c_country : '')}}";

		var state_code = "{{old('p_state') !=null ? old('p_state') : ($memberP->p_state !='' ? $memberP->p_state : '')}}";
		var city_code = "{{old('p_city') !=null ? old('p_city') : ($memberP->p_city !='' ? $memberP->p_city : '') }}";		
		var state_code1 = "{{old('c_state') !=null ? old('c_state') : ($memberC->c_state !='' ? $memberC->c_state : '')}}";
		var city_code1 = "{{old('c_city') !=null ? old('c_city') : ($memberC->c_city !='' ? $memberC->c_city : '') }}";		
	
		if(country_code !='' ){
			console.log('Asdasd')
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
			console.log(check);
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

	})

</script> --}}
@endsection