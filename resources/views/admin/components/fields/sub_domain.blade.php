<?php
    /** @var String $v_model */
    /** @var String $v_bind_id */
    /** @var String $class */

?>
<div style="max-width: 420px">
    <dropdown
        :multiple="true"
        {!! $v_model !!} {!! $v_bind_id !!}
        :data-values="JSON.stringify(filtered_domains(index))"
    ></dropdown>
</div>

