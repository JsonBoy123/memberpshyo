@extends('dashboard.layouts.master')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Services</h1>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			{{Form::open(array('url' => 'services/iap_membership_tenth_doc','method' => 'POST','enctype' => 'multipart/form-data'))}}
			<div class="card-header">
				
				<h5>Document to be Attach by Applicant</h5>
			</div>
			
			{{-- @csrf --}}
			@if($message = Session::get('success'))
				    <div class="alert alert-success">
				        {{$message}}
				    </div>
			@endif
			
			<div class="card-body">
                 <div class="row">
				<div  class="col-md-12 form-group mt-3">
							<p class="text-muted">
								
							</p>
				</div>
                 <div class="col-md-6">
				<b>{{Form::label('ten_doc','10th Marksheet',['class' => 'required'])}} </b>

				{{Form::file('ten_doc',['class' => 'form-control','accept'=>"image/*"])}}
						@error('ten_doc')
	                        <span class="text-danger" role="alert">
	                            <strong>{{ $message }}</strong>
	                        </span>
	                    @enderror
	            </div>  
	            <div class="col-md-6">
	               	@if($member->ten_doc !='')
	               	<a href="{{asset('storage/'.$member->ten_doc)}}"  ><i class="fa fa-eye"></i> {{file_name($member->ten_doc)}}
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
										