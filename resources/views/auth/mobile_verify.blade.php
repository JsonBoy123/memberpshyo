{{-- @extends('layouts.app') --}}
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Member Physiotherapy India</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>


{{-- @section('content') --}} 
<div class="container">
        <div class="row mt-5">
        <div class="col-md-4 m-auto ">
            <img src="{{asset('images/physio.png')}}" style="width: 100%;">
        </div>
    </div>
    <div class="row justify-content-center mt-5">
    {{-- <div class="row justify-content-center "> --}}
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Please Verify Code') }}</div>

                <div class="card-body">
                    @if($message = Session::get('warning'))
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                    @endif

                    @if($message = Session::get('success'))
                        <div class="alert alert-success">
                            {{$message}}
                        </div>
                    @endif
                    <div class="alert alert-success" style="display: none;">
                        {{$message}}
                    </div>

                    <form class="d-inline" method="POST" action="{{route('verify')}}">
                        @csrf
                    <div class="form-group row">
                        <label for="code" class="col-md-4 col-form-label text-md-right">{{ __('Verification Code') }}</label>

                        <div class="col-md-6">
                            <input id="code" type="code" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" required autocomplete="code">
                            <button type="submit" class="btn btn-sm btn-primary mt-2">{{ __('Verify') }}</button>

                        </div>
                    </div>
                    
                    </form>
                </div>
                <div class="card-footer">
                    <a href="javascript:void(0)" id="resend" onclick="resendLogin()">Resend Code</a>
                    <input type="hidden" name="phone" value="{{request()->get('phone')}}">
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    
       function resendLogin(){
            var phone = $('input[name="phone"]').val();

            $.ajax({
                type:'GET',
                url:'{{route('resendVerifyCode')}}?phone='+phone,
                success:function(res){   
                    if(res == "success"){
                        $('.alert-success').show().empty().html('We Sent Activation code again. Check Your mobile.');
                    }else{
                        
                    }
                    
                }
            });
   
        }
</script>
{{-- @endsection --}}
</body>
</html>
