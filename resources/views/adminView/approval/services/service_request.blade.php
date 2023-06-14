@extends('dashboard.layouts.master')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Service Requests</h1>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Service Requests</h4>
			</div>
			<div class="card-body">				
				<div class="row">
					<div class="col-md-12 form-group">
						<h6 class="font-weight-bold">Filter</h6>
					</div>
					<div class="col-md-4 form-group">
						<label>Select Member Type</label>
						<select name="status" class="form-control" id='status'>
							<option value="all">-- All --</option>
							<option value="0">New Members</option>
							<option value="1">Old Members</option>
						</select>
					</div>
					<div class="col-md-4 form-group">
						<label>Select Service Status</label>
						<select class="form-control" name="service_status" id='service_status'>
							<option value="all">-- All --</option>
							<option value="A">Approved</option>
							<option value="P">Pending</option>
							<option value="S">Declined</option>
						</select>
					</div>
					<div class="col-md-3 form-group">
						<label>Select Service Payment Pay</label>
						<select class="form-control" name="payment_status" id='payment_status'>
							<option value="all">-- All --</option>
							<option value="0">Pay</option>
							<option value="1">Pay Not</option>
						</select>
					</div>
					<div class="col-md-1 pt-1">
						<button class="btn btn-sm btn-success mt-4" id="btnFilter">Filter</button>
					</div>
				</div>
				<hr>
				<div class="row">				
					<div class="col-md-12 table-responsive" id="serviceReqTable">
						@include('admin::approval.services.service_req_table')
					</div>
				</div>				
			</div>
		</div>
	</div>	
</div>

<div class="modal modal-fade model-lg " id="assignModalService">
  <div class="modal-dialog ">
    <div class="modal-content">
      	<div class="modal-header">
			<h4 class="modal-title">Verify Payment ID Submited By User & Assign IAP Number</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>        
        </div>
      	 <div class="modal-body" >
      	 	<div class="row">
      	 		<div class="col-md-12 form-group">	
	        		{{Form::label('txn_id','Payment Transaction ID')}}
					{{Form::text('txn_id',old('txn_id'),['class' => 'form-control','readonly' => 'readonly'])}}		
	        	</div>	
      	 	</div>
	        <div class="row">        	
				<div class="col-md-12 form-group">	
					{{Form::label('iap_no','Enter IAP Number')}}
					{{Form::text('iap_no',old('iap_no'),['class' => 'form-control','placeholder' => 'Enter IAP number','required' => 'required'])}}				
				</div>	
			</div>
			<div class="modal-footer">			    
				{{Form::hidden('service_id','',['class' => 'service_id'])}}
				{{Form::submit('submit',['class' => 'btn btn-sm btn-success','id' => 'iapFormSubmit'])}}
			</div>
    	</div>
  	</div>              
</div> 


<script >
	$(document).ready(function () {
		@if($message = Session::get('success'))
			$.notify('{{$message}}', "success");
		@endif

   
    	$(document).on('click','.approveBtn',function(e){
    		// alert('test')
    		e.preventDefault();
    		$('input[name="txn_id"]').val($(this).data('id'));
    		$('input[name="service_id"]').val($(this).attr('id'));
    		$('#assignModalService').modal('show');
    	});

    	$(document).on('click','#iapFormSubmit',function(e){
    		e.preventDefault();
    		var iap_no = $('input[name="iap_no"]').val();
    		var service_id = $('input[name="service_id"]').val();
    		if(iap_no !=''){
    			$.ajax({
	    			type:'POST',
	    			url:"{{url('/approval/payment_approve')}}",
	    			data:{service_id:service_id,iap_no:iap_no},
	    			success:function(res){
	    				$.notify(res, "success");
						setTimeout(window.location.reload(), 10000);
	    			}
    			});	
    		}else{
    			$.notify('Iap number field required.','error');
    		}
    	});

    	$(document).on('click','#btnFilter',function(e){
    		e.preventDefault();

    		var status = $('#status').val();
    		var service_status = $('#service_status').val();
    		var payment_status = $('#payment_status').val();

    		$.ajax({
    			type:'POST',
    			url:'{{url('/approval/service_request_filter')}}',
    			data:{status:status,service_status:service_status,payment_status:payment_status},
    			success:function(res){
    				$('#serviceReqTable').empty().html(res);
    				// console.log(res);
    			}
    		})
    	})

	});
</script>
@endsection