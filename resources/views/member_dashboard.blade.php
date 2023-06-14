@php $member_detl = get_member_details(); @endphp

@php $member_detl_address_p = get_member_address_p(); @endphp

@php $member_detl_address_c = get_member_address_C(); @endphp



<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-md-2">
						<div class="row">
							<div class="col-md-12 mb-3">
								<label>Profile Photo</label>
								<img src="{{asset('storage/'.$member_detl->photo)}}"  alt="Profile Photo" style="height: 180px; width: 90%">
							</div>
							<div class="col-md-12 mb-3">
								<label>Signature</label>
								<img src="{{asset('storage/'.$member_detl->signature)}}"  alt="signature Photo" style="height: 90px; width: 90%">
							</div>
						</div>
					</div>
					<div class="col-md-10">
						<div class="row">
							<div class="col-md-2.5 ">
								<label>IAP Number</label>
								<input type="text" name="" value="{{$member_detl->iap_no}}" readonly="readonly" class="form-control">
								<label>First Name</label>
									<input type="text" name="" value="{{$member_detl->first_name}}" readonly="readonly" class="form-control">
								<label>Marital Status</label>
									<input type="text" name="" value="{{$member_detl->marital_status}}" readonly="readonly" class="form-control">
								<label>Blood Group</label>
									<input type="text" name="" value="{{$member_detl->blood_group !=null ? Arr::get(BLOOD_GROUP,$member_detl->blood_group) : 'nil' }}" readonly="readonly" class="form-control">
								<label>Relation</label>
									<input type="text" name="" value="{{$member_detl->relation_type}}" readonly="readonly" class="form-control">
							</div>
							<div class="col-md-2.5 ">
								<label>College Name</label>
								    <input type="text" name="" value="{{$member_detl->college_name}}" readonly="readonly" class="form-control">
								<label>Middle Name</label>
									<input type="text" name="" value="{{$member_detl->middle_name}}" readonly="readonly" class="form-control">
								<label>Date Of Birth</label>
									<input type="text" name="" value="{{$member_detl->dob}}" readonly="readonly" class="form-control">
								<label>Mobile Number</label>
									<input type="text" name="" value="{{$member_detl->mobile}}" readonly="readonly" class="form-control">
								<label>First Name</label>
									<input type="text" name="" value="{{$member_detl->rel_f_name}}" readonly="readonly" class="form-control">
							</div>
							<div class="col-md-2.5 form-group">
								<label>Listed With IAP</label>
								  <input type="text" name="" value="{{$member_detl->iap_no}}" readonly="readonly" class="form-control">
								<label>Last Name</label>
									<input type="text" name="" value="{{$member_detl->last_name}}" readonly="readonly" class="form-control">
								<label>Place Of Birth</label>
									<input type="text" name="" value="{{$member_detl->place_of_birth}}" readonly="readonly" class="form-control">
								<label>Alternate Number</label>
									<input type="text" name="" value="{{$member_detl->mobile1}}" readonly="readonly" class="form-control">
								<label>Middle Name</label>
									<input type="text" name="" value="{{$member_detl->rel_m_name}}" readonly="readonly" class="form-control">
							</div>
							<div class="col-md-2.5 form-group">
								<label>IAP Certificate</label>
								  {{--   <input type="text" name="" value="{{$member_detl->iap_certificate}}" readonly="readonly" class="form-control"> --}}
								    @php $iap_certificate = $member_detl->iap_certificate; @endphp
                   @if($iap_certificate == NULL)
                     <a href="#" class="form-control">Not Available </a>
                   @else 
								    <a href="{{asset('storage/'.$iap_certificate)}}"  class="form-control" target="_blank"><i class="fa fa-eye"></i> {{file_name($member_detl->iap_certificate)}}
                    </a>
                   @endif
								<label>Gender</label>
									<input type="text" name="" value="{{($member_detl->gender == NULL) ? NULL : (($member_detl->gender == 'F')  ? "Female" : "Male")}}" readonly="readonly" class="form-control">
								<label>Country Of Birth</label>
									<input type="text" name="" value="{{$member_detl->country_of_birth}}" readonly="readonly" class="form-control" id="country">
								<label>Alternate Email</label>
									<input type="text" name="" value="{{$member_detl->email1}}" readonly="readonly" class="form-control">
								<label>Last Name</label>
									<input type="text" name="" value="{{$member_detl->rel_l_name}}" readonly="readonly" class="form-control">
							</div>
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-12">
						<h5>Contact Address Details</h5>
						<div class="table-responsive">
						<table class="table table-bordered text-center">
							<thead>
								<tr>
									<th colspan="2">Current Address</th>
									<th colspan="2">Permanent Address</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Address</td>
									@if($member_detl_address_p != null)
									<td>{{$member_detl_address_p->addr}}</td>
									@else
									<td></td>
									@endif

									<td>Address</td>
									@if($member_detl_address_c != null)
									<td>{{$member_detl_address_c->addr}}</td>
									@else
									<td></td>
									@endif
								</tr>
								<tr>
									<td>Country</td>
									@if($member_detl_address_p != null)
									<td>{{$member_detl_address_p->country_name}}</td>
									@else
									<td></td>
									@endif

									<td>Country</td>
									@if($member_detl_address_c != null)
									<td>{{$member_detl_address_c->country_name}}</td>
									@else
									<td></td>
									@endif
								</tr>
								<tr>
									<td>State</td>
									@if($member_detl_address_p != null)
									<td>{{$member_detl_address_p->state_name}}</td>
									@else
									<td></td>
									@endif

									<td>State</td>
									@if($member_detl_address_c != null)
									<td>{{$member_detl_address_c->state_name}}</td>
									@else
									<td></td>
									@endif
								</tr>

								<tr>
									<td>City</td>
									@if($member_detl_address_p != null)
									<td>{{$member_detl_address_p->city_name}}</td>
									@else
									<td></td>
									@endif

									<td>City</td>
									
									@if($member_detl_address_c != null)
									<td>{{$member_detl_address_c->city_name}}</td>
									@else
									<td></td>
									@endif
								</tr>

								<tr>
									<td>Zip</td>
									@if($member_detl_address_p != null)
									<td>{{$member_detl_address_p->zip}}</td>
									@else
									<td></td>
									@endif
									
									<td>Zip</td>
									@if($member_detl_address_c != null)
									<td>{{$member_detl_address_c->zip}}</td>
									@else
									<td></td>
									@endif
								</tr>
							</tbody>
						</table>
					</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-12">
						<h5>Qualification Details <i class="fa fa-plus" id="qual"></i><i class="fa fa-minus" id="qual1" style="display:none;"></i></h5>
						<div class="table-responsive">
						<div id="tablequal">
							
						</div>
					</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-12">
						<h5>Other Document Details <i class="fa fa-plus" id="docs"></i><i class="fa fa-minus" id="docs1" style="display:none;"></i></h5>
						<div class="table-responsive">
						<div id="tabledocs">
							
						</div>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$( document ).ready(function() {
//------Qualification Details-----------//
    $('#qual').click(function(){
     $("#qual").hide();
     $("#qual1").show();
     $.ajax({
		type:"GET",
		url:"{{url('membqual')}}",
		success:function(res){
			$('#tablequal').append(res);
			}
	});
  });
    $('#qual1').click(function(){
     $("#qual1").hide();
     $("#qual").show();
     $('#tablequal').empty();
  });

//------Document Details-----------//

   $('#docs').click(function(){
     $("#docs").hide();
     $("#docs1").show();
     $.ajax({
		type:"GET",
		url:"{{url('membdocs')}}",
		success:function(res){
			console.log(res);
			 $('#tabledocs').append(res);
			}
	});
  });
    $('#docs1').click(function(){
     $("#docs1").hide();
     $("#docs").show();
     $('#tabledocs').empty();
  });

//--------- Country name ---------//
    let country_code = $('#country').val();
		jQuery.ajax({
			url:'/country_code_name',
			type:'post',
			data:'country_code='+country_code+'&_token={{csrf_token()}}',
			success:function(result){
				 $("#country").val(result);
				// if(result){
    //       $("#country").empty();
    //       $.each(result,function(key,value){
    //           $("#country").append('<option value="'+key+'">'+value+'</option>');
    //       });
       
    //     }else{
    //       $("#country").empty();
    //     }
			}
		})

});
</script>