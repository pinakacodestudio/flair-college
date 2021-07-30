@extends('layouts.app_auth')

@section('title', 'Login')

@section('content')
    <div class="d-flex align-items-center justify-content-center bg-br-primary ht-100v">

        <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white rounded shadow-base">
            <div class="signin-logo tx-center tx-28 tx-bold tx-inverse">{{ config('app.name') }}</div>
            <div class="tx-center mg-b-50">Login here</div>
            @include('includes/messages')
            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                    <input type="email" name="email"
                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                           placeholder="Enter your email" required_
                           autofocus>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div><!-- form-group -->
                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                    <input type="password" name="password"
                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                           placeholder="Enter password" required_>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif

                </div><!-- form-group -->

                <label class="ckbox">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember',1) ? 'checked' : '' }}><span>Remember Me</span>
                </label>

                <a href="#" class="tx-info tx-12 d-block mg-t-10 mg-b-10">Forgot password?</a>

                {{--<a href="{!! route('dashboard') !!}" class="btn btn-info btn-block">Sign In</a>--}}
                <button type="submit" class="btn btn-info btn-block">Sign In</button>

                {{--<div class="mg-t-60 tx-center">Not yet a member? <a href="#" class="tx-info">Sign Up</a></div>--}}
            </form>
        </div><!-- login-wrapper -->
    </div><!-- d-flex -->

@endsection
