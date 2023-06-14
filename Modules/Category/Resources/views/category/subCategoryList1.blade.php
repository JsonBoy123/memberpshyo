@foreach($subcategories as $subcategory)
    @if(count($subcategory->subcategory))
        <li class="dd-item" data-id="{{$subcategory->id}}">
            <div class="dd-handle">
                <span id="category-item" class="{{$subcategory->view_subcat != '0' ? '' : 'text-muted'}}">{{$subcategory->category_name}}</span>
                <a href="{{url('/category/'.$subcategory->sefriendly.'/edit')}}" class="close close-assoc-file"><i class="fa fa-edit text-success"></i></a>
            </div>
             <ol >
                @include('category::category.subCategoryList1',['subcategories' => $subcategory->subcategory])
            </ol>
        </li>
    @else
        <li class="dd-item" data-id="{{$subcategory->id}}" >
            <div class="dd-handle">
                <span id="category-item" class="{{$subcategory->view_subcat != '0' ? '' : 'text-muted'}}">{{$subcategory->category_name}}</span>
                <a href="{{url('/category/'.$subcategory->sefriendly.'/edit')}}" class="close close-assoc-file"><i class="fa fa-edit text-success"></i></a>
            </div>
        </li>
    @endif

@endforeach