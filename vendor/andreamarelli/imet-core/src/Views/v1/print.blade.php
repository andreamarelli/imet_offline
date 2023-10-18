<?php
/** @var \AndreaMarelli\ImetCore\Models\Imet\v1\Imet $item */

use AndreaMarelli\ImetCore\Models\User\Role;

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

        <a href="{{ route('imet-core::index') }}" class="btn-nav rounded" style="margin-bottom: 20px;">@uclang('modular-forms::common.go_back')</a>

        <h2>
            @lang('imet-core::common.imet_short'): @lang('imet-core::common.imet')
        </h2>

        <div class="entity-heading">
            <div class="id">#{{ $item->getKey() }}</div>
            <div class="name">{{ $item->Name }}</div>
            <div class="location">{!! \AndreaMarelli\ImetCore\Helpers\Template::flag_and_name($item->Country) !!}</div>
        </div>


        {{-- management effectiveness --}}
        @include('imet-core::v1.evaluation.management_effectiveness.management_effectiveness', [
            'item_id' => $item->getKey(),
            'step' => 'management_effectiveness'
        ])

        {{--  Modules (context) --}}
        <h1>@uclang('imet-core::common.context_long')</h1>
        <div class="imet_modules">
            @foreach($item::modules() as $step=>$modules_step)
                @foreach($modules_step as $i=>$module)
                    @if(Role::hasRequiredAccessLevel($module))
                        @include('modular-forms::module.show.container', [
                            'module_class' => $module,
                            'form_id' => $item->getKey()])
                    @else
                        @include('imet-core::components.module.not_allowed_container', ['module_class' => $module])
                    @endif
                @endforeach
            @endforeach
        </div>

        {{--  Modules (evaluation) --}}
        <h1>@uclang('imet-core::common.evaluation_long')</h1>
        <div class="imet_modules">
            @foreach(\AndreaMarelli\ImetCore\Models\Imet\v1\Imet_Eval::modules() as $step=>$modules_step)
                @foreach($modules_step as $i=>$module)
                    @if(Role::hasRequiredAccessLevel($module))
                        @include('modular-forms::module.show.container', [
                            'module_class' => $module,
                            'form_id' => $item->getKey()])
                    @else
                        @include('imet-core::components.module.not_allowed_container', ['module_class' => $module])
                    @endif
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
