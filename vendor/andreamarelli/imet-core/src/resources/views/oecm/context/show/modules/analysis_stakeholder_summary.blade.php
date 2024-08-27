<?php
/** @var int $form_id */

use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\AnalysisStakeholderDirectUsers;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\Stakeholders;

$stakeholders = Stakeholders::calculateWeights($form_id);
arsort($stakeholders);

$key_elements_importance = AnalysisStakeholderDirectUsers::calculateKeyElementsImportances($form_id);

?>


<div class="module-container" id="module_analysis_stakeholder_summary">
    <div class="module-header">
        <div class="module-title">
            @lang('imet-core::oecm_context.AnalysisStakeholders.summary')
        </div>
    </div>
    <div class="module-body" style="display: flex; column-gap: 40px;">

        <div>
            <h5>@lang('imet-core::oecm_context.AnalysisStakeholders.elements_importance')</h5>
            <table class="summary_table">
                <thead>
                <tr>
                    <th>@lang('imet-core::oecm_context.AnalysisStakeholders.element')</th>
                    <th>@lang('imet-core::oecm_context.AnalysisStakeholders.importance')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($key_elements_importance as $element)
                    <tr class="module-table-item">
                        <td style="text-align: left;">
                            {{ $element['element'] }}
                            <div class="text-left text-xs" style="padding: 4px 4px 0 4px;">
                                @lang('imet-core::oecm_evaluation.KeyElements.key_elements_importance_composition', [
                                    'imp_dir' => "<b>" . $element['importance_direct'] . "</b>",
                                    'imp_ind' => "<b>" . $element['importance_indirect'] . "</b>",
                                    'num_dir' => "<b>" . $element['stakeholder_direct_count'] . "</b>",
                                    'num_ind' => "<b>" . $element['stakeholder_indirect_count'] . "</b>",
                                ])
                            </div>
                        </td>
                        <td style="text-align: left;">{{ $element['importance'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div>
            <h5>@lang('imet-core::oecm_context.AnalysisStakeholders.involvement_ranking')</h5>
            <table class="summary_table">
                <thead>
                <tr>
                    <th></th>
                    <th>@lang('imet-core::oecm_context.AnalysisStakeholders.involvement')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($stakeholders as $stakeholder => $ranking)
                    <tr class="module-table-item">
                        <td style="text-align: left;">{{ $stakeholder }}</td>
                        <td style="text-align: left;">{{ $ranking }}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>

    </div>
</div>
