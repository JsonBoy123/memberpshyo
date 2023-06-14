@extends('dashboard.layouts.master')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Specialization</h1>
</div>

<div class="row">
	<div class="col-md-7">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Specialization</h5>
			</div>
			<div class="card-body">
				<div class="parts-selector" id="parts-selector-1">
					<div class="parts list h-40vh">
						<h3 class="list-heading top-fixed">Select Specializations</h3>
						<ul>
							@foreach($specializations as $specialization)
								<li id="{{$specialization->id}}">
								<input type="hidden" name="valuSpeci[]" value="{{$specialization->id}}" id="valuSpeci" />{{$specialization->name }}
								</li>
							@endforeach
						</ul>
					</div>
					<div class="controls">
						<a class="moveto selected"><span class="icon"></span><span class="text">Add</span></a>
						<a class="moveto parts"><span class="icon"></span><span class="text">Remove</span></a>
					</div>

					<div class="selected list">
						<h3 class="list-heading">Add Specialization</h3>
						<ul id="uspec">
							@foreach($userSpec as $spec)
							  <li><input type="hidden" name="valuSpeci[]" value="{{$spec->specializations->id}}" id="valuSpeci" />{{$spec->specializations->name}}</li>
							@endforeach
						</ul>
					</div>
				</div> 
				<button class="btn btn-md btn-primary" id="submit">Submit</button>
			</div>
		</div>
	</div>
	<div class="col-md-5">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Your Specializations</h5>
			</div>
			<div class="card-body">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Specialization</th>
							<th>Verify for approval</th>
						</tr>
					</thead>
					<tbody>
					@foreach($userSpec as $spec)
						<tr>
							<td>{{$spec->specializations->name}}</td>
							<td>{{$spec->status == 'P' ? 'Pending' : ($spec->status == 'A' ? 'Approved' : 'Declined')}}
								@if($spec->reason !=null && $spec->status == 'D')
									<a href="javascript:void(0)" class="btn btn-sm btn-primary reasonBtn" id="{{$spec->specialization_id}}" data-id="{{$spec->user_id}}">Reason</a>
								@endif
							</td>
							
						</tr>
					@endforeach 
					</tbody>
				</table>
			</div>
			<div class="modal" id="myModal">
					<div class="modal-dialog">
						<div class="modal-content">							
							<div class="modal-header">
								<h4 class="modal-title">Show Decline Reason</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>

							<div class="modal-body">
								<p class="reason_text"></p>
								
							</div>

							<div class="modal-footer">
								<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
	$(function() {
		$( "#parts-selector-1").partsSelector();
	});
  
	$('#submit').on('click',function(e){
        e.preventDefault();
        var spec_id = $("#uspec input[name='valuSpeci[]']")
              .map(function(){
                return $(this).val();
              }).get();   
     	
        if(spec_id != ''){
        	$.ajax({
        		type:'POST',
        		url:"{{url('/specialization')}}",
        		data: {spec_id:spec_id},
        		success:function(data){
        			console.log(data);
        		swal({
	                text: data,
	                icon : 'success',
              	});

               	setTimeout(function(){ 
                  location.reload(); 
               	}, 3000); 

        		}
        	});
        }
        else{
            swal({
              text: 'First Add Specialization',
              icon: 'warning',
            });
      
        }

    });


    $('.reasonBtn').on('click',function(e){
		e.preventDefault();
		var id = $(this).attr('id');                                                 
		var user_id = $(this).attr('data-id');                                                 
		$.ajax({
			type:'POST',
			url:'{{url('specialization_reason')}}',
			data:{id:id,user_id:user_id},
			success:function(res){
				$('#myModal').modal('show');	
				$('.reason_text').empty().html(res.reason);
			
			}
		});

	});
});
</script>
@endsection
				