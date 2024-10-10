<?php
/** @var array $stake_analysis */
?>

<h4>3. @lang('imet-core::oecm_report.stakeholders')</h4>
@foreach($stake_analysis as $key => $children)


    @foreach($children as $category => $elem)

        <table class="max-w-full">
            <tr>
                <th colspan="2">
                    <h5>{{ trans('imet-core::oecm_context.AnalysisStakeholders.groups.'.$category) }}</h5>
                </th>
            </tr>
            <tr>
                <td>
                    <b>@lang('imet-core::oecm_context.AnalysisStakeholderDirectUsers.fields.Element')</b>
                </td>
                <td>
                    <b>@lang('imet-core::oecm_context.AnalysisStakeholderDirectUsers.fields.Description')</b>
                </td>
            </tr>
            @foreach($elem as $key => $elem)
                <tr class="module-table-item">
                    <td style="width:50%">
                        {{ $key }}
                    </td>
                    <td style="width:50%">
                        @if($elem !== null)
                            {{ join(', ',$elem['elements'])}}
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    @endforeach
@endforeach
