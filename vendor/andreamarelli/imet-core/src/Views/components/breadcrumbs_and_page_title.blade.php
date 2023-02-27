@if(!is_imet_environment())

    {{-- website breadcrums --}}
    @section('admin_breadcrumbs')
        @include('modular-forms::page.breadcrumbs', ['links' => [
            route('imet-core::index') => trans('imet-core::common.imet_short')
        ]])
    @endsection

    {{-- page title (ribbon) --}}
    @section('admin_page_title')
        @lang('imet-core::common.imet')
    @endsection

@endif
