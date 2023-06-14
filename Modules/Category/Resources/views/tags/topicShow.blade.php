 <div class="card">
	<div class="card-header">
		<h5 class="card-title">Add New Topic
			<a href="{{url('/category')}}" class="btn btn-sm btn-primary pull-right ml-2">Back</a>
			@include('category::partials.buttonDropdown')

		</h5>
	</div>
	{{Form::open(array('url'=>'/topics_store','method'=>'post'))}}
	<div class="card-body">
			<div class="from-group row mb-4">
				{{ Form::label('name', 'Topic Name:',['class'=>'col-md-4 text-right'])}}
				<div class="col-md-8 ">
					{{ Form::text('name',old('name'),['class' => 'form-control name'])}}
					@error('name')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
				</div>
			</div>

			<a href="javascript:void(0)" class="text-arimary advance"><i class="fa fa-arrow-up arrow"></i> <b>Advanced Options</b></a>
			<hr>
			<div class="advanced_form">
				<div class="from-group row mb-4">
					{{ Form::label('url', 'Topic url:',['class'=>'col-md-4 text-right'])}}
					<div class="col-md-8 ">
						{{ Form::text('url',old('url'),['class' => 'form-control url'])}}
						@error('url')
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
           {{Form::submit('Submit',['class' => 'btn btn-sm btn-success'])}}                   
		</div>
	</div>
	{{Form::close()}}
</div>