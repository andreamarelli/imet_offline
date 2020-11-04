<?php
/** @var \App\Http\Controllers\Components\FormController $controller */
/** @var \App\Models\Components\Module $module_class */
/** @var int $form_id */
/** @var boolean $only_show */


$collection = $module_class::getModule($form_id);
$definitions = $module_class::getDefinitions($form_id);
$module_records = $module_class::getModuleRecords($form_id, $collection);
$records = $module_records['records'];
$no_data = false;
$body_view = \App\Models\Components\ModuleKey::KeyToView($definitions['module_key'], 'preview');

if($collection->isEmpty()){
    $no_data = true;
    $collection = collect([new $module_class()]);
}

$only_show = $only_show ?? false;

?>

<div class="module-container" id="module_{{ $definitions['module_key'] }}">

    {{-- title --}}
    @include('admin.components.module.components.title', compact('definitions'))

    {{-- info --}}
    @include('admin.components.module.components.info', compact('definitions'))

    <div class="module-body">

        {{-- last update --}}
        @include('admin.components.module.components.last_update', ['mode' => 'show', 'last_update' => $module_records['last_update']])

        {{-- not applicable / not available --}}
        @if($module_records['records'][0]['not_applicable'])
            <div class="no-data">
                @lang('common.form.not_applicable')
            </div>
        @elseif($module_records['records'][0]['not_available'])
            <div class="no-data">
                @lang('common.form.not_available')
            </div>
        @elseif($no_data)
            <div class="no-data">
                @lang('form/national_indicators/common.nothing_to_validate'
            </div>
        @else

            {{-- ########################################################### --}}
            {{--    If a custom view does not exists use the standard one    --}}
            {{-- ########################################################### --}}
            @if(!view()->exists($body_view))
                @include('admin.components.module.preview.body', compact(['definitions', 'records']))
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
                {!! \App\Library\Utils\Template::icon('info-circle') !!}
                @lang('form/national_indicators/common.already_validated')
            </div>
        </div>
    @elseif(!$no_data)
        @include('admin.components.module.components.bar_validation', [
            'controller' => $controller,
            'definitions' => $definitions,
            'validation' => $module_records['validation']
            ])
    @endif

</div>