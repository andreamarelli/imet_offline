<?php
/** @var Mixed $definitions */
$vue_record_index = $definitions['module_type']==="ACCORDION" || $definitions['module_type']==="GROUP_ACCORDION"
    ? 'index' : '0';

?>

@component('admin.components.module.components.row', [
                    'name' => $definitions['fields'][0]['name'],
                    'label' => $definitions['fields'][0]['label'],
                    'label_width' => $definitions['label_width']
                ])

    {{-- input field --}}
    @include('admin.components.module.edit.field.auto_vue', [
        'definitions' => $definitions,
        'field' => $definitions['fields'][0],
        'vue_record_index' => $vue_record_index,
    ])

@endcomponent


<div id="management_plan_exists" v-show=plan_exists>

    @foreach($definitions['fields'] as $index=>$field)

        @if($index>0)

            @component('admin.components.module.components.row', [
                    'name' => $field['name'],
                    'label' => $field['label'] ?? '',
                    'label_width' => $definitions['label_width']
                ])

                {{-- input field --}}
                @include('admin.components.module.edit.field.auto_vue', [
                    'definitions' => $definitions,
                    'field' => $field,
                    'vue_record_index' => $vue_record_index
                ])

            @endcomponent

        @endif

    @endforeach
</div>

@push('scripts')
    <script>
        // ## Initialize Module controller ##
        let module_{{ $definitions['module_key'] }} = new ModuleController({
            el: '#module_{{ $definitions['module_key'] }}',
            data: JSON.parse('{!! App\Library\Utils\Type\JSON::toVue($vue_data) !!}'),

            computed: {
                plan_exists(){
                    let exists = this.records[0]['PlanExistence'];
                    return (exists==="true" || exists===true);
                }
            }

        });
    </script>
@endpush
