<?php
    /** @var String $controller */
    /** @var \AndreaMarelli\ModularForms\Models\Module $module_class */
    /** @var int $form_id */

    $collection = $module_class::getModule($form_id);
    $definitions = $module_class::getDefinitions($form_id);
    $vue_data = $module_class::getVueData($form_id, $collection);

    $mode = 'edit';
    $controller = \Illuminate\Support\Str::startsWith($controller, 'App\Http') ? '\\'.$controller : $controller;
    $body_view = \AndreaMarelli\ModularForms\Helpers\ModuleKey::KeyToView($definitions['module_key']);

    if($collection->isEmpty()){
        $collection = collect([new $module_class()]);
    }

unset($module_class);
?>

<div class="module-container" id="module_{{ $definitions['module_key'] }}">

    {{-- title --}}
    @include('modular-forms::module.title', compact(['definitions']))

    {{-- info --}}
    @include('modular-forms::module.info', ['definitions' => $definitions])

    <div class="module-body">

        {{-- last update --}}
        @include('modular-forms::module.last_update', ['mode' => $mode])

        <form method="post" action="{{ action([$controller, $form_id!==null ? 'update' : 'store'], [$form_id]) }}">

            @if($form_id!==null)
                @method('PATCH')
            @endif

            {{-- crsf --}}
            @csrf

            {{-- preload / not applicable / not available --}}
            @include('modular-forms::module.actions', compact(['definitions']))

            <div class="module_body" v-show="!not_applicable && !not_available">

                {{-- ########################################################### --}}
                {{--    If a custom view does not exists use the standard one    --}}
                {{-- ########################################################### --}}
                @if(!view()->exists($body_view))
                    @include('modular-forms::module.edit.body', compact(['collection', 'vue_data', 'definitions']))
                    @include('modular-forms::module.edit.script', compact(['collection', 'vue_data', 'definitions']))
                @else
                    {{-- custom view --}}
                    @include($body_view, compact(['collection', 'vue_data', 'definitions']))
                @endif

            </div>

        </form>
    </div>

    {{-- save action bars --}}
    @include('modular-forms::module.save_bar')

</div>
