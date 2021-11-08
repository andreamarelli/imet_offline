<?php
/** @var \AndreaMarelli\ImetCore\Models\Imet\v2\Imet $item */

// Force Language
if($item->language != \Illuminate\Support\Facades\App::getLocale()){
    \Illuminate\Support\Facades\App::setLocale($item->language);
}

?>

@extends('modular-forms::layouts._base')

@section('body')

    <style>
        .print_body{
            margin: 20px;
        }
        .entity-heading{
            margin-top: 20px;
        }

    </style>

    <div id="print_body" class="print_body">

        <a href="{{ action([\AndreaMarelli\ImetCore\Controllers\Imet\Controller::class, 'index']) }}" class="btn-nav rounded" style="margin-bottom: 20px;">@lang_u('modular-forms::common.go_back')</a>

        @component('layouts.components.title_ribbon')
                @lang('imet-core::common.imet')
        @endcomponent

        <div class="entity-heading">
            <div class="id">#{{ $item->getKey() }}</div>
            <div class="name">{{ $item->Name }}</div>
            <div class="location">{!! \AndreaMarelli\ImetCore\Helpers\Template::flag_and_name($item->Country) !!}</div>
        </div>


        {{-- management effectiveness --}}
        @include('imet-core::v2.evaluation.management_effectiveness.management_effectiveness', [
            'item_id' => $item->getKey(),
            'step' => 'management_effectiveness'
        ])

        {{--  Modules (context) --}}
        <h1>@lang_u('imet-core::common.context_long')</h1>
        <div class="imet_modules">
            @foreach($item::modules() as $step=>$modules_step)
                @foreach($modules_step as $i=>$module)
                    @include('modular-forms::module.show.container', [
                        'module_class' => $module,
                        'form_id' => $item->getKey()])
                @endforeach
            @endforeach
        </div>

        {{--  Modules (evaluation) --}}
        <h1>@lang_u('imet-core::common.evaluation_long')</h1>
        <div class="imet_modules">
            @foreach(\AndreaMarelli\ImetCore\Models\Imet\v2\Imet_Eval::modules() as $step=>$modules_step)
                @foreach($modules_step as $i=>$module)
                    @include('modular-forms::module.show.container', [
                        'module_class' => $module,
                        'form_id' => $item->getKey()])
                @endforeach
            @endforeach
        </div>

    </div>

    <script>
        window.onload = function () {
            setTimeout(function(){
                window.print();
            }, 2000);
        }
    </script>

@endsection
