<?php
/** @var \Illuminate\Http\Request $request */
/** @var string $url */
/** @var boolean $filter_selected */
/** @var array $countries */
/** @var array $years */
?>

@component('modular-forms::page.filters-accordion', ['url'=>$url, 'request'=>$request, 'method'=>'POST', 'expanded'=>$filter_selected])
    @slot('filter_content')

        {!! \AndreaMarelli\ModularForms\Helpers\Input\Input::label('search', trans('modular-forms::common.search')) !!}
        {!! \AndreaMarelli\ModularForms\Helpers\Input\Input::text('search', $request->input('search')) !!}

        {!! \AndreaMarelli\ModularForms\Helpers\Input\Input::label('country', trans('imet-core::common.country')) !!}
        {!! \AndreaMarelli\ModularForms\Helpers\Input\DropDown::simple('country', $request->input('country'), $countries) !!}

        {!! \AndreaMarelli\ModularForms\Helpers\Input\Input::label('year', trans('imet-core::common.year')) !!}
        {!! \AndreaMarelli\ModularForms\Helpers\Input\DropDown::simple('year', $request->input('year'), $years) !!}

    @endslot
@endcomponent
