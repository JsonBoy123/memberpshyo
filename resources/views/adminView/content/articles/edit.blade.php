@extends('dashboard.layouts.master')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Articles</h1>
</div>
<div class="row">	
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<ul class="nav nav-tabs">
				    <li class="nav-item">
				      <a class="nav-link active" data-toggle="tab" href="#add_article">Edit Article</a>
				    </li>
				    <li class="nav-item">
				      <a class="nav-link" data-toggle="tab" href="#image_gallery">Image Gallery</a>
				    </li>
				    <li class="nav-item">
				      <a class="nav-link" data-toggle="tab" href="#directory">Directory</a>
				    </li>
				    <li class="nav-item">
				      <a class="nav-link" data-toggle="tab" href="#attachemets">Attachements</a>
				    </li>
				    <li class="nav-item">
				      <a class="nav-link" data-toggle="tab" href="#google_settings">Google News Settings</a>
				    </li>
				</ul>
			</div>
			{{Form::open(array('url' => '/article/'.$article->id, 'method' => 'post','enctype' => 'multipart/form-data'))}}
			@method('patch')
			<div class="card-body">	
				@if($message = Session::get('success'))
					<div class="row">
						<div class="col-md-12">
							<h5 class="bg-success text-center">{{$message}}</h5>
						</div>
					</div>
				@endif
				<div class="row">
					<div class="col-md-12 mb-2">
		    			{{ Form::label('title', 'Title:')}}
						{{ Form::text('title',old('title') ?? $article->title,['class' => 'form-control title ','required' => 'true'])}}	
						@error('title')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
		    		</div>
				</div>
				<hr>
				<div class="tab-content">
				    <div id="add_article" class="container tab-pane active">
				    	<div class="row form-group">		    		
				    		<div class="col-md-12 mb-2">
				    			{{Form::label('abstract','Abstact')}}
				    			{{Form::textarea('abstract',old('abstract') ?? $article->abstract,['class' => 'form-control abstract' , 'rows' => '4' , 'cols' => '4' ])}}
				    			@error('abstract')
		                            <span class="text-danger" role="alert">
		                                <strong>{{ $message }}</strong>
		                            </span>
		                        @enderror
				    		</div>
				    		<div class="col-md-6 mb-2">
				    			{{Form::label('abstract_image','Abstact Image')}}
				    			{{Form::file('abstract_image',['class' => 'form-control','accept' => "image/*"])}}
				    			@error('abstract_image')
		                            <span class="text-danger" role="alert">
		                                <strong>{{ $message }}</strong>
		                            </span>
		                        @enderror
				    		</div>
				    		<div class="col-md-6 mb-2">
				    			{{Form::label('image_caption','Image Caption')}}
				    			{{Form::text('image_caption',old('image_caption') ?? $article->image_caption,['class' => 'form-control'])}}
				    			@error('image_caption')
		                            <span class="text-danger" role="alert">
		                                <strong>{{ $message }}</strong>
		                            </span>
		                        @enderror
				    		</div>
				    		<div class="col-md-6 mb-2">
				    			{{Form::label('source','Source')}}
				    			{{Form::text('source',old('source') ?? $article->source,['class' => 'form-control'])}}
				    			@error('source')
		                            <span class="text-danger" role="alert">
		                                <strong>{{ $message }}</strong>
		                            </span>
		                        @enderror
				    		</div>
				    		<div class="col-md-6 mb-2">
				    			{{Form::label('source_url','Source Url')}}
				    			{{Form::text('source_url',old('source_url') ?? $article->source_url,['class' => 'form-control'])}}
				    			@error('source_url')
		                            <span class="text-danger" role="alert">
		                                <strong>{{ $message }}</strong>
		                            </span>
		                        @enderror
				    		</div>
				    		<div class="col-md-6 mb-2">
				    			{{Form::label('swf_file','Swf File')}}
				    			{{Form::file('swf_file',['class' => 'form-control'])}}
				    			@error('swf_file')
		                            <span class="text-danger" role="alert">
		                                <strong>{{ $message }}</strong>
		                            </span>
		                        @enderror
				    		</div>
				    		<div class="col-md-6 mb-2">
				    			{{Form::label('slider_image','Slider Image')}}
				    			{{Form::file('slider_image',['class' => 'form-control','accept' => "image/*"])}}
				    			@error('slider_image')
		                            <span class="text-danger" role="alert">
		                                <strong>{{ $message }}</strong>
		                            </span>
		                        @enderror
				    		</div>
				    		<div class="col-md-6 mb-2">
				    			{{Form::label('video_attachment','Video')}}
				    			{{Form::file('video_attachment',['class' => 'form-control'])}}
				    			@error('video_attachment')
		                            <span class="text-danger" role="alert">
		                                <strong>{{ $message }}</strong>
		                            </span>
		                        @enderror
				    		</div>
				    		<div class="col-md-12 mb-2">
				    			{{Form::label('body','body')}}
				    			{{Form::textarea('body',old('body') ?? $article->body,['class' => 'form-control body' , 'rows' => '4' , 'cols' => '4','id'=>'mytextarea'])}}
				    		</div>
				    		<div class="col-md-12 mb-2">
				    			{{Form::label('tag_id','Tags')}}
				    			{{Form::select('tag_id[]',$tags,$article->tags !=null ? $article->tags->pluck('tag_id') : '',['class' => 'form-control','id' => 'tags','multiple' => 'multiple'])}}
				    		</div>
				    	</div>
				    </div>
				    <div id="image_gallery" class="container tab-pane fade" style="height: 300px;">
				     	<div class="row">
				     		<div class="col-md-8">
				     			<div class="dropzone" id="dropzone">
						    
								</div>  
				     		</div>
				     		<div class="col-md-4">
				     			 
				     		</div>
				     	</div> 
				    </div>
				    <div id="directory" class="container tab-pane fade">
				    
				      	<div class="row">
				      		<div class="col-md-12">
				      			<ul>
							      	<li class="text-muted">Article Title should be used for Business Name</li>
							      	<li class="text-muted">Article Abstract Photo should be used for Company Logo</li>
							      	<li class="text-muted">Content should be posted under Category (or subcategories) of DIRECTORY</li>
							      	<li class="text-muted">For Latitude & Longitude use Google Geocoding service, find Latitude & Longitude for your location/address and then fill in the form below.</li>
							    </ul>
				      		</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-md-8 m-auto">
				      			<div class="row form-group mb-3">
									{{ Form::label('directory_show', 'Show Directory details:',['class'=>'control-label col-md-4 text-right'])}}
									<div class="col-md-8">
										{{ Form::radio('directory_show', '1', old('directory_show') == '1' ? true : ($article->directory_show == '1' ? true : false), ['id' => 'dir_radio1']) }}
										{{ Form::label('dir_radio1', 'Yes') }} 
										{{ Form::radio('directory_show', '0', old('directory_show') == '0' ? true : ($article->directory_show == '0' ? true : false), ['id' => 'dir_radio2','class'=>'ml-4']) }} 
		                    			{{ Form::label('dir_radio2', 'No') }}

										@error('directory_show')
			                                <span class="text-danger" role="alert">
			                                    <strong>{{ $message }}</strong>
			                                </span>
			                            @enderror
									</div>
								</div>
								<div class="from-group row mb-3">
									{{ Form::label('directory_bname', 'Primary Contact Name:',['class'=>'control-label col-md-4 text-right'])}}
									<div class="col-md-8 ">
										{{ Form::text('directory_bname',old('directory_bname') ?? $article->directory_bname,['class' => 'form-control'])}}
										@error('directory_bname')
			                                <span class="text-danger" role="alert">
			                                    <strong>{{ $message }}</strong>
			                                </span>
			                            @enderror	
									</div>
								</div>
								<div class="from-group row mb-3">
									{{ Form::label('directory_cname', 'Secondary Contact Name:',['class'=>'control-label col-md-4 text-right'])}}
									<div class="col-md-8 ">
										{{ Form::text('directory_cname',old('directory_cname') ?? $article->directory_cname,['class' => 'form-control'])}}
										@error('directory_cname')
			                                <span class="text-danger" role="alert">
			                                    <strong>{{ $message }}</strong>
			                                </span>
			                            @enderror	
									</div>
								</div>
								<div class="from-group row mb-3">
									{{ Form::label('directory_email', 'Email:',['class'=>'control-label col-md-4 text-right'])}}
									<div class="col-md-8 ">
										{{ Form::text('directory_email',old('directory_email') ?? $article->directory_email,['class' => 'form-control'])}}
										@error('directory_email')
			                                <span class="text-danger" role="alert">
			                                    <strong>{{ $message }}</strong>
			                                </span>
			                            @enderror	
									</div>
								</div>
								<div class="from-group row mb-3">
									{{ Form::label('directory_address', 'Address:',['class'=>'control-label col-md-4 text-right'])}}
									<div class="col-md-8 ">
										{{ Form::text('directory_address',old('directory_address') ?? $article->directory_address,['class' => 'form-control'])}}
										@error('directory_address')
			                                <span class="text-danger" role="alert">
			                                    <strong>{{ $message }}</strong>
			                                </span>
			                            @enderror	
									</div>
								</div>
								<div class="from-group row mb-3">
									{{ Form::label('directory_country', 'Country:',['class'=>'control-label col-md-4 text-right'])}}
									<div class="col-md-8 ">
										{{Form::select('directory_country',$countries,$article->directory_country,['class' => 'form-control directory_country'])}}
										@error('directory_country')
			                                <span class="text-danger" role="alert">
			                                    <strong>{{ $message }}</strong>
			                                </span>
			                            @enderror	
									</div>
								</div>
								<div class="from-group row mb-3">
									{{ Form::label('directory_state', 'State:',['class'=>'control-label col-md-4 text-right'])}}
									<div class="col-md-8 ">
										{{Form::select('directory_state',array(),'',['class' => 'form-control directory_state','id' => 'directory_state'])}}
										@error('directory_state')
			                                <span class="text-danger" role="alert">
			                                    <strong>{{ $message }}</strong>
			                                </span>
			                            @enderror	
									</div>
								</div>
								<div class="from-group row mb-3">
									{{ Form::label('directory_city', 'City:',['class'=>'control-label col-md-4 text-right'])}}
									<div class="col-md-8 ">
										{{Form::select('directory_city',array(),'',['class' => 'form-control directory_city','id' => 'directory_city'])}}
										@error('directory_city')
			                                <span class="text-danger" role="alert">
			                                    <strong>{{ $message }}</strong>
			                                </span>
			                            @enderror	
									</div>
								</div>
								<div class="from-group row mb-3">
									{{ Form::label('directory_zip', 'Zip Code:',['class'=>'control-label col-md-4 text-right'])}}
									<div class="col-md-8 ">
										{{ Form::text('directory_zip',old('directory_zip') ?? $article->directory_zip,['class' => 'form-control'])}}
										@error('directory_zip')
			                                <span class="text-danger" role="alert">
			                                    <strong>{{ $message }}</strong>
			                                </span>
			                            @enderror	
									</div>
								</div>
								<div class="from-group row mb-3">
									{{ Form::label('directory_tele', 'Telephone:',['class'=>'control-label col-md-4 text-right'])}}
									<div class="col-md-8 ">
										{{ Form::text('directory_tele',old('directory_tele') ?? $article->directory_tele,['class' => 'form-control'])}}
										@error('directory_tele')
			                                <span class="text-danger" role="alert">
			                                    <strong>{{ $message }}</strong>
			                                </span>
			                            @enderror	
									</div>
								</div>
								<div class="from-group row mb-3">
									{{ Form::label('directory_fax', 'Fax:',['class'=>'control-label col-md-4 text-right'])}}
									<div class="col-md-8 ">
										{{ Form::text('directory_fax',old('directory_fax') ?? $article->directory_fax,['class' => 'form-control'])}}
										@error('directory_fax')
			                                <span class="text-danger" role="alert">
			                                    <strong>{{ $message }}</strong>
			                                </span>
			                            @enderror	
									</div>
								</div>
								<div class="from-group row mb-3">
									{{ Form::label('directory_website', 'Website:',['class'=>'control-label col-md-4 text-right'])}}
									<div class="col-md-8 ">
										{{ Form::text('directory_website',old('directory_website') ?? $article->website,['class' => 'form-control'])}}
										@error('directory_website')
			                                <span class="text-danger" role="alert">
			                                    <strong>{{ $message }}</strong>
			                                </span>
			                            @enderror	
									</div>
								</div>

				      		</div>
				      	</div>		
				    </div>
				    <div id="attachemets" class="container tab-pane fade">
				      <p class="text-muted">Click and drag the files to change their order on the page. Double-click the file to edit the properties on the right-hand side.</p>
				      <p class="text-danger text-center font-weight-bold">You must save the article first.</p>
				    </div>
				    <div id="google_settings" class="container tab-pane fade">
				      google_settings
				    </div>
				    
				</div>
				<br>
				<br>
				<br>
				<div class="card">
					<div class="card-header p-1">
						<ul class="nav nav-tabs" >
						    <li class="nav-item">
						      <a class="nav-link active" data-toggle="tab" href="#options_tab" id="options">Options</a>
						    </li>
						    <li class="nav-item">
						      <a class="nav-link" data-toggle="tab" href="#se_friendly_tab" id="se_friendly">SE Friendly</a>
						    </li>
						    <li class="nav-item">
						      <a class="nav-link" data-toggle="tab" href="#revisions_tab" id="revisions">Revisions</a>
						    </li>
						</ul>
					</div>

					<div class="card-body">	
						<div class="row" id="options-content">
							<div class="col-md-6">						
								<div class="from-group row mb-4">
									{{ Form::label('status', 'Set Status:',['class'=>'control-label col-md-4 text-right'])}}
									<div class="col-md-8 ">
										{{  Form::select('status',array('0' => 'Active', '1' => 'Pending', '2' =>'Archived'), old('status') ?? $article->status,['class'=>'form-control status'])}}
									</div>
								</div>
								<div class="from-group row mb-4">
									{{ Form::label('parent_cat', 'Parent Category:',['class'=>'control-label col-md-4 text-right'])}}
									<div class="col-md-8 ">
										<select class="form-control" name="parent_cat">
											@foreach($parentCategories as $category)
											<option class="root" value="{{$category->id}}" {{old('parent_cat') == $category->id ? 'selected' : ($article->category_id == $category->id ? 'selected' : '')}} >{{$category->category_name}}</option>
												@if(count($category->subcategory))
													@include('category::category.editsubCategoryList',['subcategories' => $category->subcategory, 'dataSpace' => 2])
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
									<div class="from-group row mb-3">
										{{ Form::label('publish_date', 'Publish Date:',['class'=>'control-label col-md-4 text-right'])}}
										<div class="col-md-8 ">
											{{ Form::text('publish_date',old('publish_date') ?? date('Y-m-d',strtotime($article->created)),['class' => 'form-control datepicker'])}}
											@error('publish_date')
				                                <span class="text-danger" role="alert">
				                                    <strong>{{ $message }}</strong>
				                                </span>
				                            @enderror	
										</div>
									</div>
									<div class="row form-group mb-3">
										{{ Form::label('show_comment', 'Show Comment:',['class'=>'control-label col-md-4 text-right'])}}
										<div class="col-md-8">
											{{ Form::radio('show_comment', '1', old('show_comment') == '1' ? true : ($article->show_comment == '1' ? true : false), ['id' => 'radio1']) }} 
											{{ Form::label('radio1', 'Yes') }} 
											{{ Form::radio('show_comment', '0', old('show_comment') == '0' ? true : ($article->show_comment == '0' ? true : false), ['id' => 'radio2','class'=>'ml-4']) }} 
			                    			{{ Form::label('radio2', 'No') }}

											@error('show_comment')
				                                <span class="text-danger" role="alert">
				                                    <strong>{{ $message }}</strong>
				                                </span>
				                            @enderror
										</div>
									</div>
									<div class="row form-group mb-3">
										{{ Form::label('show_poll', 'Show ratings (rate the article):',['class'=>'control-label col-md-4 text-right'])}}
										<div class="col-md-8">
											{{ Form::radio('show_poll', '1', old('show_poll') == '1' ? true : ($article->show_poll == '1' ? true : false), ['id' => 'radio3']) }} 
											{{ Form::label('radio3', 'Yes') }} 
											{{ Form::radio('show_poll', '0', old('show_poll') == '0' ? true : ($article->show_poll == '0' ? true : false), ['id' => 'radio4','class'=>'ml-4']) }} 
			                    			{{ Form::label('radio4', 'No') }}

											@error('show_poll')
				                                <span class="text-danger" role="alert">
				                                    <strong>{{ $message }}</strong>
				                                </span>
				                            @enderror
										</div>
									</div>
									<div class="row form-group mb-3">
										{{ Form::label('rss_feed', 'Publish to feed:',['class'=>'control-label col-md-4 text-right'])}}
										<div class="col-md-8">
											{{ Form::radio('rss_feed', '1', old('rss_feed') == '1' ? true : ($article->rss_feed == '1' ? true : false), ['id' => 'radio5']) }} 
											{{ Form::label('radio5', 'Yes') }} 
											{{ Form::radio('rss_feed', '0', old('rss_feed') == '0' ? true : ($article->rss_feed == '0' ? true : false), ['id' => 'radio6','class'=>'ml-4']) }} 
			                    			{{ Form::label('radio6', 'No') }}

											@error('rss_feed')
				                                <span class="text-danger" role="alert">
				                                    <strong>{{ $message }}</strong>
				                                </span>
				                            @enderror
										</div>
									</div>
									<div class="row form-group mb-3">
										{{ Form::label('show_author', 'Show Author:',['class'=>'control-label col-md-4 text-right'])}}
										<div class="col-md-8">
											{{ Form::radio('show_author', '1', old('show_author') == '1' ? true : ($article->show_author == '1' ? true : false), ['id' => 'radio7']) }} 
											{{ Form::label('radio7', 'Yes') }} 
											{{ Form::radio('show_author', '0', old('show_author') == '0' ? true : ($article->show_author == '0' ? true : false), ['id' => 'radio8','class'=>'ml-4']) }} 
			                    			{{ Form::label('radio8', 'No') }}

											@error('show_author')
				                                <span class="text-danger" role="alert">
				                                    <strong>{{ $message }}</strong>
				                                </span>
				                            @enderror
										</div>
									</div>
									<div class="row form-group mb-3">
										{{ Form::label('show_abstract_image', 'Show abstract Image:',['class'=>'control-label col-md-4 text-right'])}}
										<div class="col-md-8">
											{{ Form::radio('show_abstract_image', '1', old('show_abstract_image') == '1' ? true : ($article->show_abstract_image == '1' ? true : false), ['id' => 'radio9']) }} 
											{{ Form::label('radio9', 'Yes') }} 
											{{ Form::radio('show_abstract_image', '0', old('show_abstract_image') == '0' ? true : ($article->show_abstract_image == '0' ? true : false), ['id' => 'radio10','class'=>'ml-4']) }} 
			                    			{{ Form::label('radio10', 'No') }}

											@error('show_abstract_image')
				                                <span class="text-danger" role="alert">
				                                    <strong>{{ $message }}</strong>
				                                </span>
				                            @enderror
										</div>
									</div>
								</div>	
							</div>	
							<div class="col-md-6">
								<div class="row form-group mb-3">
									{{ Form::label('sefriendly', 'SE friendly name:',['class'=>'control-label col-md-4 text-right'])}}
									<div class="col-md-8 ">
										{{ Form::text('sefriendly',old('sefriendly') ?? $article->sefriendly,['class' => 'form-control'])}}
										@error('sefriendly')
			                                <span class="text-danger" role="alert">
			                                    <strong>{{ $message }}</strong>
			                                </span>
			                            @enderror	
									</div>
								</div>
								<div class="row form-group mb-3">
									{{ Form::label('sef_title', 'SEF Title:',['class'=>'control-label col-md-4 text-right'])}}
									<div class="col-md-8 ">
										{{ Form::text('sef_title',old('sef_title') ?? $article->sef_title,['class' => 'form-control'])}}
										@error('sef_title')
			                                <span class="text-danger" role="alert">
			                                    <strong>{{ $message }}</strong>
			                                </span>
			                            @enderror	
									</div>
								</div>
								<div class="row form-group mb-3">
									{{ Form::label('keywords', 'Meta Keywords:',['class'=>'control-label col-md-4 text-right'])}}
									<div class="col-md-8 ">
										{{ Form::text('keywords',old('keywords') ?? $article->keywords,['class' => 'form-control'])}}
										@error('keywords')
			                                <span class="text-danger" role="alert">
			                                    <strong>{{ $message }}</strong>
			                                </span>
			                            @enderror	
									</div>
								</div>
								<div class="row form-group mb-3">
									{{ Form::label('description', 'Meta Descroption:',['class'=>'control-label col-md-4 text-right'])}}
									<div class="col-md-8 ">
										{{ Form::textarea('description',old('description') ?? $article->description,['class' => 'form-control','cols' => '3', 'rows' => '5'])}}
										@error('description')
			                                <span class="text-danger" role="alert">
			                                    <strong>{{ $message }}</strong>
			                                </span>
			                            @enderror	
									</div>
								</div>
							</div>						
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer">
				{{Form::submit('Save & Continue')}}
			</div>
			{{Form::close()}}
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
	    $('#tags').select2();

	    $('.title').blur(function(e){
			var Text = $(this).val();
			Text = Text.toLowerCase();
			Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
			$(".sefriendly").val(Text); 
		});

	    $(function() {
			$('.datepicker').datepicker({
				format:'yyyy-mm-dd'
			});
		});
	    $('.advance').on('click',function(){
			$('.arrow').toggleClass("fa-arrow-up fa-arrow-down");
			$('.advanced_form').toggle();			
		});
		var state_id = 'directory_state';
		var city_id = 'directory_city';
	
	 	var country_code = "{{$article->directory_country !='' ? $article->directory_country : ''}}";
	 	var state_code = "{{$article->directory_state !=null ? $article->directory_state : ''}}";
	 	var city_code = "{{$article->directory_city !=null ? $article->directory_city : '' }}";	

	    if(country_code !=''){
	    	states(country_code,state_id,state_code);	
	    }

	    if(state_code !=''){
	    	cities(state_code,city_id,city_code);
	    }

	    $('.directory_country').on('change',function(e){	
			e.preventDefault();
			var country_code = $(this).val();		
			states(country_code,state_id);			
			
		});
		$('#directory_state').on('change',function(e){
			e.preventDefault();
			var state_code = $(this).val();
			
			cities(state_code,city_id);
		});


		 Dropzone.options.dropzone =
         {
            maxFilesize: 12,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
               return time+file.name;
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            timeout: 5000,
            success: function(file, response) 
            {
                console.log(response);
            },
            error: function(file, response)
            {
               return false;
            }
};



   	});
</script>
@endsection