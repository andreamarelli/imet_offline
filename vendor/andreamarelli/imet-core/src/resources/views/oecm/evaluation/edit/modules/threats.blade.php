<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vueData */

$vueData['threats'] = $threats = trans('imet-core::oecm_lists.Threats');

$threats_in_sa2 = collect($vueData['records'])
    ->filter(function ($item) {
        return $item['__count_stakeholders_direct'] !== null
            || $item['__count_stakeholders_indirect'] !== null;
    })
    ->pluck('__threat_key')
    ->toArray();
?>

<div>
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
                <b v-html="threat_stats['{{ $threat_key }}'] || '-'"></b>
            </div>
            <div class="histogram-row__progress-bar"  v-if="threat_stats['{{ $threat_key }}']!==null">
                <imet_score_bar
                        :value=threat_stats['{{ $threat_key }}']
                        color="#87c89b"
                        :min=-100
                        :max=0
                ></imet_score_bar>
            </div>
        </div>

    @endforeach
</div>

@include('modular-forms::module.edit.type.table', compact(['collection', 'vueData', 'definitions']))

@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.Oecm.evaluation.Threats(@json($vueData)))
            .mount('#module_{{ $definitions['module_key'] }}');
    </script>
@endpush
