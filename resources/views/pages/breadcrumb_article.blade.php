
@if($parentcategory->parentcategory !=null)
	
	@include('pages.breadcrumb_article',['parentcategory' => $parentcategory->parentcategory])

	<li class="breadcrumb-item"><a href="{{url('category_show/'.$parentcategory->parentcategory->sefriendly)}}">{{$parentcategory->parentcategory->category_name}}</a></li>
	
@endif