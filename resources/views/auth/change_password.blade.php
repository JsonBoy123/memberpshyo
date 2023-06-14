@extends('dashboard.layouts.membermaster')
@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-md-4 m-auto ">
           <h4>Change Password</h4>
        </div>
    </div>
    <div class="row justify-content-center mt-5">
        
        <div class="col-md-8">
            {{-- <div class="card"> --}}
                {{-- <div class="card-header">{{ __('Login') }}</div> --}}

                {{-- <div class="card-body"> --}}
                    @if($message = Session::get('success'))
                        <div class="alert alert-success">
                            {{$message}}
                        </div>
                    @endif
                    @if($message = Session::get('warning'))
                        <div class="alert alert-warning">
                            {{$message}}
                        </div>
                    @endif
                    <form method="POST" action="{{url('change_password_form')}}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">New password</label>

                            <div class="col-md-6">
                                <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" value="{{ old('new_password') }}"  autofocus>

                                @error('new_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Confirm new password</label>

                            <div class="col-md-6">
                                <input id="new_confirm_password" type="password" class="form-control @error('new_confirm_password') is-invalid @enderror" name="new_confirm_password" value="{{ old('new_confirm_password') }}" required autofocus>

                                @error('new_confirm_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('submit') }}
                                </button>                                
                            </div>
                        </div>
                    </form>
                {{-- </div> --}}
            {{-- </div> --}}
        </div>
    </div>
</div>
@endsection