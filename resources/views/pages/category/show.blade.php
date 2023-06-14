@extends('layouts.default')
@section('content')
{{-- @include('layouts.slider') --}}
<main id="main">
<section class="section-services section-t8">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<nav>
				    <ol class="breadcrumb">
				       <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
			
				       @if($category->parentcategory !=null)
					       	@include('pages.breadcrumb_category',['parentcategory' => $category->parentcategory])
				        	
				        	<li class="breadcrumb-item"><a href="{{url('category_show/'.$category->parentcategory->sefriendly)}}">{{$category->parentcategory->category_name}}</a></li>
				       @endif

				       <li class="breadcrumb-item active">{{$category->category_name}}</li>
				    </ol>
				</nav>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<hr>
				<h4 class="font-weight-bold">{{$category->category_name}}</h4>
				<hr>		
			</div>
			@foreach($articles as $article)
				<div class="col-md-12 mb-3">
					<h5 ><a href="{{url('article_show/'.$article->sefriendly)}}">{{$article->title}}</a></h5>
					<p>
						@php 
							if(!preg_match( '@src="([^"]+)"@' , $article->body, $match )){
							  echo str_limit($article->body,140,'...') ;
							}
						@endphp
                     </p>
                      <a href="{{url('article_show/'.$article->sefriendly)}}" style="font-size:12px;">Read More</a>
                 <hr>
				</div>
			@endforeach
			{{ $articles->links() }}
		</div>
	</div>
</section>
</main>
@endsection