<?php

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\View;
use Wa72\HtmlPageDom\Helpers;
use Wa72\HtmlPageDom\HtmlPageCrawler;

/** @var Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

$original_table = View::make('modular-forms::module.edit.type.table', compact(['collection', 'vue_data', 'definitions']))->render();

$diff_col = '<input type="text" disabled="disabled" style="width: 80px;"
                class="field-edit text-right"
                v-bind:value="diffs[index]"
                v-bind:id="\'' . $definitions['module_key']  .'\' + index + \'_diff\'"
            />';

$dom = HtmlPageCrawler::create(Helpers::trimNewlines($original_table));
$dom->filter('thead > tr > th')->eq(5)->append('<th class="text-center">' . trans('imet-core::oecm_context.ManagementStaff.fields.Difference') . '</th>');
$dom->filter('tbody > tr > td')->eq(5)->append('<td>' . $diff_col . '</td>');

?>


{!! $dom->saveHTML() !!}


@push('scripts')

    <script>
        // ## Initialize Module controller ##
        let module_{{ $definitions['module_key'] }} = new window.ModularForms.ModuleController({
            el: '#module_{{ $definitions['module_key'] }}',
            data: @json($vue_data),

            computed: {

                diffs() {
                    let diffs = [];
                    this.records.forEach(function (item, index) {
                        diffs[index] = null;
                        if (item['Number'] !== null && item['AdequateNumber'] !== null) {
                            diffs[index] += parseInt(item['Number']) - parseInt(item['AdequateNumber']);
                        }
                    });
                    return diffs;
                }

            }
        });
    </script>

@endpush
