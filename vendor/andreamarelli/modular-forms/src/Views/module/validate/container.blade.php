<?php
/** @var \AndreaMarelli\ModularForms\Controllers\FormController $controller */
/** @var \AndreaMarelli\ModularForms\Models\Module $module_class */
/** @var int $form_id */
/** @var boolean $only_show */


$collection = $module_class::getModule($form_id);
$definitions = $module_class::getDefinitions($form_id);
$module_records = $module_class::getModuleRecords($form_id, $collection);
$records = $module_records['records'];
$no_data = false;
$body_view = \AndreaMarelli\ModularForms\Helpers\ModuleKey::KeyToView($definitions['module_key'], 'show');

if($collection->isEmpty()){
    $no_data = true;
    $collection = collect([new $module_class()]);
}

$only_show = $only_show ?? false;

?>

<div class="module-container" id="module_{{ $definitions['module_key'] }}">

    {{-- title --}}
    @include('modular-forms::module.title', compact('definitions'))

    {{-- info --}}
    @include('modular-forms::module.info', ['definitions' => $definitions])

    <div class="module-body">

        {{-- last update --}}
        @include('modular-forms::module.last_update', ['mode' => 'show', 'last_update' => $module_records['last_update']])

        {{-- not applicable / not available --}}
        @if($module_records['records'][0]['not_applicable'])
            <div class="no-data">
                @lang('modular-forms::common.form.not_applicable')
            </div>
        @elseif($module_records['records'][0]['not_available'])
            <div class="no-data">
                @lang('modular-forms::common.form.not_available')
            </div>
        @elseif($no_data)
            <div class="no-data">
                @lang('modular-forms::common.form.nothing_to_validate')
            </div>
        @else

            {{-- ########################################################### --}}
            {{--    If a custom view does not exists use the standard one    --}}
            {{-- ########################################################### --}}
            @if(!view()->exists($body_view))
                @include('modular-forms::module.show.body', compact(['definitions', 'records']))
            @else
                @include($body_view, compact(['collection', 'definitions', 'records']))
            @endif

        @endif

    </div>

    {{-- bars: validation --}}
    @if($only_show)
        <div class="module-bar info-bar">
            <div class="message"></div>
            <div class="buttons">
                {!! \AndreaMarelli\ModularForms\Helpers\Template::icon('info-circle') !!}
                @lang('modular-forms::common.form.already_validated')
            </div>
        </div>
    @elseif(!$no_data)
        @include('modular-forms::module.validation_bar', [
            'controller' => $controller,
            'definitions' => $definitions,
            'validation' => $module_records['validation']
            ])
    @endif

</div>
