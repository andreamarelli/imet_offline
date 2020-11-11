<?php
/** @var \App\Http\Controllers\Components\FormController $controller */
/** @var \App\Models\Components\Module $module_class */
/** @var int $form_id */
/** @var String $mode (show|print) */
/** @var \Illuminate\Database\Eloquent\Collection|null $collection (optional) */

$collection = $collection ?? $module_class::getModule($form_id);
$definitions = $module_class::getDefinitions($form_id);
$module_records = $module_class::getModuleRecords($form_id, $collection);
$records = $module_records['records'];
$mode = $mode ?? 'show';
$no_data = false;
$body_view = \App\Models\Components\ModuleKey::KeyToView($definitions['module_key'], 'preview');

if($collection->isEmpty()){
    $no_data = true;
    $collection = collect([new $module_class()]);
}

?>

<div class="module-container" id="module_{{ $definitions['module_key'] }}">

    {{-- title --}}
    @include('admin.components.module.components.title', compact('definitions'))

    {{-- info --}}
    @include('admin.components.module.components.info', compact('definitions'))

    <div class="module-body">

        {{-- last update --}}
        @include('admin.components.module.components.last_update', ['mode' => $mode, 'last_update' => $module_records['last_update']])

        {{-- not applicable / not available --}}
        @if(!$no_data && array_key_exists('not_applicable', $records[0]) && $records[0]['not_applicable'])
            <div class="no-data">
                @lang('common.form.not_applicable')
            </div>
        @elseif(!$no_data && array_key_exists('not_available', $records[0]) && $records[0]['not_available'])
            <div class="no-data">
                @lang('common.form.not_available')
            </div>
        @elseif($mode==='print' && $no_data)
            <div class="no-data">
                @lang('common.data_not_available')
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

</div>
