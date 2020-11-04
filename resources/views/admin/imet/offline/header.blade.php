<div id="logo" >
    <h1>IMET Offline Tool</h1>
</div>

@if(!Auth::guest())

    <nav id="menu">

        <ul>
            <li>
                <a>{!! \App\Library\Utils\Template::icon('user-circle', '', '1.2em') !!}&nbsp;{{ Auth::user()->getName() }}</a>
            </li>
            <li>
                <a href="{{ url('admin/imet') }}">{!! \App\Library\Utils\Template::icon('home', '') !!}</a>
            </li>
            <li>
                <a href="{{ url()->current() }}?lang=fr" class="selected">{!! \App\Library\Utils\Template::flag('fr', '') !!}</a>
            </li>
            <li>
                <a href="{{ url()->current() }}?lang=en">{!! \App\Library\Utils\Template::flag('en', '') !!}</a>
            </li>
        </ul>

    </nav>

@endif