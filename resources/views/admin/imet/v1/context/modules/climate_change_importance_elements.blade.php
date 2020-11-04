<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

$labels = trans('form/imet/v1/context.ClimateChangeImportanceElements.Element');
foreach ($vue_data['records'] as $index=>$record){
    $vue_data['records'][$index]['Element'] = $labels[$index];
}

?>

@include('admin.components.module.edit.body', compact(['collection', 'vue_data', 'definitions']))

@push('scripts')
<script>
    // ## Initialize Module controller ##
    let module_{{ $definitions['module_key'] }} = new ModuleController({
        el: '#module_{{ $definitions['module_key'] }}',
        data: JSON.parse('{!! App\Library\Utils\Type\JSON::toVue($vue_data) !!}'),

        mounted: function () {
            let field = 'Element';
            let input = $(this.container).find("[id$=_"+field+"]");
            input.attr('readonly', 'readonly');
            input.addClass('field-disabled');
        }

    });
</script>
@endpush