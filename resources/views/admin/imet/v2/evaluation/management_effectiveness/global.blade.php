<?php
/** @var int $item_id */
?>

<div id="assessment_global">
    <h5>@lang('form/imet/v2/common.steps_eval.management_effectiveness')</h5>

    <imet_charts :form_id={{ $item_id }} :show_histogram="true"></<imet_charts>

</div>

<script>

    new Vue({
        el: '#assessment_global',
    });

</script>
