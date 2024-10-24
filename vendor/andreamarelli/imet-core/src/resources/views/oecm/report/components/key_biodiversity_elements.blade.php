<?php
/** @var array $key_elements_impacts */
?>

<h4>4. @lang('imet-core::oecm_report.biodiversity_elements.title')</h4>
<h5>4.1 @lang('imet-core::oecm_report.biodiversity_elements.specific_threats')</h5>
<div>
    @foreach($key_elements_biodiversity_charts['chart']['values'] as $threat_key => $threat_label)
        <div class="histogram-row">
            <div class="histogram-row__title text-left">{{ $threat_key }}</div>
            <div class="histogram-row__value text-right" style="margin-right: 20px;">
                <b>{{ $threat_label ?? '-' }}</b>
            </div>
            <div class="histogram-row__progress-bar">
                @if($threat_label!=='-')
                    <imet_score_bar
                            :value={{ $threat_label }}
                                color="#87c89b"
                            :min=-100
                            :max=0
                    ></imet_score_bar>
                @endif
            </div>
        </div>
    @endforeach
</div>

<h5>4.2 @lang('imet-core::oecm_report.biodiversity_elements.global_threats')</h5>

<div>
    @foreach($main_threats['chart']['values'] as $threat_key => $threat_label)
        <div class="histogram-row">
            <div class="histogram-row__title text-left">{{ $threat_key }}</div>
            <div class="histogram-row__value text-right" style="margin-right: 20px;">
                <b>{{ $threat_label ?? '-' }}</b>
            </div>
            <div class="histogram-row__progress-bar">
                @if($threat_label!=='-')
                    <imet_score_bar
                        :value={{ $threat_label }}
                        color="#FF0000"
                        :min=-100
                        :max=0
                    ></imet_score_bar>
                @endif
            </div>
        </div>
    @endforeach
</div>
