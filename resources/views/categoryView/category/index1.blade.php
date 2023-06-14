@extends('dashboard.layouts.master')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('css/nestable.css')}}">
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Category</h1>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Categories 
                    @include('category::partials.buttonDropdown')
                </h4>
                
            </div>
            <div class="card-body">
                <div class="cf nestable-lists">

                    <div class="dd" id="nestable" style="width: 100%">
                        <ol class="dd-list">
                            @foreach($parentCategories as $category)
                                @if(count($category->subcategory))
                                    <li class="dd-item" data-id="{{$category->id}}">
                                       <div class="dd-handle"> 
                                        <span id="category-item" class="{{$category->view_subcat != '0' ? '' : 'text-muted'}}">{{$category->category_name}}</span>
                                        <a href="{{url('/category/'.$category->sefriendly.'/edit')}}" class="close close-assoc-file"><i class="fa fa-edit text-success "></i></a>
                                         </div>
                                        <ol >
                                            @include('category::category.subCategoryList1',['subcategories' => $category->subcategory])
                                        </ol>
                                    </li>
                                @else
                                    <li class="dd-item" data-id="{{$category->id}}" >
                                        <div class="dd-handle">
                                            <span id="category-item" class="{{$category->view_subcat != '0' ? '' : 'text-muted'}}"> {{$category->category_name}}</span>
                                            <a @if($category->type == 'category') href="{{url('/category/'.$category->sefriendly.'/edit')}}"  @else href="{{url('/link/'.$category->id.'/edit')}}" @endif class="close close-assoc-file"><i class="fa fa-edit text-success"></i></a>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/nestable.js')}}"></script>

<script>

$(document).ready(function()
{

 $('.dd').nestable().on('change', function() {
     var data = $('.dd').nestable('serialise');
     // console.log(data);
    var ids = new Array();
    $('.dd li').each(function() {
        ids.push($(this).attr("data-id"));
    });

     $.ajax({
        type:'post',
        url: '{{url('/categoriesPosition')}}',
        data:{data:data,ids:ids},
        success:function(res){
            console.log(res);
            location.reload();
        }
    });
});

   

});
</script>
@endsection