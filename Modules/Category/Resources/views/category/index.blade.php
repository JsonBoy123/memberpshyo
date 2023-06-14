@extends('dashboard.layouts.master')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Categoryyyy</h1>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Categories <a href="{{url('category/create')}}" class="btn btn-sm btn-primary pull-right">Add Category</a></h4>
				
			</div>
			<div class="card-body">
				 <table id="tree-table" class="table table-hover table-bordered">
				 	<thead>
				 		<th>Categories 

				 			{{-- {{link_to('#',$title='Update',$attribute =['class' => 'btn btn-sm btn-success pull-right update',$secure=null])}} --}}

				 		</th>
				 	</thead>
                    <tbody class="row_position">
              			
                            @foreach($parentCategories as $category)
                                <tr data-id="{{$category->id}}" data-parent="0" data-level="1" >
                                    <td data-column="name" class="{{$category->view_subcat != '0' ? '' : 'text-muted'}}"> {{$category->category_name}} <a href="{{url('/category/'.$category->sefriendly.'/edit')}}" class="btn btn-sm btn-success pull-right ">Edit</a></td>
                                </tr>
                                @if(count($category->subcategory))
                                    @include('category::category.subCategoryView',['subcategories' => $category->subcategory, 'dataParent' => $category->id , 'dataLevel' => 1+1, 'dataSpace' => 2])
                                @endif      
				            @endforeach
				          
                        </tbody>
                    
                    </table>
			</div>		

		</div>
		
	</div>
</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script>     
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">   
<script>
	$(function () {
    var
        $table = $('#tree-table'),
        rows = $table.find('tr');

	    rows.each(function (index, row) {
	        var
	            $row = $(row),
	            level = $row.data('level'),
	            id = $row.data('id'),
	            $columnName = $row.find('td[data-column="name"]'),
	            children = $table.find('tr[data-parent="' + id + '"]');

	        if (children.length) {
	            var expander = $columnName.prepend('' +
	                '<span class="treegrid-expander fa fa-chevron-down"></span>' +
	                '');
	             // children.hide();

	            expander.on('click', function (e) {
	                var $target = $(e.target);
	            	console.log($target.prop("className"));
	            	if($target.prop("tagName") == 'SPAN'){
	            		if ($target.hasClass('fa-chevron-right')) {
		                    $target
		                        .removeClass('fa-chevron-right')
		                        .addClass('fa-chevron-down');

		                  
		                    children.show();
		                } else {
		                    $target
		                        .removeClass('fa-chevron-down')
		                        .addClass('fa-chevron-right');
		                    
		                    reverseHide($table, $row);
		                }	
	            	}
	                
	            });
	        }
	        $columnName.prepend('' +
	            '' +
	            '');
	    });

	    // Reverse hide all elements
	    reverseHide = function (table, element) {
	    	
	        var
	            $element = $(element),
	            id = $element.data('id'),
	            children = table.find('tr[data-parent="' + id + '"]');

	        if (children.length) {
	            children.each(function (i, e) {
	                reverseHide(table, e);
	            });

	            // $element
	            //     .find('.fa-chevron-down')
	            //     .removeClass('fa-chevron-down')
	            //     .addClass('fa-chevron-right');

	            children.hide();
	        }
	    };
});

	$(document).ready(function(){
		 $('tbody').sortable({
	 	    delay: 150,
	        stop: function() {
	            var page_id = new Array();
	            var parent_id = new Array();

	            $('.row_position>tr').each(function() {

	                page_id.push($(this).attr("data-id"));

	            });
	            $('.row_position>tr').each(function() {

	                parent_id.push($(this).attr("data-level"));

	            });

	            console.log(parent_id);
	            // updatePageOrder(page_id,parent_id);

	        }
		 });
		 function updatePageOrder(page_id,parent_id){
		 	console.log(page_id);
		 	$.ajax({
		 		type:'post',
		 		url: '{{url('/categoriesPosition')}}',
		 		data:{page_id:page_id},
		 		success:function(res){
		 			console.log(res);
		 		}
		 	})
		 }

		 // $('.update').on('click',function(){
		 // 	var page_id = new Array();
		 //    $('.row_position>tr').each(function() {
		 //        page_id.push($(this).attr("data-id"));
		 //    });
		 //    console.log(page_id);
		 // })

	})
</script>
@endsection