@extends('dashboard.layouts.master')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Link</h1>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Add Link <a href="{{url('/category')}}" class="btn btn-sm btn-primary pull-right">Back</a></h4>
				
			</div>
			{{Form::open(array('url' => '/link/store' , 'method' => 'post'))}}
			<div class="card-body">
				<div class="col-md-10 m-auto">
					<div class="from-group row mb-4">
						{{ Form::label('category_name', 'Link Name:',['class'=>'control-label col-md-4 text-right'])}}
						<div class="col-md-8 ">
							{{Form::text('category_name',old('category_name'),['class' => 'form-control'])}}	
						@error('category_name')
					        <span class="text-danger" role="alert">
					            <strong>{{ $message }}</strong>
					        </span>
					    @enderror
						</div>
					</div>	
					<div class="from-group row mb-4">
						{{ Form::label('redirect', 'Link Url:',['class'=>'control-label col-md-4 text-right'])}}
						<div class="col-md-8 ">
							{{Form::text('redirect',old('redirect'),['class' => 'form-control'])}}	
						@error('redirect')
					        <span class="text-danger" role="alert">
					            <strong>{{ $message }}</strong>
					        </span>
					    @enderror
						</div>
					</div>	
				</div>
			</div>
			<div class="card-footer">
				{{Form::submit('Submit',['class' => 'btn btn-sm btn-success pull-right'])}}
			</div>
			{{Form::close()}}
		</div>
	</div>
</div>
@endsection