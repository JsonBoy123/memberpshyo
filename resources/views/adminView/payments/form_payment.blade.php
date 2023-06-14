@extends('dashboard.layouts.master')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Services</h1>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Service Form RECIEPT</h5>
					
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-8 m-auto">
						<div class="card">
							<div class="card-header">
								<h6 class="card-title font-weight-bold" >
									<img src="{{asset('images/physio.png')}}" style="width: 100px; height: 30px">IAP SERVICE FORM PAYMENT RECIEPT
								</h6>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-md-4 text-right">
										<p class="">Member Full Name :</p>
									</div>
									<div class="col-md-8">
										<p>{{($userservice->first_name)}} {{($userservice->middle_name)}} {{($userservice->last_name)}}</p>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 text-right">
										<p class="">Member Mobile Number:</p>
									</div>
									<div class="col-md-8">
										<p>{{$userservice->mobile }}</p>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 text-right">
										<p class="">Service Name:</p>
									</div>
									<div class="col-md-8">
										<p>{{($service->id)}}</p>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 text-right">
										<p class="">Service Charges:</p>
									</div>
									<div class="col-md-8">
										<p><i class="fa fa-rupee"></i> {{$service->charges }}</p>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 text-right">
										<p class="">Date:</p>
									</div>
									<div class="col-md-8">
										<p>{{date('d-m-Y')}}</p>
									</div>
								</div>
							</div>
							<div class="card-footer">
								<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#paymentModal">
								Pay
								</button>

								{{-- <a href="{{url('service/payment_now/'.$member->user_id)}}" class="btn btn-sm btn-primary">Pay Now </a> --}}
							</div>
						</div>
						{{-- <h5>{{$service->name}}</h5> --}}
					</div>
					
				</div>
			</div>
		</div>
	</div>
	<div class="modal modal-fade " id="paymentModal">
		<div class="modal-dialog ">
			<div class="modal-content">
				<div class="modal-header">
				 <h4 class="modal-title">Service Payment</h4>
					 <button type="button" class="close" data-dismiss="modal">&times;</button>
				  
				</div>
				<div class="modal-body">
					{{Form::open(array('url' => '/service/payment_now','method' => 'POST'))}}
					<div class="row">
						<div class="col-md-12">
							{{Form::label('payment_id','Payment Transaction ID (Fill Correct)',['class' => 'required'])}}
							{{Form::text('payment_id','',['class' => 'form-control ','required' => 'required'])}}
					
						</div>
					</div>
				
				</div>
				<div class="modal-footer">		
					{{Form::hidden('service_id',$userservice->id)}}
					{{Form::submit('Submit',['class' => 'btn btn-sm btn-success'])}}   
					{{Form::close()}}
				</div>
			</div>
		</div>              
	</div>
</div>
@endsection