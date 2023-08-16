<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

?>
<h3>@lang('imet-core::oecm_context.Governance.governance')</h3>
@foreach($definitions['fields'] as $field)

    @if($field['name']==='GovernanceModel' || $field['name']==='SubGovernanceModel' || $field['name']==='AdditionalInfo')

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

            props:{
                SubGovernanceModel_SelectionList: {
                    type: Object,
                    default: () => {
                        return @json(\AndreaMarelli\ModularForms\Helpers\Input\SelectionList::getList('ImetOECM_SubGovernanceModel'))
                    }
                }
            },

            computed: {
                management_unique(){
                    return this.records[0]['ManagementUnique'];
                },
                SubGovernanceModel_options(){
                    return this.records[0]['GovernanceModel'] !== null && this.records[0]['GovernanceModel'] in this.SubGovernanceModel_SelectionList
                        ? JSON.stringify(this.SubGovernanceModel_SelectionList[this.records[0]['GovernanceModel']])
                        : JSON.stringify([]);
                }
            },

            methods:{

                recordChangedCallback(){
                    if(this.records[0]['GovernanceModel'] === null
                        || !(this.records[0]['GovernanceModel'] in this.SubGovernanceModel_SelectionList)
                        || !(this.records[0]['SubGovernanceModel'] in this.SubGovernanceModel_SelectionList[this.records[0]['GovernanceModel']])
                    ){
                        this.records[0]['SubGovernanceModel'] = null;
                    }
                },

                resetManagement(){
                    this.records[0]['ManagementName'] = null;
                    this.records[0]['ManagementType'] = null;
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

