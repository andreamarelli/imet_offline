<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vueData */

use AndreaMarelli\ModularForms\Helpers\Input\SelectionList;

$vueData['SubGovernanceModel_SelectionList'] = SelectionList::getList('ImetOECM_SubGovernanceModel');

?>
<h3>@lang('imet-core::oecm_context.Governance.governance')</h3>
@foreach($definitions['fields'] as $field)

    @if($field['name']==='GovernanceModel' || $field['name']==='SubGovernanceModel' || $field['name']==='AdditionalInfo')

        @component('modular-forms::module.components.field_container', [
                'name' => $field['name'],
                'label' => $field['label'] ?? '',
                'label_width' => 4
            ])

            @include('modular-forms::module.edit.field.module-to-vue', [
                'definitions' => $definitions,
                'field' => $field,
                'vue_record_index' => '0'
            ])
        @endcomponent

    @endif

@endforeach

<h3>@lang('imet-core::oecm_context.Governance.management')</h3>
@foreach($definitions['fields'] as $idx => $field)

    @if($idx>=3)

        @php
            $container_directives = '';
            $field_directives = '';
            if($field['name']!=='ManagementUnique'){
                $container_directives = "v-if='management_unique!==null'";
            } else {
                $field_directives = '@change=resetManagement';
            }
        @endphp

        @component('modular-forms::module.components.field_container', [
                'name' => $field['name'],
                'label' => $field['label'] ?? '',
                'label_width' => 5,
                'other_attributes' => $container_directives
            ])

            @include('modular-forms::module.edit.field.module-to-vue', [
                'definitions' => $definitions,
                'field' => $field,
                'vue_record_index' => '0',
                'vue_directives' => $field_directives
            ])
        @endcomponent

    @endif

@endforeach


@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.Oecm.context.Governance(@json($vueData)))
            .mount('#module_{{ $definitions['module_key'] }}');
    </script>
@endpush

