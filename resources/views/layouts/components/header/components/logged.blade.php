@if(!Auth::guest())

    <nav id="menu">

        <ul class="menu-header">
            <li>
                <a href="{{ url('/') }}/admin">{!! \App\Library\Utils\Template::icon('user-circle', '', '1.2em') !!}&nbsp;&nbsp;&nbsp;{{ Auth::user()->getName() }}</a>
                <ul>
                    <li><a href="{{ url('/') }}/admin/staff/{{ Auth::user()->getKey() }}/edit">{{ ucfirst(trans('layout.admin.profile')) }}</a></li>
                    <li><a href="{{ url('/') }}/admin/profile/">{{ ucfirst(trans('layout.admin.expert_cv')) }}</a></li>
                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="fa fa-sign-out-alt"
                                  style="font-size: 1.2em;"
                            ></span>&nbsp;&nbsp;&nbsp;{{ ucfirst(trans('auth.logout')) }}
                    </a></li>
                </ul>
            </li>
            <li>
                <a href="{{ url()->current() }}?lang=fr" class="selected">{!! \App\Library\Utils\Template::flag('fr', '') !!}</a>
            </li>
            <li>
                <a href="{{ url()->current() }}?lang=en">{!! \App\Library\Utils\Template::flag('en', '') !!}</a>
            </li>

        </ul>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>

    </nav>

@endif
