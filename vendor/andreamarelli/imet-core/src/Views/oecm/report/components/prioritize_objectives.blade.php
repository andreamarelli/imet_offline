<div class="row ">
    <div class="col text-center mt-4 mb-2">
        <h4>4. @lang('imet-core::oecm_report.general_planning.short_term_prioritize')</h4>
    </div>
</div>
<div v-if="error_objectives">
    <div class="standalone error text-center mb-5 alert alert-danger">
        {{ ucfirst(trans('imet-core::analysis_report.error_wrong')) }}!
    </div>
</div>
<div v-else>
    <div class="standalone" v-if="loading_objectives">
        <i class="fa fa-spinner fa-spin green_dark"></i>
    </div>
    <div v-else>
        <div class="module-container">
            <div class="module-body">
                <div class="row">
                    <div class="col"><h4>@lang('imet-core::oecm_report.general_planning.intervention_context')</h4>
                    </div>
                </div>
                <div v-if="short_long_objectives" v-for="(objective, index) in short_long_objectives['context']"
                     class="row mt-3">
                    <div class="col">@{{ objective}}</div>
                </div>
            </div>
        </div>
        <div class="module-container">
            <div class="module-body">
                <div class="row">
                    <div class="col"><h4>@lang('imet-core::oecm_report.general_planning.management_evaluation')</h4>
                    </div>
                </div>
                <div v-if="short_long_objectives" v-for=" (objective, index) in short_long_objectives['evaluation']"
                     class="row mt-3">
                    <div class="col">@{{ objective}}</div>
                </div>
            </div>
        </div>
    </div>
</div>


