<div class="scrollButtons mr-3" style="width:200px;">
    <div class="content">
        <span class="m-1">{{trans('imet-core::analysis_report.navigation_menu')}}</span>
        <select class="field-edit" @change="goTo($event)">
            <option
                value="names"> </option>
            <option
                value="names">{{ trans('imet-core::analysis_report.custom_names') }}</option>
            @foreach($templates as $key => $template)
                <option value="{{ $template['name'] }}">{{$template['code']}}
                    . {{ $template['title'] }}</option>
                @if($template['name'] === 'analysis_per_element_of_them_management_cycle')
                    <option value="process" class="text-center"> - {{ trans('imet-core::analysis_report.element_diagrams.process.process_sub_indicators.title') }}</option>
                    <option value="process_PRA"> - {{ trans('imet-core::analysis_report.element_diagrams.process.process_internal_management_systems_processes.title') }}</option>
                    <option value="process_PRB"> - {{ trans('imet-core::analysis_report.element_diagrams.process.process_management_protection_values.title') }}</option>
                    <option value="process_PRC"> - {{ trans('imet-core::analysis_report.element_diagrams.process.process_stakeholders_relationships.title') }}</option>
                    <option value="process_PRD"> - {{ trans('imet-core::analysis_report.element_diagrams.process.process_tourism_management.title') }}</option>
                    <option value="process_PRE"> - {{ trans('imet-core::analysis_report.element_diagrams.process.process_monitoring_and_research.title') }}</option>
                    <option value="process_PRF"> - {{ trans('imet-core::analysis_report.element_diagrams.process.process_effects_of_climate_change.title') }}</option>
                @endif
            @endforeach
        </select>
    </div>
</div>
