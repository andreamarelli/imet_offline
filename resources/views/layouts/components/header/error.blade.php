<header id="header" class="container-fluid">
    <div class="wrap">
        @if(app()->environment('imetoffline'))
            @include('admin.imet.offline.header')
        @else
            @include('layouts.components.header.components.logo')
        @endif
    </div>
</header>