<?php
/** @var array $governance */
$official_recognition = "";
if($governance['OfficialRecognition']){
$official_recognition = $governance['OfficialRecognition'] === 1 ? trans('imet-core::common.yes') : trans('imet-core::common.no') ;
}

?>

<h4>1. @lang('imet-core::oecm_context.Governance.management') </h4>
<table>
    <tr>
        <td style="text-align: left;"><b>@lang('imet-core::oecm_context.Governance.fields.ManagementName')</b></td>
        <td>
            {{ $governance['ManagementName']}}
        </td>
    </tr>
    <tr>
        <td style="text-align: left;"><b>@lang('imet-core::oecm_context.Governance.fields.GovernanceModel')</b></td>
        <td>
            {{ $governance['GovernanceModel']!==null ? trans('imet-core::oecm_lists.GovernanceModel.'.$governance['GovernanceModel']) : '' }}
        </td>
    </tr>
    <tr>
        <td style="text-align: left;"><b>@lang('imet-core::oecm_context.Governance.fields.AdditionalInfo')</b></td>
        <td>{{ $governance['AdditionalInfo'] }}</td>
    </tr>
    <tr>
        <td style="text-align: left;"><b>@lang('imet-core::oecm_context.Governance.fields.ManagementUnique')</b></td>
        <td>
            {{ $governance['ManagementUnique']!==null ? trans('imet-core::oecm_lists.ManagementUnique.'.$governance['ManagementUnique']) : '' }}
        </td>
    </tr>
    <tr>
        <td style="text-align: left;"><b>@lang('imet-core::oecm_context.Governance.fields.ManagementType')</b></td>
        <td>
            {{ $governance['ManagementType']!==null ? trans('imet-core::oecm_lists.ManagementType.'.$governance['ManagementType']) : '' }}
        </td>
    </tr>
    <tr>
        <td style="text-align: left;"><b>@lang('imet-core::oecm_context.Governance.fields.DateOfCreation')</b></td>
        <td>
            @if($governance['DateOfCreation']!==null)
               @if(array_key_exists($governance['DateOfCreation'], \AndreaMarelli\ModularForms\Helpers\Input\SelectionList::getList('ImetOECM_DateOfCreation')))
                   @lang('imet-core::oecm_lists.DateOfCreation.'.$governance['DateOfCreation'])
               @else
                   {{ $governance['DateOfCreation'] }}
               @endif
            @endif
        </td>
    </tr>
    <tr>
        <td style="text-align: left;"><b>@lang('imet-core::oecm_context.Governance.fields.OfficialRecognition')</b></td>
        <td>{{ $official_recognition }}</td>
    </tr>
    <tr>
        <td style="text-align: left;"><b>@lang('imet-core::oecm_context.Governance.fields.SupervisoryInstitution')</b></td>
        <td>{{ $governance['SupervisoryInstitution'] }}</td>
    </tr>

</table>
