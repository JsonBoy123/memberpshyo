@extends('dashboard.layouts.master')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Members</h1>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-md-4">
						<h4 class="card-title">Members List</h4>
					</div>
					<div class="col-md-3 form-group">
						<select name="status" class="form-control" id='status'>
							<option value="0">-- All --</option>
							<option value="1">New Members</option>
							<option value="2">Old Members</option>
						</select>
					</div>
					<div class="col-md-4 form-group">
						<select name="member_status" class="form-control" id='member_status'>
							<option value="0">-- All --</option>
							<option value="1" selected="selected">Active Service Members</option>
							<option value="2">Pending Service Members</option>
							{{-- <option value="2">Service Applied Members</option> --}}
						</select>
					</div>
					<div class="col-md-1 form-group pt-2">
						<button class="btn btn-sm btn-primary" id="filter">Filter</button>
					</div>
				</div>
			</div>
			<div class="card-body" mem>			
				@if($message = Session::get('success'))
					<div class="alert alert-success">
						{{$message}}
					</div>
				@endif
				<div class="row">
					<div class="col-md-12 table-responsive" id="memberTable">
						@include('adminView.member.table')
					</div>
				</div>
			
			</div>
		</div>
	</div>

	<div class="modal modal-fade " id="modalService">
	  <div class="modal-dialog ">
	    <div class="modal-content">
	      <div class="modal-header">
	         <h4 class="modal-title">Active Member Services</h4>
	       	 <button type="button" class="close" data-dismiss="modal">&times;</button>
	          
	        </div>
	      <div class="modal-body" >
	        	<table class="table table-striped table-bordered ">
	        		<thead>
	        			<tr>
	        				<td>#</td>
	        				<td>Name</td>
	        				<td>Charges</td>
	        			</tr>
	        		</thead>
	        		<tbody>
	        			<form action="{{url('member_service_assign')}}" method="post">
	        			@csrf
	        			@foreach($services as $service)
	        			<tr>
	        				<td>
	        					<input type="radio" name="service" value="{{$service->id}}" required="required">
	        				</td>
	        				<td>
	        					{{$service->name}}
	        				</td>
	        				<td>
	        					{{$service->charges}}
	        				</td>
	        			</tr>
	        			@endforeach
	        		</tbody>
	        	</table>
	        	<div class="row">
	        		<div class="col-md-12 form-group">
	        			<label>Payment Transaction ID</label>
	        			<input type="text" name="payment_id" class="form-control" placeholder="Enter Payment Transaction ID">
	        		</div>
	        		{{-- <div class="col-md-12 form-group">
	        			<label>Old IAP Number</label>
	        			<input type="text" name="iap_no" class="form-control" placeholder="Enter Old IAP Number" required="required">
	        		</div> --}}
	        	</div>
	      </div>
	      <div class="modal-footer">
	      	<input type="hidden" name="user_id" value="" id="user_id">        
	        <button class="btn btn-success btn-sm">Submit</button>
	    	</form>
	      </div>
	    </div>
	  </div>              
	</div>


	<div class="modal modal-fade " id="memberModalServices">
	  <div class="modal-dialog ">
	    <div class="modal-content">
	      <div class="modal-header">
	         <h4 class="modal-title">Member Services</h4>
	       	 <button type="button" class="close" data-dismiss="modal">&times;</button>
	          
	        </div>
	      	<div class="modal-body" id="service_table">
	        	
	      	</div>
	    </div>
	  </div>              
	</div>
</div>
<script >
	$(document).ready(function () {

    	// $('.modalService').on('click',function(e){
    	// 	e.preventDefault();
    	// 	$('#user_id').val($(this).attr('id'));
    	// 	$('#modalService').modal('show');

    	// });
    	$(document).on('click','.memberServices',function(e){
    		e.preventDefault();
    		var user_id = $(this).attr('id');
    		// console.log(user_id);
    		$.ajax({
    			type:'GET',
    			url:"{{url('/member/services/')}}/"+user_id,
    			success:function(res){
    				$('#service_table').empty().html(res);
    				 console.log(res)
    				$('#memberModalServices').modal('show');
    			}
    		});
    	});


    	$(document).on('click','#filter',function(){
    	
    		var member_status = $('select[name="member_status"] option:selected').val();    	
    		var status = $('select[name="status"] option:selected').val();    	
    		console.log(status);
    		console.log(member_status);
    		
    		$.ajax({
    			type:'POST',
    			url:"{{url('/members_list_fetch')}}",
    			data:{member_status:member_status,status:status},
    			success:function(res){
    				$('#memberTable').empty().html(res);
    				
    			}
    		});
    	});
    
	});
</script>
@endsection
