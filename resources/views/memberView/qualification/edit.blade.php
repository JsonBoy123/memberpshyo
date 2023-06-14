@extends('dashboard.layouts.membermaster')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Qualification</h1>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Edit Qualification <a href="{{url('/qualification')}}" class="btn btn-sm btn-info pull-right">Back</a></h5>
			</div>
			{{ Form::open(array('url' => 'qualification/'.$qualification->id,'method' => 'post','enctype' => 'multipart/form-data')) }}	
			<div class="card-body">
				<div class="col-md-10 m-auto">				
				@method('patch')			
					<div class="from-group row mb-4">
						{{ Form::label('qual_catg_code', 'Qualification Name:',['class'=>'control-label col-md-4 text-right'])}}
						<div class="col-md-8 ">
							{{  Form::select('qual_catg_code',$qual_catgs->pluck('qual_catg_desc','qual_catg_code'), old('qual_catg_code') ?? $qualification->qual_catg_code,['class'=>'form-control qual_catg_code'])}}	
						@error('qual_catg_code')
	                        <span class="text-danger" role="alert">
	                            <strong>{{ $message }}</strong>
	                        </span>
	                    @enderror
						</div>
					</div>	

					<div class="from-group row mb-4">
					{{ Form::label('location', 'School/College/Institute:',['class'=>'col-md-4 text-right'])}}
						<div class="col-md-8 ">
						{{ Form::text('location',old('location') ?? $qualification->location,['class' => 'form-control location'])}}
						@error('location')
	                        <span class="text-danger" role="alert">
	                            <strong>{{ $message }}</strong>
	                        </span>
	                    @enderror
						</div>
					</div>

					<div class="from-group row mb-4">
					{{ Form::label('board', 'Board/University/Other:',['class'=>'col-md-4 text-right'])}}
						<div class="col-md-8 ">
						{{ Form::text('board',old('board') ?? $qualification->board,['class' => 'form-control board'])}}
						@error('board')
	                        <span class="text-danger" role="alert">
	                            <strong>{{ $message }}</strong>
	                        </span>
	                    @enderror
						</div>
					</div>

					<div class="from-group row mb-4">
					{{ Form::label('pass_marks', 'Passing Marks (In %):',['class'=>'col-md-4 text-right'])}}
						<div class="col-md-8 ">
						{{ Form::number('pass_marks',old('pass_marks') ?? $qualification->pass_marks,['class' => 'form-control pass_marks','step'=>"0.01",'min'=>"0",'max'=>"100"])}}
						@error('pass_marks')
	                        <span class="text-danger" role="alert">
	                            <strong>{{ $message }}</strong>
	                        </span>
	                    @enderror
						</div>
					</div>

					<div class="from-group row mb-4">
					{{ Form::label('pass_year', 'Passing Year:',['class'=>'col-md-4 text-right'])}}
						<div class="col-md-8 ">
						{{ Form::text('pass_year',old('pass_year') ?? $qualification->pass_year,['class' => 'form-control pass_year','oninput' =>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"])}}
						@error('pass_year')
	                        <span class="text-danger" role="alert">
	                            <strong>{{ $message }}</strong>
	                        </span>
	                    @enderror
						</div>
					</div>

					<div class="from-group row mb-4">
						{{ Form::label('pass_division', 'Passing Division:',['class'=>'control-label col-md-4 text-right'])}}
						<div class="col-md-8 ">
							{{  Form::select('pass_division',array('' => 'Select Passing Division', '1' => '1st' , '2' => '2nd' , '3' => '3rd'), old('pass_division') ?? $qualification->pass_division,['class'=>'form-control pass_division'])}}	
						@error('pass_division')
	                        <span class="text-danger" role="alert">
	                            <strong>{{ $message }}</strong>
	                        </span>
	                    @enderror
						</div>
					</div>	
					<div class="from-group row mb-4">
						{{ Form::label('qual_doc', 'Qualification Document:',['class'=>'control-label col-md-4 text-right'])}}
						<div class="col-md-5">
							{{Form::file('qual_doc',['class' => 'form-control'])}}
							@error('qual_doc')
		                        <span class="text-danger" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </span>
	                    	@enderror
						</div>
						<div class="col-md-3 ">			
							<a href="/storage/{{$qualification->doc_url}}" class="form-control" download="{{$qualification->qual_catg_desc}}"><i class="fa fa-download"></i> Old Document</a>						
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer">
				{{Form::submit('Update',['class' => 'btn btn-sm btn-success pull-right'])}}
			</div>
			{{Form::close()}}	
		</div>
	</div>
</div>
<script>
	@if($message = Session::get('warning'))
    	alert('{{$message}}');
	@endif
</script>
@endsection