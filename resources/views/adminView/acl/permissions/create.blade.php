@extends('dashboard.layouts.master')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Permission</h1>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Add Permission <a href="{{url('/acl/permission')}}" class="btn btn-sm btn-primary pull-right">Back</a></h4>
			</div>
			{{Form::open(array('url' => '/acl/permission', 'method' => 'post'))}}
			<div class="card-body">
				<div class="col-md-10 m-auto">
					<div class="from-group row mb-4">
						{{ Form::label('name', 'Name:',['class'=>'col-md-4 text-right'])}}
						<div class="col-md-8 ">
							{{ Form::text('name',old('name'),['class' => 'form-control name'])}}
							@error('name')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
					</div>
					<div class="from-group row mb-4">
						{{ Form::label('display_name', 'Display Name:',['class'=>'col-md-4 text-right'])}}
						<div class="col-md-8 ">
							{{ Form::text('display_name',old('display_name'),['class' => 'form-control display_name'])}}
							@error('display_name')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
					</div>
					<div class="from-group row mb-4">
						{{ Form::label('description', 'Description:',['class'=>'col-md-4 text-right'])}}
						<div class="col-md-8 ">
							{{ Form::textarea('description',old('description'),['class' => 'form-control description', 'rows' => '4' , 'cols' => 4])}}
							@error('description')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
					</div>
					
				{{Form::close()}}
				</div>
				<div class="card-footer">
					<div class="col-md-12 text-right">								
	                   {{Form::submit('Submit',['class' => 'btn btn-sm btn-success'])}}
					</div>
				</div>
				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
	    $('.role').select2();
	});
</script>
@endsection