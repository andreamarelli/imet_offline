<?php
/** @var \Illuminate\Http\Request $request */
/** @var array $countries */
/** @var array $years */
/** @var boolean $show_filters */
/** @var boolean $no_filter_selected */
/** @var string $url */
?>

@component('admin.components.filters', ['url'=>$url, 'request'=>$request, 'method'=>'POST', 'expanded'=>$no_filter_selected])
    @slot('filter_content')

        {!! \App\Library\Ofac\Input\Input::label('search', trans('common.search')) !!}
        {!! \App\Library\Ofac\Input\Input::text('search', $request->input('search')) !!}

        {!! \App\Library\Ofac\Input\Input::label('country', trans('entities.common.country')) !!}
        {!! \App\Library\Ofac\Input\DropDown::simple('country', $request->input('country'), $countries) !!}

        {!! \App\Library\Ofac\Input\Input::label('year', trans('entities.common.year')) !!}
        {!! \App\Library\Ofac\Input\DropDown::simple('year', $request->input('year'), $years) !!}

    @endslot
@endcomponent