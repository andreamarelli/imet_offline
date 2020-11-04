
@extends('layouts.admin')

@section('content')

    <div class="col-lg-8 col-lg-offset-2">

        <div class="jumbotron">

            <h1>{{ ucfirst(trans('auth.register')) }}</h1>

            <form role="form" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                {{-- First name --}}
                <div class="form-group row {{ $errors->has('first_name') ? 'has-error' : '' }}" >
                    <label for="first_name">{{ ucfirst(trans('entities.common.first_name')) }}</label>
                    @if ($errors->has('first_name'))
                        <span class="help-block">
                        <strong>{{ $errors->first('first_name') }}</strong>
                    </span>
                    @endif
                    <input id="first_name" type="text" class="field-edit" name="first_name" value="{{ old('first_name') }}" autofocus>
                </div>

                {{-- Last name --}}
                <div class="form-group row {{ $errors->has('last_name') ? 'has-error' : '' }}" >
                    <label for="last_name">{{ ucfirst(trans('entities.common.last_name')) }}</label>
                    @if ($errors->has('last_name'))
                        <span class="help-block">
                        <strong>{{ $errors->first('last_name') }}</strong>
                    </span>
                    @endif
                    <input id="last_name" type="text" class="field-edit" name="last_name" value="{{ old('last_name') }}" >
                </div>

                {{-- Country --}}
                <div class="form-group row {{ $errors->has('country') ? 'has-error' : '' }}" >
                    <label for="country">{{ ucfirst(trans('entities.common.country')) }}</label>
                    @if ($errors->has('country'))
                        <span class="help-block">
                        <strong>{{ $errors->first('country') }}</strong>
                    </span>
                    @endif
                    {!! \App\Library\Ofac\Input\DropDownVue::simple('country', old('country'), 'Country', 'data-width="100%"') !!}
                </div>


                {{-- email (username) --}}
                <div class="form-group row {{ $errors->has('email') ? 'has-error' : '' }}" >
                    <label for="email">{{ ucfirst(trans('entities.common.email')) }}</label>
                    @if ($errors->has('email'))
                        <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                    <input id="email" type="email" class="field-edit" name="email" value="{{ old('email') }}" >
                </div>

                {{-- password --}}
                <div class="form-group row {{ $errors->has('password') ? 'has-error' : '' }}" >
                    <label for="password">{{ ucfirst(trans('auth.password')) }}</label>
                    <input id="password" type="password" class="field-edit" name="password" value="{{ old('password') }}" >
                </div>

                {{-- password --}}
                <div class="form-group row" >
                    <label for="password_confirmation">{{ ucfirst(trans('auth.password_confirmation')) }}</label>
                    <input id="password_confirmation" type="password" class="field-edit" name="password_confirmation" value="{{ old('password') }}" >
                </div>

                @if ($errors->has('password'))
                    <div class="form-group row has-error">
                        <span class="help-block">
                            <strong>{!! $errors->first('password') !!}</strong>
                        </span>
                    </div>
                @endif

                @if(App::environment('production'))
                    {{-- CAPTCHA --}}
                    <div class="form-group row {{ $errors->has('g-recaptcha-response') ? 'has-error' : '' }}" >
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

                <div class="form-group row" style="font-size: 1em;">
                    <br />
                    <h4><strong>Licence d'Utilisation</strong></h4>
                    <a target="_blank" href="http://creativecommons.org/licenses/by-nc-sa/4.0/deed.fr" style="border: 0px;">
                        <img id="logo_licenceCC" src="images/by-nc-sa.png" style="float:right; margin-left: 10px; padding: 0px;">
                    </a>
                    Toutes les données qui seront transmises à l'Observatoire des Forêts d'Afrique Centrale sont soumises aux conditions de la licence
                    «<strong><a target="_blank" href="http://creativecommons.org/licenses/by-nc-sa/4.0/deed.fr">Creative Commons by-nc-sa</a></strong>».
                    En résumé, cette licence spécifie que:<br /><br />
                    <strong>Vous accorder à l'OFAC le droit:</strong>
                    <ul>
                        <li>de reproduire, distribuer et communiquer cette création au public</li>
                        <li>de modifier cette création</li>
                    </ul>
                    <strong>Selon les conditions suivantes:</strong>
                    <ul>
                        <li>
                            <strong>Paternité</strong> - L'OFAC doit  citer le nom de l'auteur original de la manière indiquée par l'auteur de l'œuvre ou le titulaire des droits qui vous confère cette
                            autorisation (Veuillez éviter toutes mentions qui suggéreraient qu'ils vous soutiennent ou approuvent votre utilisation de l'œuvre).</li>
                        <li>
                            <strong>Pas d'Utilisation Commerciale</strong> - L'OFAC n'a pas le droit d'utiliser cette création à des fins commerciales.
                        </li>
                        <li>
                            <strong>Partage des Conditions Initiales à l'identique</strong> - Si l'OFAC modifie, transforme ou adapte cette création, il n'a  le droit de distribuer la création qui en résulte
                            que sous un contrat identique à celui-ci.
                        </li>
                    </ul>
                </div>



                <div class="form-group row">
                    {{-- register --}}
                    <button type="submit" class="btn-nav big rounded">
                        {{ ucfirst(trans('auth.register')) }}
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