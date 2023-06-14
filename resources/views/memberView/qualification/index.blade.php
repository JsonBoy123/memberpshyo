@extends('dashboard.layouts.membermaster')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Qualification </h1>
</div>

<div class="row">

	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Qualification <a href="{{url('/qualification/create')}}" class="btn btn-sm btn-primary pull-right">Add Qualification</a></h5>
			</div>
			<div class="card-body">
				@if($message = Session::get('success'))
				    <div class="alert alert-success">
				        {{$message}}
				    </div>
				@endif
				<div class="row">
					<div class="col-md-12 table-responsive">
						<table class="table table-bordered table-striped mytable">
							<thead>
								<tr>
									<th>#</th>
									<th>Qualification Name</th>
									<th>School/College/Institute</th>
									<th>Board/University/Other</th>
									<th>Pass Year (In %)</th>
									<th>Pass Marks</th>
									<th>Pass Division</th>	
									<th>Verify for approval</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@php
									$count = 1; 
								@endphp
								@foreach($qualifications as $qualification)
								<tr>
									<td>{{$count}}</td>
									<td>{{$qualification->qual_catg_desc}}</td>
									<td>{{$qualification->location}}</td>
									<td>{{$qualification->board}}</td>
									<td>{{$qualification->pass_year}}</td>
									<td>{{$qualification->pass_marks}}</td>
									<td>{{$qualification->pass_division == '1' ? '1st' : ($qualification->pass_division == '2' ? '2nd' : '')}}</td>

									<td>
										{{$qualification->status == 'P' ? 'Pending' : ($qualification->status == 'A' ? 'Approved' : 'Declined')}}
										@if($qualification->reason != null)
											<a href="javascript:void(0)" class="btn btn-sm btn-primary reasonBtn" id="{{$qualification->id}}">reason</a>
										@endif
									</td>

									<td>
										<a href="{{url('/qualification/'.$qualification->id.'/edit')}}" class="mr-2"><i class="fa fa-edit text-success"></i></a>

										{{-- <a href="{{url('/doc_download/'.$qualification->file ?->id)}}" class="mr-2"><i class="fa fa-download text-info"></i></a> --}}

										<a href="{{asset('storage/'.$qualification->doc_url)}}" ><i class="fa fa-eye text-info"></i></a>
									</td>
								</tr>
								@php $count++; @endphp
								@endforeach
							</tbody>
						</table>
					</div>
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
</div>
<script >
	$(document).ready(function () {
    	$('.mytable').DataTable();

    	$('.reasonBtn').on('click',function(e){
    		e.preventDefault();
    		var id = $(this).attr('id');                                                 
    		$.ajax({
    			type:'GET',
    			url:'{{url('qualification_reason')}}/'+id,
    			success:function(res){
    				$('#myModal').modal('show');	
    				$('.reason_text').empty().html(res.reason);
    			
    			}
    		})

    	});

	});
</script>
@endsection