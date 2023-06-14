@extends('dashboard.layouts.master')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Category</h1>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Add Category <a href="{{url('/category')}}" class="btn btn-sm btn-primary pull-right">Back</a></h4>
				
			</div>
			<div class="card-body">
				@if($message = Session::get('success'))
				    <div class="alert alert-success">
				        {{$message}}
				    </div>
				@endif
				<div class="col-md-10 m-auto">
					{{ Form::open(array('url' => 'category','method' => 'post','enctype' => 'multipart/form-data')) }}
					{{-- {{ Form::token() }} --}}
					<div class="from-group row mb-4">
						{{ Form::label('category_name', 'Category Name:',['class'=>'col-md-4 text-right'])}}
						<div class="col-md-8 ">
							{{ Form::text('category_name',old('category_name'),['class' => 'form-control category_name'])}}
							@error('category_name')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
					</div>
					<div class="from-group row mb-4">
						{{ Form::label('sefriendly', 'SE friendly URL:',['class'=>'control-label col-md-4 text-right'])}}
						<div class="col-md-8 ">
							{{ Form::text('sefriendly',old('sefriendly'),['class' => 'form-control sefriendly'])}}
							@error('sefriendly')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
					</div>
					<div class="from-group row mb-4">
						{{ Form::label('name', 'Parent Category:',['class'=>'control-label col-md-4 text-right'])}}
						<div class="col-md-8 ">
							<select class="form-control" name="parent_cat">
								<option value="">{{__('Root')}}</option>
								@foreach($parentCategories as $category)
								<option class="root" value="{{$category->id}}" {{old('parent_cat') == $category->id ? 'selected' : ''}} >{{$category->category_name}}</option>
									@if(count($category->subcategory))
										@include('category::category.subCategoryList',['subcategories' => $category->subcategory, 'dataSpace' => 2])
									@endif
								@endforeach

							</select>
							@error('parent_cat')
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
							{{ Form::label('article_num', 'Number of articles:',['class'=>'control-label col-md-4 text-right'])}}
							<div class="col-md-8 ">
								{{ Form::text('article_num',old('article_num'),['class' => 'form-control'])}}
								@error('article_num')
	                                <span class="text-danger" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                </span>
	                            @enderror	
							</div>
						</div>	
						{{-- <div class="from-group row mb-4">
							{{ Form::label('template', 'Custom layout (overrides default):',['class'=>'control-label col-md-4 text-right'])}}
							<div class="col-md-8 ">
								{{  Form::select('template',$parentCategories->pluck('category_name','id'), '',['class'=>'form-control'])}}	
							</div>
						</div>	
						<div class="from-group row mb-4">
							{{ Form::label('article_template', 'Article custom layout (overrides default):',['class'=>'control-label col-md-4 text-right'])}}
							<div class="col-md-8 ">

								{{  Form::select('article_template',$parentCategories->pluck('category_name','id'), '',['class'=>'form-control'])}}	
							</div>
						</div>		
						<div class="from-group row mb-4">
							{{ Form::label('css', 'Custom theme (overrides default):',['class'=>'control-label col-md-4 text-right'])}}
							<div class="col-md-8 ">
								{{  Form::select('css',$parentCategories->pluck('category_name','id'), '',['class'=>'form-control'])}}	
							</div>
						</div>		 --}}
						<div class="from-group row mb-4">
							{{ Form::label('css', 'Show in navigation:',['class'=>'control-label col-md-4 text-right'])}}
							<div class="col-md-8 ">								
			                    {{ Form::radio('view_subcat', '1', old('view_subcat') == '1' ? true : true, ['id' => 'radio1']) }} 
			                    {{ Form::label('radio1', 'Yes') }} 
			                    {{ Form::radio('view_subcat', '0', old('view_subcat') == '0' ? true : false, ['id' => 'radio2','class'=>'ml-4']) }} 
			                    {{ Form::label('radio2', 'No') }}
			                    @error('view_subcat')
	                                <span class="text-danger" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                </span>
	                            @enderror
							</div>
						</div>

						<div class="from-group row mb-4">
							{{ Form::label('cat_cust_title', 'Custom Title:',['class'=>'control-label col-md-4 text-right'])}}
							<div class="col-md-8 ">								
			                   {{ Form::text('cat_cust_title',old('cat_cust_title'),['class' => 'form-control'])}}
			                    @error('cat_cust_title')
	                                <span class="text-danger" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                </span>
	                            @enderror
							</div>
						</div>
						<div class="from-group row mb-4">
							{{ Form::label('cat_cust_keywords', 'Meta Keywords:',['class'=>'control-label col-md-4 text-right'])}}
							<div class="col-md-8 ">								
			                   {{ Form::text('cat_cust_keywords',old('cat_cust_keywords'),['class' => 'form-control'])}}
			                    @error('cat_cust_keywords')
	                                <span class="text-danger" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                </span>
	                            @enderror
							</div>
						</div>
						<div class="from-group row mb-4">
							{{ Form::label('cat_cust_desc', 'Meta Description:',['class'=>'control-label col-md-4 text-right'])}}
							<div class="col-md-8 ">								
			                   {{ Form::text('cat_cust_desc',old('cat_cust_desc'),['class' => 'form-control'])}}
			                    @error('cat_cust_desc')
	                                <span class="text-danger" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                </span>
	                            @enderror
							</div>
						</div>
						<div class="from-group row mb-4">
							{{ Form::label('image', 'Abstract image:',['class'=>'control-label col-md-4 text-right'])}}
							<div class="col-md-8 ">			
			                   {{ Form::file('image',['class' => 'form-control','style' => 'padding:0px !important'])}}
			                    @error('image')
	                                <span class="text-danger" role="alert">
	                                    <strong>{{ $message }}</strong>
	                                </span>
	                            @enderror
							</div>
						</div>	
					</div>
										
					
				</div>				
			</div>
			<div class="card-footer">
				<div class="col-md-12 text-right">								
                   {{Form::submit('Submit',['class' => 'btn btn-sm btn-success'])}}
                   
				</div>
				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>
<script >
	$(document).ready(function(){
		$('.advance').on('click',function(){
			$('.arrow').toggleClass("fa-arrow-up fa-arrow-down");
			$('.advanced_form').toggle();
		});

		$('.category_name').blur(function(e){
			var Text = $(this).val();
			Text = Text.toLowerCase();
			Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
			$(".sefriendly").val(Text); 
		});
	});
	
</script>
@endsection