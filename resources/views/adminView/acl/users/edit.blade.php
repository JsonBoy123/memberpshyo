@extends('dashboard.layouts.master')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Users</h1>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Edit User <a href="{{url('/acl/user')}}" class="btn btn-sm btn-primary pull-right">Back</a></h4>
			</div>
			<div class="card-body">
				<div class="col-md-10 m-auto">
					{{ Form::open(array('url' => '/acl/user/'.$user->id,'method' => 'post')) }}
					@method('patch')
					<div class="from-group row mb-4">
						{{ Form::label('name', 'Name:',['class'=>'col-md-4 text-right'])}}
						<div class="col-md-8 ">
							{{ Form::text('name',old('name') ?? $user->name,['class' => 'form-control name'])}}
							@error('name')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
					</div>
					<div class="from-group row mb-4">
						{{ Form::label('email', 'Email Address:',['class'=>'control-label col-md-4 text-right'])}}
						<div class="col-md-8 ">
							{{ Form::text('email',old('email') ?? $user->email,['class' => 'form-control email'])}}
							@error('email')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
					</div>
					<div class="from-group row mb-4">
						{{ Form::label('phone', 'Mobile Number:',['class'=>'control-label col-md-4 text-right'])}}
						<div class="col-md-8">
							{{ Form::text('phone',old('phone') ?? $user->phone,['class' => 'form-control phone', 'oninput' =>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"])}}

							@error('phone')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<div class="col-md-12 text-right">
                   {{Form::submit('Update',['class' => 'btn btn-sm btn-success'])}}                   
				</div>
				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>
@endsection
