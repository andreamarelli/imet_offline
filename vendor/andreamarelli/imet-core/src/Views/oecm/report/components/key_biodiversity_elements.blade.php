<?php
/** @var array $key_elements_impacts */
?>

<h3>4. @lang('imet-core::oecm_report.biodiversity_elements.title')</h3>
<div class="row mb-5">
    <div class="col">

        <div>
            @foreach($key_elements['chart']['values'] as $threat_key => $threat_label)
                <div class="histogram-row">
                    <div class="histogram-row__title text-left">{{ $threat_key }}</div>
                    <div class="histogram-row__value text-right" style="margin-right: 20px;">
                        <b v-html="'{{ $threat_label }}' || '-'"></b>
                    </div>
                    <div class="histogram-row__progress-bar"  v-if="'{{ $threat_label }}'!=='-'">
                        <div class="histogram-row__progress-bar__limit-left">-100%</div>
                        <div class="histogram-row__progress-bar__bar">
                            <div class="progress">
                                <div role="progressbar"
                                     class="progress-bar progress-bar-striped  progress-bar-negative"
                                     :style="'width: ' + Math.abs('{{ $threat_label }}') + '%; background-color: #87c89b !important;'">
                                    <span v-html="'{{ $threat_label }}'"></span>
                                </div>
                            </div>
                        </div>
                        <div class="histogram-row__progress-bar__limit-right">0%</div>
                    </div>
                </div>

            @endforeach

        </div>
        {{--                <imet_bar_chart--}}
        {{--                    :values="{{$main_threats['chart']['values'] }}"--}}
        {{--                    :fields="{{$main_threats['chart']['fields'] }}"--}}
        {{--                    :colors="{{$main_threats['chart']['colors'] }}"--}}
        {{--                    :axis_dimensions_y="{max:0,min:-100}"--}}
        {{--                ></imet_bar_chart>--}}
    </div>
</div>
{{--<table>--}}
{{--    <tr>--}}
{{--        <th style="width:20%">--}}
{{--            <b>@lang('imet-core::oecm_report.biodiversity_elements.key_conservation_element')</b>--}}
{{--        </th>--}}
{{--        <th style="width:20%">--}}
{{--            <b>@lang('imet-core::oecm_report.biodiversity_elements.status_from_stakeholders')</b>--}}
{{--        </th>--}}
{{--        <th style="width:20%">--}}
{{--            <b>@lang('imet-core::oecm_report.biodiversity_elements.trend_from_stakeholders')</b>--}}
{{--        </th>--}}
{{--        <th style="width:20%">--}}
{{--            <b>@lang('imet-core::oecm_report.biodiversity_elements.status_from_external_source')</b>--}}
{{--        </th>--}}
{{--        <th style="width:20%">--}}
{{--            <b>@lang('imet-core::oecm_report.biodiversity_elements.trend_from_external_source')</b>--}}
{{--        </th>--}}
{{--    </tr>--}}
{{--    @foreach($key_elements_impacts as $key => $elem)--}}
{{--        <tr>--}}
{{--            <td style="width:20%">--}}
{{--                {{ $elem['KeyElement'] }}--}}
{{--            </td>--}}
{{--            <td style="width:20%">--}}
{{--                {{ $elem['StatusSH'] }}--}}
{{--            </td>--}}
{{--            <td style="width:20%">--}}
{{--                {{ $elem['TrendSH'] }}--}}
{{--            </td>--}}
{{--            <td style="width:20%">--}}
{{--                {{ $elem['StatusER'] }}--}}
{{--            </td>--}}
{{--            <td style="width:20%">--}}
{{--                {{ $elem['TrendER'] }}--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--    @endforeach--}}
{{--</table>--}}

{{--<table>--}}
{{--    <tr>--}}
{{--        <th style="width:20%">--}}
{{--            <b>@lang('imet-core::oecm_report.biodiversity_elements.key_conservation_element')</b>--}}
{{--        </th>--}}
{{--        <th style="width:20%">--}}
{{--            <b>@lang('imet-core::oecm_report.biodiversity_elements.effect_estimated_direct_users')</b>--}}
{{--        </th>--}}
{{--        <th style="width:20%">--}}
{{--            <b>@lang('imet-core::oecm_report.biodiversity_elements.effect_estimated_indirect_users')</b>--}}
{{--        </th>--}}
{{--        <th style="width:20%">--}}
{{--            <b>@lang('imet-core::oecm_report.biodiversity_elements.average')</b>--}}
{{--        </th>--}}
{{--        <th style="width:20%">--}}
{{--            <b>@lang('imet-core::oecm_report.biodiversity_elements.comments')</b>--}}
{{--        </th>--}}
{{--    </tr>--}}
{{--    @foreach($key_elements_impacts as $key => $elem)--}}
{{--        <tr>--}}
{{--            <td style="width:20%">--}}
{{--                {{ $elem['KeyElement'] }}--}}
{{--            </td>--}}
{{--            <td style="width:20%">--}}
{{--                {{ $elem['EffectSH'] }}--}}
{{--            </td>--}}
{{--            <td style="width:20%">--}}
{{--                {{ $elem['EffectER'] }}--}}
{{--            </td>--}}
{{--            <td style="width:20%">--}}
{{--                {{ $elem['average'] }}--}}
{{--            </td>--}}
{{--            <td style="width:20%">--}}
{{--                {{ $elem['CommentsSH'] }}--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--    @endforeach--}}
{{--</table>--}}
