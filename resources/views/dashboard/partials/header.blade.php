<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Physiotherapy</title>
  <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>

  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <!-- Custom styles for this template-->
  <link href="{{asset('css/sb-admin.css')}}" rel="stylesheet">
  <link href="{{asset('css/app.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/parts-selector.css')}}">
  
  <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
   
   <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" /> -->
   <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
 
</head>

<body id="page-top">

  <div id="wrapper">
    @role('member_admin')
      @php 
         $pen_quals = \Modules\Member\Entities\MemberQual::where('status','P')->distinct()->pluck('user_id');
         $pen_profiles = \Modules\Member\Entities\Member::where('approval','0')->pluck('user_id');

         $pen_specs = \Modules\Member\Entities\UserSpec::where('status','P')->distinct()->pluck('user_id');

         // $service_request = \App\Models\UserService;
      @endphp
    @endrole

    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/')}}">
        <div class="sidebar-brand-icon rotate-n-15">
          PH
        </div>
        <div class="sidebar-brand-text mx-3">Physiotherapy</div>
      </a>

      <hr class="sidebar-divider my-0">

      <li class="nav-item active">
        <a class="nav-link" href="{{route('home')}}">
          <i class="fa fa-fw fa-tachometer-alt"></i>
      </li>

     
      <hr class="sidebar-divider">

      @role('super_admin')
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#aclNav" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fa fa-list-alt"></i>
            <span>ACL</span>
          </a>
          <div id="aclNav" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="{{url('/acl/user')}}">Users</a>
              <a class="collapse-item" href="{{url('/acl/role')}}">Roles</a>
              <a class="collapse-item" href="{{url('/acl/permission')}}">Permissions</a>
            </div>
          </div>
        </li>
       
        <li class="nav-item">
          <a class="nav-link" href="{{url('/category')}}">
            <i class="fa fa-list-alt"></i>
            <span>Categories</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#contentNav" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fa fa-list-alt"></i>
            <span>Content</span>
          </a>
          <div id="contentNav" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="{{url('/article')}}">Articles</a>
              <a class="collapse-item" href="">Comments</a>
              <a class="collapse-item" href="">Pages</a>
            </div>
          </div>
        </li>
      @endrole

      @role('member|college|corporate')
      @if(!empty(service_check()))
        @if(service_check()->status == 'A' && service_check()->payment_status == '1')
        <li class="nav-item">

          <a class="nav-link" href="{{url('/member')}}" >
            <i class="fa fa-users"></i>
            <span>Profile</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/qualification')}}">
            <i class="fa fa-graduation-cap"></i>
            <span>Qualification</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/specialization')}}">
            <i class="fa fa-medkit"></i>
            <span>Specialization</span>
          </a>
        </li>  
        @endif   
      @endif   
      @endrole

      @role('super_admin|member|member_admin|college|corporate')
        <li class="nav-item">
          <a class="nav-link" href="{{url('/service')}}">
            <i class="fa fa-cogs"></i>
            <span>Services</span>
          </a>
        </li>
        @role('member')
       
        <style type="text/css">#docc{display:none;}</style>
        
        <li class="nav-item" id="docc">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
            <i class="fa fa-folder"></i>
            <span>Documents </span>
          </a>
          <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="{{url('services/iap_membership_tenth')}}">10th Marksheet</a> 

              <a class="collapse-item" href="{{url('services/iap_membership_twelve')}}">12th Marksheet </a> 

              <a class="collapse-item" href="{{url('services/iap_membership_intern')}}">Internship </a>

              <a class="collapse-item" href="{{url('services/iap_membership_bpt')}}">Bachelor of Physiotherapy</a>

              <a class="collapse-item" href="{{url('services/iap_membership_mpt')}}">Master of Physiotherapy</a>

              <a class="collapse-item" href="{{url('services/iap_membership_govprf1')}}">Any Goverment Proof </a>

              <a class="collapse-item" href="{{url('services/iap_membership_govprf2')}}">Another Goverment Proof </a>

              <a class="collapse-item" href="{{url('services/iap_membership_other')}}">Any Other Document </a>
            </div>
          </div>
        </li>
        
        @endrole
      @endrole

      @role('member_admin')
        <li class="nav-item">
          <a href="{{url('approval/service_request')}}" class="nav-link">
            <i class="fa fa-cogs"></i>
            <span>Services Request </span>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{url('members_list')}}" class="nav-link">
            <i class="fa fa-users"></i>
            <span>Members List</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('new_members_list')}}">
            <i class="fa fa-cogs"></i>
            <span>New Members List</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fa fa-list"></i>
            <span>Approval @if(count($pen_quals) !=0 || count($pen_specs) !=0 || count($pen_profiles) !=0) <span class="pull-right notify_orange_btn">{{count($pen_quals) + count($pen_specs) + count($pen_profiles)}}</span> @endif</span>
          </a>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" {{-- href="{{route('approval.profile')}}" --}}>Profile @if(count($pen_profiles) !=0) <span class="pull-right notify_orange_btn">{{count($pen_profiles)}}</span> @endif</a> 

              <a class="collapse-item" href="{{url('approval/qualification')}}">Qualifications @if(count($pen_quals) !=0) <span class="pull-right notify_orange_btn">{{count($pen_quals)}}</span> @endif</a> 

              <a class="collapse-item" href="{{url('approval/specialization')}}">Specializations @if(count($pen_specs) !=0) <span class="pull-right notify_orange_btn">{{count($pen_specs)}}</span> @endif</a>
            </div>
          </div>
        </li>
      @endrole
      <!-- Heading -->
     {{--  <div class="sidebar-heading">
        Interface
      </div>
 --}}
      <!-- Nav Item - Pages Collapse Menu -->
      {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fa fa-fw fa-cog"></i>
          <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <a class="collapse-item" href="buttons.html">Buttons</a>
            <a class="collapse-item" href="cards.html">Cards</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      
 --}}
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
     {{--  <div class="sidebar-heading">
        Addons
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fa fa-fw fa-folder"></i>
          <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Login Screens:</h6>
            <a class="collapse-item" href="login.html">Login</a>
            <a class="collapse-item" href="register.html">Register</a>
            <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Other Pages:</h6>
            <a class="collapse-item" href="404.html">404 Page</a>
            <a class="collapse-item" href="blank.html">Blank Page</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="charts.html">
          <i class="fa fa-fw fa-chart-area"></i>
          <span>Charts</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="tables.html">
          <i class="fa fa-fw fa-table"></i>
          <span>Tables</span></a>
      </li>
 --}}
      <!-- Divider -->
      {{-- <hr class="sidebar-divider d-none d-md-block"> --}}

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"><i class="fa fa-bars text-white"></i></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fa fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fa fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                @if(count(Auth::user()->unreadNotifications) !=0)
                  <span class="badge badge-danger badge-counter">{{count(Auth::user()->unreadNotifications)}}</span>
                @endif
              </a>
              <!-- Dropdown - Alerts -->
              @if(count(Auth::user()->unreadNotifications) !=0)
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated-grow-in" aria-labelledby="alertsDropdown" >
                  <h6 class="dropdown-header">
                    Alerts Center
                  </h6>
                  <div style="height: 250px; overflow-y: scroll;">
                  @foreach(Auth::user()->unreadNotifications as $notification)
                  <a class="dropdown-item d-flex align-items-center" href="{{route('notification_read',$notification['id'])}}">
                    <div class="mr-3">
                      <div class="icon-circle bg-primary">
                        <i class="fa fa-file text-white"></i>
                      </div>
                    </div>
                    <div>
                      <div class="small text-gray-500">{{$notification['created_at']->diffForHumans()}}</div>
                      <span class="font-weight-bold">{{$notification['data']['title']}}</span>
                      <br>
                      <span>{{$notification['data']['message']}}</span>
                    </div>
                  </a>
                  @endforeach
                  </div>
                  <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                </div>
                @endif
            </li>

            <!-- Nav Item - Messages -->
           {{--  <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter">7</span>
              </a> --}}
             {{--  <!-- Dropdown - Messages -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Message Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div class="font-weight-bold">
                    <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                    <div class="small text-gray-500">Emily Fowler · 58m</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
                    <div class="status-indicator"></div>
                  </div>
                  <div>
                    <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                    <div class="small text-gray-500">Jae Chun · 1d</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
                    <div class="status-indicator bg-warning"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                    <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                    <div class="small text-gray-500">Chicken the Dog · 2w</div>
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
              </div> --}}
            {{-- </li> --}}

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::user()->name}}</span>

                 @php
              $colors = ['tomato', 'pink','voilet','red','sienna', 'steelblue', 'tan', 'green', 'teal', 'slategreen','navy'];
            @endphp
       

                <span class="rounded-circle dot" style="color: {{ $colors[array_rand($colors)] }}">
                  @php
                    $words = explode(" ", auth()->user()->name);
                    $acronym = "";
                     foreach ($words as $w) {
                      $acronym .= $w[0];
                    }
                    echo $acronym;
                  @endphp
                </span>
              {{--   <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60"> --}}
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fa fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fa fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fa fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                       <i class="fa fa-sign-out fa-sm fa-fw mr-2 text-gray-400"></i>{{ __('Logout') }}
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
              </div>
            </li>

          </ul>

        </nav>

     