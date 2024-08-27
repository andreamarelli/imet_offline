<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

use Illuminate\Support\Facades\View;
use Wa72\HtmlPageDom\HtmlPageCrawler;
use Wa72\HtmlPageDom\Helpers;

$page = View::make('modular-forms::module.show.type.table', compact(['definitions', 'records']))->render();

$dom = HtmlPageCrawler::create(Helpers::trimNewlines($page));

$threats = trans('imet-core::oecm_lists.Threats');

$threats_in_sa2 = collect($records)
    ->filter(function ($item) {
        return $item['__count_stakeholders_direct'] !== null
            || $item['__count_stakeholders_indirect'] !== null;
    })
    ->pluck('__threat_key')
    ->toArray();

$stats = collect(\AndreaMarelli\ImetCore\Services\ThreatsService::calculateRanking($records))
    ->pluck('__score', '__threat_key')
    ->toArray();

?>


<div id="threat_histograms">
    @foreach($threats as $threat_key => $threat_label)
        <div class="histogram-row">
            <div class="histogram-row__title text-left">
                @if(in_array($threat_key, $threats_in_sa2))
                    <b class="highlight">{{ $threat_label }}</b>
                @else
                    {{ $threat_label }}
                @endif
            </div>
            <div class="histogram-row__value text-right" style="margin-right: 20px;">
                <b>{{ $stats[$threat_key] ?? '-' }}</b>
            </div>
            <div class="histogram-row__progress-bar">
                @if($stats[$threat_key]!==null)
                    <imet_score_bar
                            :value={{ $stats[$threat_key] }}
                            color="#87c89b"
                            :min=-100
                            :max=0
                    ></imet_score_bar>
                @endif
            </div>
        </div>
    @endforeach
</div>


{!! $dom->saveHTML() !!}

@push('scripts')
    <script>
        new Vue({
            el: '#threat_histograms',
        });
    </script>
@endpush

