<?php
/** @var string $attributes */
/** @var string $num_cols  */

$attributes = $attributes ?? '';
$num_cols = $num_cols ?? 3;

?>

<tr {!! $attributes !!}>
    <td colspan="{{ $num_cols }}">
        <div class="nothing_to_evaluate">
            @lang('imet-core::common.nothing_to_evaluate')
        </div>
    </td>
</tr>