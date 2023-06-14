@extends('dashboard.layouts.master')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Services</h1>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			{{Form::open(array('url' => 'services/iap_membership_govprf2_doc','method' => 'POST','enctype' => 'multipart/form-data'))}}
			<div class="card-header">
				
				<h5>Document to be Attach by Applicant</h5>
			</div>
			@if($message = Session::get('success'))
				    <div class="alert alert-success">
				        {{$message}}
				    </div>
			@endif
			
			{{-- @csrf --}}
			<div class="card-body">
                <div class="row"> 
				<div  class="col-md-12 form-group mt-3">
							<p class="text-muted">
								
							</p>
				</div>
                <div class="col-md-6">
				<b>{{Form::label('gov_proof1','Any Goverment Proof (other than previous one)',['class' => 'required'])}} </b>
				{{Form::file('gov_proof1',['class' => 'form-control','accept'=>"image/*"])}}
						@error('gov_proof1')
	                        <span class="text-danger" role="alert">
	                            <strong>{{ $message }}</strong>
	                        </span>
	                    @enderror
	                </div>
	                <div class="col-md-6">
	                	@if($member->gov_proof1 !='')
	               	<a href="{{asset('storage/'.$member->gov_proof1)}}"  ><i class="fa fa-eye"></i> {{file_name($member->gov_proof1)}}
					</a>
	               	@endif
	                </div>
	            </div>  
	        </div>
	            
	        <div class="card-footer">
					
					{{Form::submit('Save ',['class' => 'btn btn-sm btn-secondary'])}}		
			</div>
			{{Form::close()}}
		</div>
	</div>
</div>
@endsection
										