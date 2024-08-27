<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vueData */

use AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Context\MenacesPressions;
use Illuminate\Support\Facades\View;
use Wa72\HtmlPageDom\Helpers;
use Wa72\HtmlPageDom\HtmlPageCrawler;

$view = View::make('modular-forms::module.edit.type.table', compact(['collection', 'vueData', 'definitions']))->render();

$dom = HtmlPageCrawler::create(Helpers::trimNewlines($view));
$dom->filter('thead tr th')->eq(0)->append('<th></th>');
$dom->filter('tbody tr td')->eq(0)->append('<td><div class="field-preview w-16" v-html=stats[index]></div></td>');

$vueData['stats'] = collect(MenacesPressions::getStats($vueData['form_id'])['category_stats'])
    ->map(function ($item){
        return round($item, 2);
    })->toArray();
?>


{!! $dom->saveHTML() !!}
@include('modular-forms::module.edit.type.commons', compact(['collection', 'vueData', 'definitions']))


@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.ImetV1.evaluation.Menaces(@json($vueData)))
            .mount('#module_{{ $definitions['module_key'] }}');
    </script>
@endpush