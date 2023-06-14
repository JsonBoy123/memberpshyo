<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Physiotherapy</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
{{--   <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> --}}

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i,900" rel="stylesheet">

	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

	{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}


  <!-- Vendor CSS Files -->
  <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('vendor/icofont/icofont.min.css')}}" rel="stylesheet">

  <link href="{{asset('vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('vendor/animate.css/animate.min.css')}}" rel="stylesheet">
  <link href="{{asset('vendor/venobox/venobox.css')}}" rel="stylesheet">
  <link href="{{asset('vendor/aos/aos.css')}}" rel="stylesheet">


  <!-- Template Main CSS File -->
  <link href="{{asset('css/style.css')}}" rel="stylesheet">
  @php
     $categories = Modules\Category\Entities\Category::where('type','category')->whereNull('parent_cat')->orderBy('order_num','ASC')->get();
     $links = Modules\Category\Entities\Category::where('type','link')->whereNull('parent_cat')->orderBy('order_num','ASC')->get();
     
  @endphp
 
</head>

<body>
	<!-- ======= Top Bar ======= -->
	<section id="topbar" class="d-none d-lg-block">
		<div class="container clearfix">
		  <div class="contact-info float-left">
		  	<nav class="nav-menu float-right d-none d-lg-block">
        	<ul>
          @foreach($links as $link)
			  	  <li><a href="" class="font-weight-bold">{{$link->category_name}}</a></li>
          @endforeach
         
           @guest
            <li><a href="{{ route('login') }}" class="font-weight-bold">Login</a></li>
             @if (Route::has('register'))
               <li>
                  <a href="{{ route('register') }}" class="font-weight-bold">Register</a>
               </li>
             @endif
          
          @else
           <li class="drop-down">
              <a href="">{{ Auth::user()->name }} </a>
              <ul>
                <li><a href="{{route('home')}}" style="color: #000 !important" >Dashboard</a></li>
                <li><a href="{{ route('logout') }}" style="color: #000 !important" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
              </ul>
            </li>
           @endguest
		  	</ul>


		  	</nav>   
		  </div>
		  <div class="social-links float-right">
       {{--  <a href="#" class="twitter"><i class="icofont-twitter"></i></a>
        <a href="#" class="facebook"><i class="icofont-facebook"></i></a>
        <a href="#" class="instagram"><i class="icofont-instagram"></i></a>
        <a href="#" class="skype"><i class="icofont-skype"></i></a>
        <a href="#" class="linkedin"><i class="icofont-linkedin"></i></a> --}}
       {{--  <nav class="nav-menu float-right d-none d-lg-block">
          <ul>
            @guest
              <li class="mr-4">{{Form::text('email','',['class' => 'form-control p-2', 'placeholder' => 'Email or Mobile number'])}}</li>
              <li class="mr-4">{{Form::input('password', 'password','',['class' => 'form-control p-2', 'placeholder' => 'Password'])}}
              </li>
              <li class="">{{Form::submit('Login',['class' => 'btn btn-sm btn-secondary p-2'])}}</li>
            @endguest          
        </ul>
        </nav>   
		   --}}
		  </div>
		</div>
	</section>

	<!-- ======= Header ======= -->
	<header id="header" style="border-bottom: 1px solid rgb(230, 230, 230);">
    <div class="container">

      <div class="logo float-left">
        <h1 class="text-light"><a href="{{url('/')}}"><span><img src="{{asset('images/physio.png')}}"></span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav class="nav-menu float-right d-none d-lg-block">
        <ul>
            {{-- <li class="active"><a href="#home">{{__('Home')}}</a></li> --}}
          @foreach($categories as $category)
            @if(count($category->subcategory))
              @if($category->view_subcat =='1')
              <li class="drop-down"><a href="{{url('category_show/'.$category->sefriendly)}}">{{$category->category_name}}</a>
              @endif
                  @include('partials.navbarSubList',['subcategories' => $category->subcategory])
              </li>
            @else
               @if($category->view_subcat =='1')
                <li><a href="{{url('category_show/'.$category->sefriendly)}}">{{$category->category_name}}</a></li>
              @endif
            @endif
          @endforeach
        </ul>
         
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->
