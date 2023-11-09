<?php
/** @var array $key_elements_impacts */
?>

<h3>5. @lang('imet-core::oecm_report.ecosystem_services')</h3>
<div class="row mb-5">
    <div class="col">

        <div>
            @foreach($key_elements_ecosystem_charts['chart']['values'] as $threat_key => $threat_label)
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
    </div>
</div>
