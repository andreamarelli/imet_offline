@extends('layouts.admin')

@section('content')

    <div class="col-lg-8 col-lg-offset-2">

        <div class="jumbotron">

            <h2><i class="fa fa-exclamation-triangle"></i> {{ ucfirst(trans('auth.password_update_required')) }}</h2>
            <h4>{{ ucfirst(trans('auth.password_update_required_message')) }}</h4>
            <br />

            <form role="form" method="POST" action="{{ route('login_upgrade') }}">
                {{ csrf_field() }}

                <input type="hidden" class="field-edit" id="email" name="email" value="{{ $email }}">
                <input type="hidden" class="field-edit" id="prev_password" name="prev_password" value="{{ $prev_password }}">

                {{-- password --}}
                <div class="form-group row{{ $errors->has('password') ? 'has-error' : '' }}" >
                    <label for="password">{{ ucfirst(trans('auth.password')) }}</label>
                    <input id="password" type="password" class="field-edit" name="password" value="{{ old('password') }}" >
                </div>

                {{-- password --}}
                <div class="form-group row" >
                    <label for="password_confirmation">{{ ucfirst(trans('auth.password_confirmation')) }}</label>
                    <input id="password_confirmation" type="password" class="field-edit" name="password_confirmation" value="" >
                </div>

                @if ($errors->has('password'))
                    <div class="form-group row has-error">
                        <span class="help-block">
                            <strong>{!! $errors->first('password') !!}</strong>
                        </span>
                    </div>
                @endif

                <div class="form-group row">
                    {{-- register --}}
                    <button type="submit" class="btn-nav big rounded">
                        {{ ucfirst(trans('auth.password_update')) }}
                    </button>
                    {{-- cancel --}}
                    <button type="button" class="btn-nav big rounded" onclick="event.preventDefault(); $(location).attr('href', '/admin/');">
                        {{ ucfirst(trans('common.cancel')) }}
                    </button>
                </div>

            </form>

        </div>

        <div style="height: 200px;"></div>

    </div>

@endsection