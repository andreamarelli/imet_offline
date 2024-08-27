<?php

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\View;
use Wa72\HtmlPageDom\Helpers;
use Wa72\HtmlPageDom\HtmlPageCrawler;

/** @var Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vueData */

$view = View::make('modular-forms::module.edit.type.table', compact(['collection', 'vueData', 'definitions']))->render();
$diff_col = '<input type="text" disabled="disabled" style="width: 80px;"
                class="field-edit text-right"
                v-bind:value="diffs[index]"
                v-bind:id="\'' . $definitions['module_key']  .'\' + index + \'_diff\'"
            />';

$dom = HtmlPageCrawler::create(Helpers::trimNewlines($view));
$dom->filter('thead tr th')->eq(5)->append('<th class="text-center">' . trans('imet-core::oecm_context.ManagementStaff.fields.Difference') . '</th>');
$dom->filter('tbody tr td')->eq(5)->append('<td>' . $diff_col . '</td>');

?>

{!! $dom->saveHTML() !!}


@push('scripts')
    <script type="module">
        (new window.ImetCore.Apps.Modules.Oecm.context.ManagementStaff(@json($vueData)))
            .mount('#module_{{ $definitions['module_key'] }}');
    </script>
@endpush
