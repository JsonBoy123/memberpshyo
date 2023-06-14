<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Member Physiotherapy India</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
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
    <div class="row justify-content-center mt-5 mb-5">
        <div class="col-md-8 mb-4">
            {{-- <div class="card"> --}}
                {{-- <div class="card-header">{{ __('Register') }}</div> --}}

                {{-- <div class="card-body"> --}}
                    
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="member_type" class="col-md-4 col-form-label text-md-right">{{ __('Member Type') }} <span class="text-danger"><strong>*</strong></span></label>

                            <div class="col-md-6">
                                <select name="member_type" class="form-control" required="required">
                                    <option value="">Select Member Type</option>
                                    @foreach($roles as $role)

                                        <option value="{{$role->id}}" {{old('member_type') == $role->id ? 'selected' : ''}}>{{$role->display_name}}</option>
                                    @endforeach
                                </select>

                                @error('member_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                              <label for="status" class="col-md-4 col-form-label"></label>
                            <div class="col-md-6">
                              
                                <input type="radio" name="status" value="0" {{ old('status') == '0' ? 'checked="checked"' : (old('status') == '1' ? '' : 'checked="checked"' ) }}>
                                <label for="status" class="ml-2 mr-3">{{ __('New Member') }}</label>

                                <input type="radio" name="status" value='1' {{ old('status') == '1' ? 'checked="checked"' : '' }}>
                                <label for="status" class="ml-2" >{{ __('Old Member (Active)') }}</label>
                            </div>
                        </div>

                        <div class="form-group row iap_no_div" style="display: none;">
                            <label for="iap_no" class="col-md-4 col-form-label text-md-right">{{ __('IAP Number') }}<span class="text-danger"><strong>*</strong></span></label>

                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">L - </span>
                                  </div>
                                  <input id="iap_no" type="text" class="form-control iap_no_input @error('iap_no') is-invalid @enderror" name="iap_no" value="{{ old('iap_no') }}" placeholder="Enter Old IAP Number" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                </div>
                                @error('iap_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}<span class="text-danger"><strong>*</strong></span></label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus >

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="middle_name" class="col-md-4 col-form-label text-md-right">{{ __('Middle Name') }}</label>

                            <div class="col-md-6">
                                <input id="middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" value="{{ old('middle_name') }}" autocomplete="middle_name" autofocus>

                                @error('middle_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}<span class="text-danger"><strong>*</strong></span></label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}<span class="text-danger"><strong>*</strong></span></label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}<span class="text-danger"><strong>*</strong></span></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                      
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}<span class="text-danger"><strong>*</strong></span></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}<span class="text-danger"><strong>*</strong></span></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                                 {{-- <a href="{{ route('login') }}" class="btn btn-primary">Login</a> --}}
                            </div>
                        </div>
                    </form>
                {{-- </div> --}}
            {{-- </div> --}}
        </div>
    </div>
</div>
{{-- @endsection --}}

<script>
    $(document).ready(function(){

        $('input[name="status"]').on('change',function(e){
            e.preventDefault();
            var status = $(this).val();
            status_change(status);
        });
        var status = "{{old('status') !='' ? old('status') : ''}}";
        if(status != ''){
            status_change(status);
        }

        function status_change(status){
            if(status == '1'){
                $('.iap_no_input').attr('required','required');   
                $('.iap_no_div').show();
            }else{
                $('.iap_no_input').removeAttr('required');   
                $('.iap_no_div').hide();
            }
        }
    })
</script>
</body>
</html>

