@foreach($parentCategories as $category)
    @if(count($category->subcategory))
        <li class="dd-item" data-id="{{$category->id}}">
           <div class="dd-handle"> 
            <span id="category-item">{{$category->category_name}}</span>
            <a href="{{url('/category/'.$category->sefriendly.'/edit')}}" class="close close-assoc-file"><i class="fa fa-edit text-success btn-sm"></i></a>
             </div>
            <ol >
                @include('category::category.subCategoryList1',['subcategories' => $category->subcategory])
            </ol>
        </li>
    @else
        <li class="dd-item" data-id="{{$category->id}}" >
            <div class="dd-handle">
                <span id="category-item">{{$category->category_name}}</span>
                <a href="{{url('/category/'.$category->sefriendly.'/edit')}}" class="close close-assoc-file"><i class="fa fa-edit text-success"></i></a>
            </div>
        </li>
    @endif
@endforeach