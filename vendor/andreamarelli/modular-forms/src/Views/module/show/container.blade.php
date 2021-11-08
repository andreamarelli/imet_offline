<?php
/** @var \AndreaMarelli\ModularForms\Controllers\FormController $controller */
/** @var \AndreaMarelli\ModularForms\Models\Module $module_class */
/** @var int $form_id */
/** @var String $mode (show|print) */
/** @var \Illuminate\Database\Eloquent\Collection|null $collection (optional) */

$collection = $collection ?? $module_class::getModule($form_id);
$definitions = $module_class::getDefinitions($form_id);
$module_records = $module_class::getModuleRecords($form_id, $collection);
$records = $module_records['records'];
$mode = $mode ?? 'show';
$no_data = false;
$body_view = \AndreaMarelli\ModularForms\Helpers\ModuleKey::KeyToView($definitions['module_key'], 'show');

if($collection->isEmpty()){
    $no_data = true;
    $collection = collect([new $module_class()]);
}

?>

<div class="module-container" id="module_{{ $definitions['module_key'] }}">

    {{-- title --}}
    @include('modular-forms::module.title', compact('definitions'))

    {{-- info --}}
    @include('modular-forms::module.info', ['definitions' => $definitions])

    <div class="module-body">

        {{-- last update --}}
        @include('modular-forms::module.last_update', ['mode' => $mode, 'last_update' => $module_records['last_update']])

        {{-- not applicable / not available --}}
        @if(!$no_data && array_key_exists('not_applicable', $records[0]) && $records[0]['not_applicable'])
            <div class="no-data">
                @lang('modular-forms::common.form.not_applicable')
            </div>
        @elseif(!$no_data && array_key_exists('not_available', $records[0]) && $records[0]['not_available'])
            <div class="no-data">
                @lang('modular-forms::common.form.not_available')
            </div>
        @elseif($mode==='print' && $no_data)
            <div class="no-data">
                @lang('modular-forms::common.data_not_available')
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

</div>
