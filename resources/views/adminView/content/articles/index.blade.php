@extends('dashboard.layouts.master')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Articles</h1>
</div>
<div class="row">
	<div class="col-md-3">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Filter</h5>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-12 form-group">
						{{Form::label('keywords','Keywords:')}}
						{{Form::text('keywords','',['class' => 'form-control'])}}
					</div>
					<div class="col-md-12 form-group">
						{{ Form::label('status', 'Set Status:')}}
						{{ Form::select('status',array('' => 'Select Status','1' => 'Active', '2' => 'Pending', '3' =>'Archived'),'',['class'=>'form-control status'])}}
					</div>
					<div class="col-md-12 form-group">
						{{ Form::label('status', 'Categories:')}}
						<select class="form-control filter_category" name="parent_cat" multiple='multiple'>
							<option value="all" selected="selected">All Categories</option>
							@foreach($parentCategories as $category)
							<option class="root" value="{{$category->id}}">{{$category->category_name}}</option>
								@if(count($category->subcategory))
									@include('category::category.subCategoryList',['subcategories' => $category->subcategory, 'dataSpace' => 2])
								@endif
							@endforeach
						</select>
					</div>		
				</div>		
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Articles 
					{{link_to('/article/create', $title = 'Add Article', $attributes = ['class' => 'btn btn-sm btn-primary pull-right'], $secure = null)}}
				</h5>
			</div>
			<div class="card-body">	
				<div class="row">
					<div class="col-md-6 mb-4 ">
						<h5>EDIT</h5>
						
					</div>
				</div>
				<table class="table table-bordered table-striped mytable">
					<thead>
						<tr>
							<th>{{Form::checkbox('all_check',null,null,['id' => 'checkAll'])}}</th>
							<th>Title</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>						
					</thead>
					<tbody class="row_position">
						@foreach($articles as $article)
						<tr data-id="{{$article->id}}" class="row1" id="{{$article->order_num}}">
							<td>{{Form::checkbox('art_check[]',$article->id)}}</td>

							<td>{{$article->title}}</td>
							<td>
								{{$article->category !=null ? $article->category->category_name : ''}}
							</td>
							<td>
								<a href="{{url('article/'.$article->id.'/edit')}}"><i class="fa fa-edit text-success"></i></a>
								<a href="{{url('article/destroy/'.$article->id)}}"><i class="fa fa-trash text-danger"></i></a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script >
	@if($message = Session::get('success'))
  	  alert('{{$message}}');
	@endif

	$(document).ready(function () {
    	$('.mytable').DataTable();
		$('.filter_category').select2();



		$("#checkAll").click(function(){
  		    $('input:checkbox').not(this).prop('checked', this.checked);
   		});


    	// $('.category').on('click', function(e){
    	// 	e.preventDefault();
    	// 	var article_id  = $(this).parent().parent().attr('id');
    	// 	var category_id = $(this).val();

    	// 	$.ajax({
    	// 		type:'POST',
    	// 		url:'{{url('/article/category_update')}}',
    	// 		data:{category_id:category_id,article_id:article_id},
    	// 		success:function(res){
    	// 			console.log(res);
    	// 		}
    	// 	});
    	// });
    // 	 $(".row_position").sortable({
		  //     items: "tr",
		  //     cursor: 'move',
		  //     opacity: 0.6,
		  //     update: function() {
		  //         sendOrderToServer();
		  //     }
		  //   });

		  //   function sendOrderToServer() {

		  //     var order = [];
		  //     $('tr.row1').each(function(index,element) {
		  //       order.push({
		  //         id: $(this).attr('data-id'),
		  //         order_num: $(this).attr('id'),
		  //         position: index+1
		  //       });
		  //     });
		  //     console.log(order);


		  //     // console.log(order); 

		  //      $.ajax({
		  //       type: "POST", 
		  //       url: "{{ url('/article/update_order')}}",
		  //       data: {
		  //         order:order,
		  //       },
		  //       success: function(response) {
		  //       	console.log(response);
		  //           // if (response.status == "success") {
		  //           //   console.log(response);
		  //           // } else {
		  //           //   console.log(response);
		  //           // }
		  //       }
		  //     });
		  // }


		// $( ".row_position" ).sortable({
		// 	delay: 150,
		// 	stop: function() {
		// 	var selectedData = new Array();
		// 	$('.row_position>tr').each(function() {
		// 	selectedData.push($(this).attr("id"));
		// 	});
		// 	updateOrder(selectedData);
		// 	}

		// });

  //       function updateOrder(data) {

  //       	console.log(data);
  //       }
    });
</script>
@endsection