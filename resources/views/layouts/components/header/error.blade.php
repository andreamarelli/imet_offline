<header id="header" class="container-fluid">
    <div class="wrap">
        @if(is_imet_environment())
            @include('admin.imet.offline.header')
        @else
            @include('layouts.components.header.components.logo')
        @endif
    </div>
</header>
