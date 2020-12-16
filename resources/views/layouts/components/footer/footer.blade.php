<footer>

    {{-- IMET OFFLINE --}}
    @if(is_imet_environment())
        @include('admin.imet.offline.footer')

    {{-- homepage --}}
    @elseif(Route::getCurrentRequest() && Route::getCurrentRequest()->is('/'))
        @include('layouts.components.footer.components.pa')
        @include('layouts.components.footer.components.press')
        @include('layouts.components.footer.components.creative_commons')

    {{-- website pages --}}
    @else
        @include('layouts.components.footer.components.creative_commons')
    @endif

</footer>
