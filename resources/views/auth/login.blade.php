
@extends('layouts.admin')

@section('content')


    <div class="jumbotron text-center" style="width: 550px; margin: 0 auto;">

        <h1>{{ ucfirst(trans('auth.login')) }}</h1>

        <form role="form" method="POST" action="{{ route('login') }}" style="width: 450px">
            {{ csrf_field() }}

            {{-- email (username) --}}
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}" >
                <label for="email">{{ ucfirst(trans('entities.common.email')) }}</label>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                <input id="email" type="email" class="field-edit" name="email" value="{{ old('email') }}" autofocus>
            </div>

            {{-- password --}}
            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}" >
                <label for="password">{{ ucfirst(trans('auth.password')) }}</label>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
                <input id="password" type="password" class="field-edit" name="password">
            </div>

            @if(App::environment('production'))
                {{-- CAPTCHA --}}
                <div class="form-group {{ $errors->has('g-recaptcha-response') ? 'has-error' : '' }}" >
                    <p>
                        {!! NoCaptcha::display() !!}
                    </p>
                    @if ($errors->has('g-recaptcha-response'))
                        <span class="help-block">
                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                        </span>
                    @endif
                </div>
            @endif

            {{-- remember --}}
            <br />
            <div class="form-group">
                <span class="checkbox">
                    <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">
                        {{ ucfirst(trans('auth.stay_connected')) }}
                    </label>
                </span>
            </div>

            <div class="form-group">
                {{-- login --}}
                <button type="submit" class="btn-nav big rounded">
                    {{ ucfirst(trans('auth.login')) }}
                </button>
                {{-- forgot ? --}}
                {{--<a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ ucfirst(trans('auth.forgot_password')) }}
                </a>--}}
                {{-- register --}}
                <a class="btn btn-link" href="{{ route('register') }}">
                    Register
                </a>
            </div>

        </form>

    </div>

    <div style="height: 200px;"></div>


@endsection
