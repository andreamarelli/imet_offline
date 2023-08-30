<?php
/** @var int $form_id */

use AndreaMarelli\ImetCore\Controllers\Imet\oecm\Controller;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\AnalysisStakeholderDirectUsers;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\Stakeholders;

$stakeholders = Stakeholders::calculateWeights($form_id);
arsort($stakeholders);

$key_elements_importance = AnalysisStakeholderDirectUsers::calculateKeyElementsImportances($form_id);

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

            <div>
                <h5>@lang('imet-core::oecm_context.AnalysisStakeholders.elements_importance')</h5>
                <table class="table module-table">
                    <thead>
                    <tr>
                        <th>@lang('imet-core::oecm_context.AnalysisStakeholders.element')</th>
                        <th>@lang('imet-core::oecm_context.AnalysisStakeholders.importance')</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="module-table-item" v-for="element in key_elements_importance">
                        <td style="text-align: left;">
                            @{{ element.element }}
                            <div class="text-left text-xs" style="padding: 4px 4px 0 4px;">
                                <div v-html="key_elements_importance_composition(element)"></div>
                            </div>
                        </td>
                        <td style="text-align: left;">@{{ element.importance }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div>
                <h5>@lang('imet-core::oecm_context.AnalysisStakeholders.involvement_ranking')</h5>
                <table class="table module-table">
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
</div>



@push('scripts')
    <script>

        let module_analysis_stakeholder_summary = new Vue({
            el: '#module_analysis_stakeholder_summary',
            data: {
                key_elements_importance: @json($key_elements_importance),
            },

            methods: {

                refresh_importances(key_elements_importance) {
                    this.key_elements_importance = key_elements_importance;
                },

                key_elements_importance_composition(element) {
                    return Locale.getLabel('imet-core::oecm_evaluation.KeyElements.key_elements_importance_composition', {
                        'imp_dir': '<b>' + element['importance_direct'] + '</b>',
                        'imp_ind': '<b>' + element['importance_indirect'] + '</b>',
                        'num_dir': '<b>' + element['stakeholder_direct_count'] + '</b>',
                        'num_ind': '<b>' + element['stakeholder_indirect_count'] + '</b>',
                    })
                }

            }
        });

    </script>
@endpush