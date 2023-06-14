@extends('dashboard.layouts.master')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Topics</h1>
</div>
<div class="row">
	<div class="col-md-3">
		<div class="card">
			<div class="card-header bg-white">
				<h5 class="card-title">Show Topics</h5>
			</div>
			<div class="card-body">		
				<div class="row">
					<div class="col-md-12 mb-2">
						<a href="javascript:void(0)" class="addNewTopic"><i class="fa fa-plus"></i> Add New Topics</a>		
					</div>	
				</div>
				@foreach($topics as $topic)
				<h6 class=""><a href="javascript:void(0)" class="topicBtn" id="{{$topic->id}}">{{$topic->name}}</a> <a href="" class="pull-right"><i class="fa fa-edit text-success"></i></a></h6>
				@endforeach				
			</div>
		</div>
	</div>
 
    <div class="col-md-9"  id="topicShowDiv">
       @include('category::tags.topicShow')
    </div>
    <div class="col-md-9" id="topicsDiv" style="display: none">
    	
    </div>
</div>
<script >
	$(document).ready(function(){
		$('.advance').on('click',function(){
			$('.arrow').toggleClass("fa-arrow-up fa-arrow-down");
			$('.advanced_form').toggle();
		});

		$('.topicBtn').on('click',function(e){
			e.preventDefault();
			var id = $(this).attr('id');
			$.ajax({
				type:'get',
				url:'{{url('tags')}}/'+id,
				success:function(res){
					$('#topicShowDiv').hide();
					$('#topicsDiv').show();
					$('#topicsDiv').empty().html(res);
					// console.log(res);
				}

			})
		});
		$(document).on('click','.addNewTopic',function(e){
			e.preventDefault();
			$('#topicShowDiv').show();
			$('#topicsDiv').hide();
		});
	});
	
</script>
@endsection