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
				       <li class="breadcrumb-item"><a href="#">Home</a></li>
				       @if($article->category !=null)
					       	@if($article->category->parentcategory !=null)

					        	@include('pages.breadcrumb_article',['parentcategory' => $article->category->parentcategory])
					       		<li class="breadcrumb-item"><a href="{{url('category_show/'.$article->category->parentcategory->sefriendly)}}">{{$article->category->parentcategory->category_name}}</a></li>
					       	@endif
				        
				        <li class="breadcrumb-item"><a href="{{url('category_show/'.$article->category->sefriendly)}}">{{$article->category->category_name}}</a></li>
				       @endif
				       <li class="breadcrumb-item active">{{$article->title}}</li>
				    </ol>
				</nav>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 ">
				<hr>
				<h4 class="font-weight-bold">{{$article->title}}</h4>
				<h6>{{date('d-m-Y', strtotime($article->created))}}</h6>
				<hr>
				<p>
					@php
						echo $article->body;
					@endphp
				</p>
			</div>
		</div>
	</div>
</section>
	@include('layouts.banner_section')
</main>	
@endsection