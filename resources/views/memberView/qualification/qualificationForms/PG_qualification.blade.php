@extends('dashboard.layouts.membermaster')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Qualification</h1>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Add Master Qualification {{-- <a href="{{url('/qualification')}}" class="btn btn-sm btn-info pull-right">Back</a> --}}</h5>
			</div>
			<form action="{{url('/PG_qualification_create')}}" method="post" enctype="multipart/form-data">
			@csrf	
			<div class="card-body">
				<div class="col-md-10 m-auto">				
				{{-- @method('patch') --}}			
					<div class="from-group row mb-4">

						<label class="control-label col-md-4 text-right">Qualification Name:</label>
						<div class="col-md-8">
							<input type="text" name="qual_catg_desc" value="Master" class="form-control" readonly>
							<input type="hidden" name="qual_catg_code" value="5" class="form-control">
							@error('qual_catg_code')
		                        <span class="text-danger" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </span>
		                    @enderror
						</div>
					</div>	

					<div class="from-group row mb-4">						
					<label class="col-md-4 text-right">College/Institute:</label>
						<div class="col-md-8 ">						
						<input type="text" name="location" class="form-control location">
						@error('location')
	                        <span class="text-danger" role="alert">
	                            <strong>{{ $message }}</strong>
	                        </span>
	                    @enderror
						</div>
					</div>

					<div class="from-group row mb-4">					
					<label class="col-md-4 text-right">Board/University/Other:</label>
						<div class="col-md-8 ">						
						<input type="text" name="board" class="form-control board">
						@error('board')
	                        <span class="text-danger" role="alert">
	                            <strong>{{ $message }}</strong>
	                        </span>
	                    @enderror
						</div>
					</div>

					<div class="from-group row mb-4">					
					<label class="col-md-4 text-right">	Passing Marks (In %):</label>
						<div class="col-md-8 ">

						<input type="number" name="pass_marks" class="form-control pass_marks" min="0" max="100" step="0.01"> 		
						@error('pass_marks')
	                        <span class="text-danger" role="alert">
	                            <strong>{{ $message }}</strong>
	                        </span>
	                    @enderror
						</div>
					</div>

					<div class="from-group row mb-4">					
					<label class="col-md-4 text-right">pass_year</label>
						<div class="col-md-8 ">
						<input type="text" name="pass_year" class="form-control pass_year"> 
						{{-- {{ Form::text('pass_year',old('pass_year') ?? $qualification->pass_year,['class' => 'form-control pass_year','oninput' =>"this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"])}} --}}
						@error('pass_year')
	                        <span class="text-danger" role="alert">
	                            <strong>{{ $message }}</strong>
	                        </span>
	                    @enderror
						</div>
					</div>

					<div class="from-group row mb-4">
						<label class="control-label col-md-4 text-right">Passing Division:</label>
						<div class="col-md-8 ">							
							<select name="pass_division" class="form-control pass_division">
							    <option value="1">1st</option>
							    <option value="2">2nd</option>
							    <option value="3">3rd</option>
							    <option value="4">4th</option>
							</select>
							
						@error('pass_division')
	                        <span class="text-danger" role="alert">
	                            <strong>{{ $message }}</strong>
	                        </span>
	                    @enderror
						</div>
					</div>

					<div class="from-group row mb-4">
						<label class="control-label col-md-4 text-right">Qualification Document:</label>
						
						<div class="col-md-5">
							<input type="file" name="qual_doc" class="form-control qual_doc">
							
							@error('qual_doc')
		                        <span class="text-danger" role="alert">
		                            <strong>{{ $message }}</strong>
		                        </span>
	                    	@enderror
						</div>
						{{-- <div class="col-md-3 ">			
							<a href="/storage/{{$qualification->doc_url}}" class="form-control" download="{{$qualification->qual_catg_desc}}"><i class="fa fa-download"></i> Old Document</a>						
						</div> --}}
					</div>
				</div>
			</div>
			<div class="card-footer">
				<button type="submit" name="submit" value="submit" class="btn btn-primary btn-sm">Submit</button>
			</div>
			{{-- {{Form::close()}} --}}	
			</form>	
		</div>
	</div>
</div>
<script>
	@if($message = Session::get('warning'))
    	alert('{{$message}}');
	@endif
</script>
@endsection