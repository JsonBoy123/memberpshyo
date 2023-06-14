@extends('dashboard.layouts.master')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Specialization Approval</h1>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Member Pending Specializations List 
					<a href="{{url('/approval/specialization')}}" class="btn btn-sm btn-primary pull-right">Back</a>
				
					
				</h5>
			</div>
			<div class="card-body ">	
				<div class="row">
					<div class="col-md-12 mb-4">
						<a href="javascript:void(0)" class="btn btn-sm btn-success approve"> Approve</a>
						<a href="javascript:void(0)" class="btn btn-sm btn-danger decline"> Decline</a>
						
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 table-responsive">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>{{Form::checkbox('qual_all_check',null,null,['id' => 'checkAll'])}}</th>
									<th>Specialization Name</th>
									<th>Approval Action</th>
								</tr>
							</thead>
							<tbody>									
								@foreach($specs as $spec)
								<tr>
									<td>{{Form::checkbox('spec_check[]',$spec->specialization_id)}}</td>
									<td>{{$spec->specializations->name}}</td>
								
									<td>
										<a href="{{url('approval/specialization_approve/'.$spec->specialization_id.','.$spec->user_id)}}" class="mr-3"> <i class="fa fa-check text-success"></i></a>
										<a class="mr-3 declinebtn" title="Declined" id="{{$spec->specialization_id}}"> <i class="fa fa-times text-danger" ></i></a>
										
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
				
				<div class="modal" id="myModal">
					<div class="modal-dialog">
						<div class="modal-content">							
							<div class="modal-header">
								<h4 class="modal-title">Add Decline Reason</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>

							{{Form::open(array('url' => 'approval/specialization_decline','method' => 'post'))}}
							<div class="modal-body">
								{{Form::textarea('reason','',['class' => 'form-control' , 'rows' => '4','cols' => '4','required' => 'true'])}}
								{{Form::hidden('id', '',['class' => 'specialization_id'])}}
								{{Form::hidden('user_id', $user_id)}}
							</div>

							<div class="modal-footer">
								{{Form::submit('Submit', ['class' => 'btn-success btn btn-sm'])}}
								<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
							</div>
							{{Form::close()}}

						</div>
					</div>
				</div>

				<div class="modal" id="myModalAll">
					<div class="modal-dialog">
						<div class="modal-content">							
							<div class="modal-header">
								<h4 class="modal-title">Add Decline Reason</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>

							{{-- {{Form::open(array('url' => 'approval/qualification_decline','method' => 'post'))}} --}}
							<div class="modal-body">
								{{Form::textarea('reason','',['class' => 'form-control reason' , 'rows' => '4','cols' => '4','required' => 'true'])}}
								{{-- {{Form::hidden('id', '',['class' => 'qual_id'])}} --}}

							</div>

							<div class="modal-footer">
								{{Form::submit('Submit', ['class' => 'btn-success btn btn-sm reasonSubmit'])}}
								<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
							</div>
							{{-- {{Form::close()}} --}}

						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
<script>
	@if($message = Session::get('success'))
	    alert('{{$message}}');
	@endif
	$(document).ready(function(){
		$("#checkAll").click(function(){
		    $('input:checkbox').not(this).prop('checked', this.checked);
		});

		$('.approve').on('click',function(){
			var user_id = "{{$user_id}}";
			var ids = [];
			$("input:checkbox[name='spec_check[]']:checked" ).each(function () {
			    ids.push($(this).val());
			});
			if(ids.length == 0){
				alert('select first')
			}else{
				$.ajax({
					type:'post',
					url:'{{url('approval/specialization_approve_all')}}',
					data:{ids:ids,user_id:user_id},
					success:function(res){
						// console.log(res);
						 location.reload();
					}
				});			
			}
		});

		$('.declinebtn').on('click',function(e){
			e.preventDefault();
			var id = $(this).attr('id');
			$('.specialization_id').val(id);
			$('#myModal').modal('show');				
		});


		$('.decline').on('click',function(){
			var user_id = "{{$user_id}}";
			var ids = [];
			$("input:checkbox[name='spec_check[]']:checked" ).each(function () {
			    ids.push($(this).val());
			});
			if(ids.length == 0){
				alert('select first')
			}else{
				$('#myModalAll').modal('show');
				$('.reasonSubmit').on('click',function(e){
					e.preventDefault();
					var reason = $('.reason').val();

					if($('.reason').val().replace(/\s+/g, '').length != ''){
						$.ajax({
							type:'post',
							url:'{{url('approval/specialization_decline_all')}}',
							data:{ids:ids,reason:reason,user_id:user_id},
							success:function(res){
								// alert(res);
								location.reload();
							}
						});	
					}else{
						alert('The reason field is required.');
					}
				})
			}
		});

	});

</script>
@endsection