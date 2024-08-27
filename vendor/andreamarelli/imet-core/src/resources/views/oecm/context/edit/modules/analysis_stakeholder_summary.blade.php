<?php
/** @var int $form_id */

use AndreaMarelli\ImetCore\Controllers\Imet\oecm\Controller;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\AnalysisStakeholderDirectUsers;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\Stakeholders;

$stakeholders = Stakeholders::calculateWeights($form_id);
arsort($stakeholders);

$data = [
    'key_elements_importance' => AnalysisStakeholderDirectUsers::calculateKeyElementsImportances($form_id)
];

?>

<div style="width: 100%; text-align: right;">
    <a class="btn-nav" style="margin-bottom: 20px;" target="_blank"
       href="{{ route(Controller::ROUTE_PREFIX . 'print_sa', ['item' => $item]) }}">Print empty SA</a>
</div>


<div class="module-container" id="module_analysis_stakeholder_summary">
    <div class="module-header">
        <div class="module-title">
            @lang('imet-core::oecm_context.AnalysisStakeholders.summary')
        </div>
    </div>
    <div class="module-body">
        <div style="display: flex; column-gap: 40px;">

            <div class="flex flex-row gap-x-8">

                <div>
                    <h5>@lang('imet-core::oecm_context.AnalysisStakeholders.elements_importance')</h5>
                    <table class="summary_table">
                        <thead>
                        <tr>
                            <th>@lang('imet-core::oecm_context.AnalysisStakeholders.element')</th>
                            <th style="width: 100px;">@lang('imet-core::oecm_context.AnalysisStakeholders.importance')</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="module-table-item" v-for="element in key_elements_importance">
                            <td style="text-align: left;">
                                <b>@{{ element.element }}</b>
                                <div class="text-left text-xs" style="padding: 4px 4px 0 4px; font-style: italic;">
                                    <div v-html="key_elements_importance_composition(element)"></div>
                                </div>
                            </td>
                            <td style="text-align: center;"><b>@{{ element.importance }}</b></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div>
                    <h5>@lang('imet-core::oecm_context.AnalysisStakeholders.involvement_ranking')</h5>
                    <table class="summary_table">
                        <thead>
                        <tr>
                            <th></th>
                            <th style="width: 200px;">@lang('imet-core::oecm_context.AnalysisStakeholders.involvement')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($stakeholders as $stakeholder => $ranking)
                            <tr class="module-table-item">
                                <td style="text-align: left;"><b>{{ $stakeholder }}</b></td>
                                <td style="text-align: center;"><b>{{ $ranking }}</b></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
</div>



@push('scripts')
    <script type="module">
        window.AnalysisStakeholderSummary = (new window.ImetCore.Apps.Modules.Oecm.context.AnalysisStakeholderSummary(@json($data)))
            .mount('#module_analysis_stakeholder_summary');
    </script>
@endpush