<?php
/** @var array $key_elements_impacts */
?>

<h4>5. @lang('imet-core::oecm_report.ecosystem_services')</h4>

<div>
    @foreach($key_elements_ecosystem_charts['chart']['values'] as $threat_key => $threat_label)
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
                    ></imet_score_bar>
                @endif
            </div>
        </div>
    @endforeach
</div>
