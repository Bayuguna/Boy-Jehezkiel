@extends('layouts.auth_layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <form class="col-md-3 form-group" method="POST" action="{{ route('admin.submit') }}">
            @csrf
            <div class="text-center mb-4">
                <i class="fas fa-user" style="font-size: 72px;"></i>
            </div>
            <div class="mb-3">
                <label for="email">{{ __('E-Mail Address') }}</label>
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                @if ($errors->has('email'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="mb-2">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                @if ($errors->has('password'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <label class="mb-3">
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
            </label>

            <button type="submit" class="btn btn-primary btn-block">
                {{ __('Login') }}
            </button>

            <div class="text-center">
                <a style="font-size: 12px" class="btn btn-link" href="/admin/password/reset">
                    {{ __('Lupa password?') }}
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
