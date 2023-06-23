<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

?>
<h3>@lang('imet-core::oecm_context.Governance.governance')</h3>
@foreach($definitions['fields'] as  $idx => $field)

    @if($field['name']==='GovernanceModel' || $field['name']==='SubGovernanceModel' || $field['name']==='AdditionalInfo')

        @component('modular-forms::module.field_container', [
                'name' => $field['name'],
                'label' => $field['label'] ?? '',
                'label_width' => 4
            ])
            @include('modular-forms::module.show.field', [
                'type' => $field['type'],
                'value' => $records[0][$field['name']]
           ])
        @endcomponent

    @endif

@endforeach

<h3>@lang('imet-core::oecm_context.Governance.management')</h3>
@foreach($definitions['fields'] as  $idx => $field)

    @if($idx>=2)

        @if($field['name']==='ManagementUnique'
           || ( $records[0]['ManagementUnique']==='unique' && ($field['name']==='ManagementName' || $field['name']==='ManagementType'))
           || ( $records[0]['ManagementUnique']==='multiple' && $field['name']==='ManagementList')
           || ( $records[0]['ManagementUnique']!==null && ($field['name']==='DateOfCreation' || $field['name']==='OfficialRecognition' || $field['name']==='SupervisoryInstitution'))
           )

            @component('modular-forms::module.field_container', [
                    'name' => $field['name'],
                    'label' => $field['label'] ?? '',
                    'label_width' => 5
                ])
                @include('modular-forms::module.show.field', [
                    'type' => $field['type'],
                    'value' => $records[0][$field['name']]
               ])
            @endcomponent

        @endif

    @endif

@endforeach
