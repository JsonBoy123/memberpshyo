 <div class="card">
	<div class="card-header">
		<h5 class="card-title">View {{$topic->name}} tags

			<button type="button" class="btn btn-sm btn-primary pull-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Add Tags </button>
		</h5>		
	</div>
	
	<div class="card-body" id="tagsListDiv" style="min-height: 200px"> 
		<div class="row">
			<div class="col-md-12" id="tagsList">
				@include('category::tags.tagsList')
			</div>
		</div>

		<div class="modal fade" id="myModal">
		    <div class="modal-dialog">
		      	<div class="modal-content">
			       
			        <div class="modal-header">
			          <h4 class="modal-title">Add Tags</h4>
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			        </div>	

			        <div class="modal-body">
			          <h6>Comma separated list of tags:</h6>
			          {{Form::open(array('url' => 'tags','method' => 'post','id' => 'formData'))}}
			          <div class="row form-group">
			          	<div class="col-md-12">
			          		{{ Form::textarea('name',old('name'), ['class'=>'form-control tagsName','rows' => 3, 'cols' => 3, 'required' => true]) }}
			          		{{Form::hidden('tags_group_id',$topic->id)}}
			          		
			          	</div>
			          	<div class="col-md-12 mt-2">
			          		{{Form::submit('Submit',['class' => 'btn btn-sm btn-success'])}}
			          	</div>
			          </div>
			          {{Form::close()}}
			        </div>		        
		        </div>
		    </div>
		</div>
	</div>

	<div class="card-footer">
		
	</div>
	
</div>

<script>
	$(document).ready(function(){
		 var frm = $('#formData');

		$(frm).submit(function(e){

        e.preventDefault();

	        $.ajax({
	            type: frm.attr('method'),
	            url: frm.attr('action'),
	            data: frm.serialize(),
	            success: function (data) {
	            	$('.tagsName').val('');
	            	$('#myModal').modal('hide');

	                $('#tagsList').empty().html(data);
	            },
	            error: function (data) {

	                console.log('An error occurred.');
	                console.log(data);
	            },
	        });
		});


	});
</script>