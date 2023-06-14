@foreach($subcategories as $subcategory)
        <tr data-id="{{$subcategory->id}}" data-parent="{{$dataParent}}" data-level = "{{$dataLevel + 1}}">
            <td data-column="name" class="{{$subcategory->view_subcat != '0' ? '' : 'text-muted'}}">
            	@php 
            	if(count($subcategory->subcategory) ==0){
	            	$i =1;

	            	while ($i <= $dataSpace) {
	            		 echo "&nbsp;"." " ; 
	            		 $i++;
	            	}
	            	echo "-";
            	}
            @endphp
            {{$subcategory->category_name}} <a href="{{url('/category/'.$subcategory->sefriendly.'/edit')}}" class="btn btn-sm btn-success pull-right ">Edit</a></td>
        </tr>
        @if(count($subcategory->subcategory))
            @include('category::category.subCategoryView',['subcategories' => $subcategory->subcategory, 'dataParent' => $subcategory->id, 'dataLevel' => $dataLevel +1,'dataSpace' => $dataSpace + 2 ])
        @endif
@endforeach