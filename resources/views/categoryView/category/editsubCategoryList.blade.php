@foreach($subcategories as $subcategory)
	<option value="{{$subcategory->id}}" {{old('parent_cat') == $subcategory->id ? 'selected' : ($article->category_id == $subcategory->id ? 'selected' : '') }} >
			@php 
            	// if(count($subcategory->subcategory) ==0){
	            	$i =1;

	            	while ($i <= $dataSpace) {
	            		 echo "&nbsp;"." " ; 
	            		 $i++;
	            	}
	            	echo "-";
            	// }
            @endphp
		{{$subcategory->category_name}}</option>
	@if(count($subcategory->subcategory))
		@include('category::category.subCategoryList',['subcategories' => $subcategory->subcategory,'dataSpace' =>$dataSpace + 1 ])
	@endif										
@endforeach