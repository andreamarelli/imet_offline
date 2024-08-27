<?php
/** @var Mixed $definitions */
?>

<div class="module-header">
    @if($definitions['module_code']!==null)
        <div class="module-code text-center">
            {!! ucfirst($definitions['module_code']) !!}
        </div>
    @endif
    <div class="module-title">
        @if(array_key_exists('module_scope', $definitions))
            {!! AndreaMarelli\ImetCore\Helpers\Template::module_scope($definitions['module_scope']) !!}&nbsp;
        @endif
        {!! ucfirst($definitions['module_title']) !!}
    </div>

</div>