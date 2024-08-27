<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vueData */

use \Wa72\HtmlPageDom\HtmlPageCrawler;


$fistGroupPerCategory = array_map(function($category){
    return $category[0];
}, $vueData['groupsByCategory']);

$view = \Illuminate\Support\Facades\View::make('modular-forms::module.edit.type.group_table', compact(['collection', 'vueData', 'definitions']))->render();
$dom = HtmlPageCrawler::create('<div>'.$view.'</div>');

foreach ($fistGroupPerCategory as $i => $group){
    $title = '<div class="module-row">
                <div style="width: 60%;">
                    <h3>'.($i+1).'. '.trans('imet-core::v2_context.EcosystemServices.categories.title'.($i+1)).'</h3>
                </div>
                <div class="module-row__input">
                    <div class="progress_bar" style="margin-top: 25px">
                        <imet_score_bar
                            :value=categoryStat(\''.$i.'\')
                            color="#87c89b"
                        ></imet_score_bar>
                    </div>
                </div>
            </div>';
    $dom->filter('h5.group_title_'.$definitions['module_key'].'_'.$group)->eq(0)->before($title);
}
?>

{!! $dom->saveHTML() !!}
@include('modular-forms::module.edit.type.commons', compact(['collection', 'vueData', 'definitions']))

@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.ImetV2.context.EcosystemServices(@json($vueData)))
            .mount('#module_{{ $definitions['module_key'] }}');
    </script>
@endpush
