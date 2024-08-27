<?php
/** @var string $num_cols  */
/** @var string $mode [optional]  */

use \AndreaMarelli\ModularForms\Enums\ModuleViewModes;

$attributes = $attributes ?? '';
$num_cols = $num_cols ?? 3;
$mode = $mode ?? ModuleViewModes::EDIT;

?>

<tbody {{ $mode===ModuleViewModes::EDIT ? 'v-else' : '' }}>
    <tr>
        <td colspan="{{ $num_cols }}" class="py-4">
            <div class="nothing_to_evaluate">
                @lang('imet-core::common.nothing_to_evaluate')
            </div>
        </td>
    </tr>
</tbody>