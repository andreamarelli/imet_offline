<?php
/** @var int $item_id */
?>

<div id="assessment_global">
    <h5>@lang('imet-core::common.steps_eval.management_effectiveness')</h5>

    @include('imet-core::components.imet_charts', ['form_id' => $item_id, 'version' => \AndreaMarelli\ImetCore\Models\Imet\Imet::IMET_V2])

</div>

<script>

    new Vue({
        el: '#assessment_global',
    });

</script>
