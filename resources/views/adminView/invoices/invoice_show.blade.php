@extends('dashboard.layouts.master')
@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Invoice</h1>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				@if($message = Session::get('success'))
				    <div class="alert alert-success">
				        {{$message}}
				    </div>
				@endif
				<div class="row">
					<div class="col-md-4 border-right">
						<div class="row">
							<div class="col-md-12 mb-3">
								<h5>Invoice</h5>
								
									<img src="{{asset('images/physio.png')}}"  alt="Logo" style="height: 80%; width: 100%">

								
							</div>
							<hr>
							<div class="col-md-12 mb-3">
								<span>GST No : 1234567890</span>
								
							
							
						</div>

					</div>
				</div>
					<div class="col-md-4 border-right">
						<div class="row">
							<div class="col-md-12">
								
                            <span> {{$iap->iap_name}}</span><br>
                            <p>{!! $iap->addr !!}{{$iap->city_name .','.$iap->country_name.','.$iap->zip_code}}</p>
                           
							</div>
						</div>
						
						
						{{-- <div class="row">
							<div class="col-md-12">
								
								<h5></h5>
								
							</div>
						</div> --}}
						
						
						
						
						
					</div>
					<div class="col-md-4">

						
						<div class="row">
							<div class="col-md-12">
								
                            <span> Invoice Number : {{$invoice->invc_numb}}</span><br>
                            <span> Invoice Date  : {{$invoice->invc_date}}</span><hr>
                            <b>{{$invoice->name}}</b>
                            <p class="mb-0">{{$invoice->member->p_address}}</p>
                            <p class="mb-0">{{$invoice->member->cities->city_name.'-'.$invoice->member->p_zip_code}}</p>
                            <p>{{$invoice->member->states->state_name}}</p>
                           
							</div>
						</div>

					</div> 
					<hr>

				</div>
				<div class="row">
					<div class="col-md-6 form-group">
						
					</div>
					<div class="col-md-6 form-group">
						<br>
						
					</div>					
				</div>
				<div class="row">
					<div class="col-md-12">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Sr. no</th>		
									<th>Service Name</th>		
									<th>Charges</th>		
									<th>CGST</th>		
									<th>IGST</th>		
									<th>Total</th>		
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>{{1}}</td>
									<td>{{$invoice->service_name}}</td>
									<td>&#x20b9; {{$invoice->charges}}</td>
									<td>&#x20b9; {{$invoice->cgst}}</td>
									<td>&#x20b9; {{$invoice->sgst}}</td>
                                    
									<td>&#x20b9; {{$total = $invoice->charges+ $invoice->cgst + $invoice->sgst}}</td>
								</tr>
								<tr>
									<td></td>
									<td colspan="5"><b> Total Invoice Amount : </b>{{getIndianCurrency($total)}}</td>
								</tr>
								<tr>
									<td colspan="6">
										<li>This is electronically generated invoice online </li>
										<li>Services can be declined if IAP member violates any terms and no refund will be provided. </li>
										<li>Service can be declined incase IAP member miss uses the services of IAP or defame IAP. </li>
										<li>Invoice will be marked paid only if amount credited in the account of IAP </li>
										<li>All payments are non-refundable or transferable </li>
										<li>For any query related with invoice contact iaptreasurer@gmail.com </li>
									</td>
								</tr>
								
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>









@endsection