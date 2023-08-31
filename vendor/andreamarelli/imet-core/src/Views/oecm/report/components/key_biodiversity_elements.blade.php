<?php
/** @var array $key_elements_impacts */
?>

<h3>4. @lang('imet-core::oecm_report.biodiversity_elements.title')</h3>
<table>
    <tr>
        <th style="width:20%">
            <b>@lang('imet-core::oecm_report.biodiversity_elements.key_conservation_element')</b>
        </th>
        <th style="width:20%">
            <b>@lang('imet-core::oecm_report.biodiversity_elements.status_from_stakeholders')</b>
        </th>
        <th style="width:20%">
            <b>@lang('imet-core::oecm_report.biodiversity_elements.trend_from_stakeholders')</b>
        </th>
        <th style="width:20%">
            <b>@lang('imet-core::oecm_report.biodiversity_elements.status_from_external_source')</b>
        </th>
        <th style="width:20%">
            <b>@lang('imet-core::oecm_report.biodiversity_elements.trend_from_external_source')</b>
        </th>
    </tr>
    @foreach($key_elements_impacts as $key => $elem)
        <tr>
            <td style="width:20%">
                {{ $elem['KeyElement'] }}
            </td>
            <td style="width:20%">
                {{ $elem['StatusSH'] }}
            </td>
            <td style="width:20%">
                {{ $elem['TrendSH'] }}
            </td>
            <td style="width:20%">
                {{ $elem['StatusER'] }}
            </td>
            <td style="width:20%">
                {{ $elem['TrendER'] }}
            </td>
        </tr>
    @endforeach
</table>

<table>
    <tr>
        <th style="width:20%">
            <b>@lang('imet-core::oecm_report.biodiversity_elements.key_conservation_element')</b>
        </th>
        <th style="width:20%">
            <b>@lang('imet-core::oecm_report.biodiversity_elements.effect_estimated_direct_users')</b>
        </th>
        <th style="width:20%">
            <b>@lang('imet-core::oecm_report.biodiversity_elements.effect_estimated_indirect_users')</b>
        </th>
        <th style="width:20%">
            <b>@lang('imet-core::oecm_report.biodiversity_elements.average')</b>
        </th>
        <th style="width:20%">
            <b>@lang('imet-core::oecm_report.biodiversity_elements.comments')</b>
        </th>
    </tr>
    @foreach($key_elements_impacts as $key => $elem)
        <tr>
            <td style="width:20%">
                {{ $elem['KeyElement'] }}
            </td>
            <td style="width:20%">
                {{ $elem['EffectSH'] }}
            </td>
            <td style="width:20%">
                {{ $elem['EffectER'] }}
            </td>
            <td style="width:20%">
                {{ $elem['average'] }}
            </td>
            <td style="width:20%">
                {{ $elem['CommentsSH'] }}
            </td>
        </tr>
    @endforeach
</table>
