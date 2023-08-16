<?php
/** @var array $key_elements_impacts */
?>

<h3>4. @lang('imet-core::oecm_report.biodiversity_elements.title')</h3>
<table>
    <tr>
        <th>
            <b>@lang('imet-core::oecm_report.biodiversity_elements.key_conservation_element')</b>
        </th>
        <th>
            <b>@lang('imet-core::oecm_report.biodiversity_elements.effect_estimated_direct_users')</b>
        </th>
        <th>
            <b>@lang('imet-core::oecm_report.biodiversity_elements.effect_estimated_indirect_users')</b>
        </th>
        <th>
            <b>@lang('imet-core::oecm_report.biodiversity_elements.average')</b>
        </th>
        <th>
            <b>@lang('imet-core::oecm_report.biodiversity_elements.comments')</b>
        </th>
    </tr>
    @foreach($key_elements_impacts as $key => $elem)
        <tr>
            <td>
                {{ $elem['KeyElement'] }}
            </td>
            <td>
                {{ $elem['StatusSH'] }}
            </td>
            <td>
                {{ $elem['TrendSH'] }}
            </td>
            <td>
                {{ $elem['StatusER'] }}
            </td>
            <td>
                {{ $elem['TrendER'] }}
            </td>
        </tr>
    @endforeach
</table>
