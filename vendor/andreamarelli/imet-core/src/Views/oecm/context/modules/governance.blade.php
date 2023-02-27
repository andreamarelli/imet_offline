<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

?>
<h3>@lang('imet-core::oecm_context.Governance.governance')</h3>
@foreach($definitions['fields'] as $field)

    @if($field['name']==='GovernanceModel' || $field['name']==='AdditionalInfo')

        @component('modular-forms::module.field_container', [
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

    @if($idx>=2)

        @php
            $container_directives = '';
            $field_directives = '';
            if($field['name']!=='ManagementUnique'){
                if($field['name']==='ManagementName' || $field['name']==='ManagementType'){
                    $container_directives = "v-if='management_unique==\"unique\"'";
                } elseif($field['name']==='ManagementList'){
                    $container_directives = "v-if='management_unique==\"multiple\"'";
                } else {
                    $container_directives = "v-if='management_unique!==null'";
                }
            } else {
                $field_directives = '@change=resetManagement';
            }
        @endphp

        @component('modular-forms::module.field_container', [
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
    <script>
        // ## Initialize Module controller ##
        let module_{{ $definitions['module_key'] }} = new window.ModularForms.ModuleController({
            el: '#module_{{ $definitions['module_key'] }}',
            data: @json($vue_data),

            computed: {
                management_unique(){
                    return this.records[0]['ManagementUnique'];
                }
            },

            methods:{
                resetManagement(){
                    this.records[0]['ManagementName'] = null;
                    this.records[0]['ManagementType'] = null;
                    this.records[0]['ManagementList'] = null;
                    if(this.management_unique === null){
                        this.records[0]['DateOfCreation'] = null;
                        this.records[0]['OfficialRecognition'] = null;
                        this.records[0]['SupervisoryInstitution'] = null;
                    }
                }
            }

        });
    </script>
@endpush

