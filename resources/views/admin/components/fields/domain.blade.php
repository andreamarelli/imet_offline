<?php

    /** @var String $v_model */
    /** @var String $v_bind_id */
    /** @var String $class */

    $domainStructure = \App\Models\Project\Modules\Domain::$structure;
    $list = array_combine(array_keys($domainStructure), array_keys($domainStructure));

?>
<dropdown
    data-values='@json($list)'
    name="domain" {!! $v_model !!} {!! $v_bind_id !!}
></dropdown>
