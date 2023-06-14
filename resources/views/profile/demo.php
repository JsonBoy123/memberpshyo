@extends('dashboard.layouts.membermaster')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 ml-3 text-gray-800">Address</h1>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">

			<div class="card-body">
				{{-- {{Form::open(array('url' => '/membership/store_address','method' => 'POST','enctype' => 'multipart/form-data'))}} --}}
					<form action="{{url('/membership/store_address')}}" method="POST">
					<div class="row">
						<div class="col-md-12 form-group">
							<div class="card">
								<div class="card-header p-2">
									<h5>Permanent Address:</h5>
								</div>
							<div class="card-body">	
								<div class="row">
									<div class="col-md-4 from-group">
										<label class="required">Address Line</label>
										<input type="text" name="addr" class="form-control addr">
										{{-- {{Form::label('addr','Address Line',['class' => 'required'])}}
										{{Form::text('addr',old('addr') ?? $memberP->addr,['class'=>'form-control addr','id' => 'address'])}} --}}
										@error('addr')
			                                <span class="text-danger" role="alert">
			                                    <strong>{{ $message }}</strong>
			                                </span>
				                        @enderror
									</div>									
									<div class="col-md-4 from-group">
										<label class="required">Country Name:</label>
										
										<select name="country" class="form-control">
						                    <option value="">Select Country </option>
						                    @foreach ($country as $key => $value)
						                    <option value="{{ $key }}">{{ $value }}</option>
						                    @endforeach
						                </select>
										{{-- {{ Form::label('country_code', 'Country Name:',['class' => 'required'])} --}}
										{{-- {{ Form::select('country_code',countries(), old('country_code') ,['class'=>'form-control country_code','id'=>'country'])}}	 --}}
										@error('country_code')
											<span class="text-danger" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror		
									</div>
									<div class="col-md-4 from-group">
										<label class="required">State Name:</label>
										<select name="state" class="form-control">
						                <option>State</option>
						                </select>

										{{-- {{ Form::label('state_code', 'State Name:',['class' => 'required'])}} --}}
										{{-- {{ Form::select('state_code',array(),'',['class'=>'form-control state_code','id' => 'state'])}} --}}
										@error('state_code')
									        <span class="text-danger" role="alert">
									            <strong>{{ $message }}</strong>
									        </span>
									    @enderror	
									</div>
									<div class="col-md-4 from-group mt-2">
										<label class="required">City Name:</label>
										<select name="state_code" class="form-control" id="state">
						                    <option value="city" id="city"> City Name: </option>
						                    @foreach ($city as $key => $value)
						                        <option value="{{ $key }}">{{ $value }}</option>
						                    @endforeach
						                </select>

										{{-- {{ Form::label('city_code', 'City Name:',['class' => 'required'])}}
										{{ Form::select('city_code',array(),'',['class'=>'form-control city_code','id'=>'city'])}} --}}
										@error('city_code')
									        <span class="text-danger" role="alert">
									            <strong>{{ $message }}</strong>
									        </span>
									    @enderror	
									</div>
									<div class="col-md-4 from-group mt-2">	
										<label class="required">Zip Code:</label>
										<input type="text" name="zip" class="form-control zip">
										{{-- {{ Form::label('zip', 'Zip Code:',['class' => 'required'])}}
										{{ Form::text('zip',old('zip') ?? $memberP->zip ,['class' => 'form-control zip_code','oninput' =>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');",'id' => 'zip_code'])}} --}}
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
										{{-- {{Form::checkbox('same_as1',null,old('same_as') != 0 ? true : null,['id'=>'addr_check'])}}
										{{ Form::hidden('same_as',old('same_as') != 0 ? '1' : '0',['id' => 'same_as']) }} --}}
										{{-- {{Form::label('same_as','Same as Permanent Address(Click to copy permanent address data)')}} --}}

										{{-- <input class="form-check-input" type="checkbox"  name="same_as" value="" {{in_array($role->id,$assignedRoles)?'checked':''}} > --}}
										{{-- <input name="same_as1" type="checkbox" value="1" id="addr_check"> --}}
										<input type="checkbox" id="myCheck" onclick="myFunction()">
										<label name="same_as">Same as Permanent Address(Click to copy permanent address data)</label>
										
										
									</div>
									<div class="col-md-4 from-group">
										<label class="required">Address Line</label>
										<input type="text" name="addr" class="form-control addr">

										{{-- {{Form::label('addr','Address Line',['class' => 'required'])}}
										{{Form::text('addr',old('addr') ?? $memberC->addr ,['class'=>'form-control','id' => 'address1'])}} --}}
										@error('addr')
			                                <span class="text-danger" role="alert">
			                                    <strong>{{ $message }}</strong>
			                                </span>
				                        @enderror
									</div>
									<div class="col-md-4 from-group">
										<label class="required">Country Name:</label>
										
										 <select name="country_code" class="form-control" id="country">
						                    <option value="country_code" id="country1"> Country Name: </option>
						                    @foreach ($country as $key => $value)
						                        <option value="{{ $key }}">{{ $value }}</option>
						                    @endforeach
						                </select>
										{{-- {{ Form::label('country_code', 'Country Name:',['class' => 'required'])}}
										{{ Form::select('country_code',countries(), old('country_code') ?? $memberC->country_code,['class'=>'form-control country_code','id'=>'country1'])}} --}}	
										@error('country_code')
											<span class="text-danger" role="alert">
											<strong>{{ $message }}</strong>
											</span>
										@enderror		
									</div>
									<div class="col-md-4 from-group">
										<label class="required">State Name:</label>
										{{-- <select name="state_code" class="form-control" id="state">
						                    <option value="state" id="state1"> Country Name: </option>
						                    @foreach ($state as $key => $value)
						                        <option value="{{ $key }}">{{ $value }}</option>
						                    @endforeach
						                </select> --}}
										{{-- {{ Form::label('state_code', 'State Name:',['class' => 'required'])}}
										{{ Form::select('state_code',array(), '',['class'=>'form-control state_code','id'=>'state1'])}} --}}
										@error('state_code')
									        <span class="text-danger" role="alert">
									            <strong>{{ $message }}</strong>
									        </span>
									    @enderror	
									</div>
									<div class="col-md-4 from-group mt-2">
										<label class="required">City Name:</label>
										<select name="state_code" class="form-control" id="state">
						                    <option value="city" id="city1"> City Name: </option>
						                    @foreach ($city as $key => $value)
						                        <option value="{{ $key }}">{{ $value }}</option>
						                    @endforeach
						                </select>
										{{-- {{ Form::label('city_code', 'City Name:',['class' => 'required'])}}
										{{ Form::select('city_code',array(), '',['class'=>'form-control city_code','id'=>'city1'])}} --}}
										@error('city_code')
									        <span class="text-danger" role="alert">
									            <strong>{{ $message }}</strong>
									        </span>
									    @enderror	
									</div>
									<div class="col-md-4 from-group mt-2">
										<label class="required">Zip Code:</label>
										<input type="text" name="zip" class="form-control zip">
										{{-- {{ Form::label('zip', 'Zip Code:',['class' => 'required'])}}
										{{ Form::text('zip',old('zip') ?? $memberC->zip ,['class' => 'form-control zip','oninput' =>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');",'id' => 'zip_code1'])}} --}}
										@error('zip')
											<span class="text-danger" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>
									{{-- <div class="col-md-4 form-group mt-2">
										{{Form::label('address_proof_type','Address Proof',['class' => 'required'])}}
										{{Form::select('address_proof_type',ADDRESS_PROOF_TYPE,old('address_proof_type') ?? $memberC->address_proof_type,['class' => 'form-control address_proof_type'])}}
										@error('address_proof_type')
					                        <span class="text-danger" role="alert">
					                            <strong>{{ $message }}</strong>
					                        </span>
					                    @enderror
									</div> --}}
								</div>
	
						{{-- <div class="col-md-6 form-group">
							{{Form::label('address_proof_doc','Address Proof Document',['class' => 'required'])}}
							{{ Form::file('address_proof_doc',['class' => 'form-control'])}}
							@error('address_proof_doc')
		                        <span class="text-danger" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </span>
		                    @enderror
						</div> --}}
								</div>
							</div>
						</div>
						
					</div>
					
				</div>
				<div class="card-footer">
					{{-- {{Form::hidden('service_id',$service->id)}} --}}
					{{Form::submit('Save & Continue',['class' => 'btn btn-sm btn-secondary'])}}		
				</div>
				{{-- {{Form::close()}} --}}
				</form>
		</div>
	</div>
</div>
{{-- <script >
	$(document).ready(function(){
		$('.select2').select2();
		
		$('.required').append('<span class="text-danger">*</span>');

		var state_id = 'state';
		var state_id1 = 'state1';
		var city_id = 'city';
		var city_id1 = 'city1';


		var country_code = "{{old('p_country') !='' ? old('p_country') : ''}}";
		
		var country_code1 = "{{old('c_country') !='' ? old('c_country') : ''}}";
		var state_code = "{{old('p_state') !=null ? old('p_state') : ''}}";
		var city_code = "{{old('p_city') !=null ? old('p_city') : '' }}";		
		var state_code1 = "{{old('c_state') !=null ? old('c_state') : ''}}";
		var city_code1 = "{{old('c_city') !=null ? old('c_city') : '' }}";

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

	})

</script> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 

<script type="text/javascript">
    jQuery('select[name="country"]').on('change',function(){
        var countryID = jQuery(this).val();
            if(countryID)
            {
                jQuery.ajax({
                    url : '/country_dropdown/' +countryID,
                    type : "GET",
                    dataType : "json",
                    success:function(data)
                    {
                        console.log(data);
                        jQuery('select[name="state"]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="state"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                    }
                });
            }
            else
            {
                $('select[name="state"]').empty();
            }
    });
</script>

<script>
function myFunction() {
	function myFunction() {
  var checkBox = document.getElementById("myCheck");
  var text = document.getElementById("text");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
}
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
