@extends('layouts.app_auth')

@section('title','Set New Password')

@section('content')
    <div class="d-flex align-items-center justify-content-center bg-br-primary ht-100v">

        <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white rounded shadow-base">
            <div class="signin-logo tx-center tx-28 tx-bold tx-inverse">{{ config('app.name') }}</div>
            <div class="tx-center mg-b-50">Set New Password</div>
            @include('includes/messages')
            <form class="form-horizontal" action="{!! route('save_user_invitation_link') !!}" method="POST">
                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                    <input type="email" name="email"
                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                           placeholder="Enter your email"
                           value="{{ $email or old('email') }}"
                           required_ autofocus>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div><!-- form-group -->
                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                    <input type="password" name="password"
                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                           placeholder="Enter password" required>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div><!-- form-group -->

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-danger' : '' }}">
                    <input type="password" name="password_confirmation"
                           class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                           placeholder="Confirm Password" required>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>

                <button type="submit" class="btn btn-info btn-block">Confirm</button>

            </form>
        </div><!-- login-wrapper -->
    </div><!-- d-flex -->
@endsection
