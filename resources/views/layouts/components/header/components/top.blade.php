<div id="top">

    {{-- Admin --}}
    <span id="admin">
        <a href="{{ url('/') }}/admin">
            <img class="lineal" src="{{ asset('images/icons/lineal/32/dark').'/' }}user.png" style="width: 24px;" />
        </a>
    </span>

    {{-- Language --}}
    <span id="language">
        <a href="{{ url()->current() }}?lang=fr"
           @if(\App::getLocale()==='fr') class="selected" @endif
        >Fr</a>
        <a href="{{ url()->current() }}?lang=en"
           @if(\App::getLocale()==='en') class="selected" @endif
        >En</a>
    </span>

</div>
