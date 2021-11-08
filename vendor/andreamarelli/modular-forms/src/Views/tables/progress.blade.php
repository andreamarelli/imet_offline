<?php
/** @var String $mode (vue or php) */
/** @var String $encode_progress */
/** @var String $validation_progress */


if(strtolower($mode)==='vue'){
    $encode_progress = ":percentage='".$encode_progress."'";
    $validation_progress = ":percentage='".$validation_progress."'";
} else {
    $encode_progress = "percentage=".$encode_progress;
    $validation_progress = "percentage=".$validation_progress;
}

?>

<div style="display: flex; justify-content: center;">
    <div style="display: flex; flex-direction: column; align-items: center;">
        <gauge {!! $encode_progress !!} :integer=true :gradient=true style="width: 50px;"></gauge>
        <i class="text-2xs">@lang_u('modular-forms::common.form.encoding')</i>
    </div>
    <div style="display: flex; flex-direction: column; align-items: center; margin-left: 5px;">
        <gauge {!! $validation_progress !!} :integer=true :gradient=true style="width: 50px;"></gauge>
        <i class="text-2xs">@lang_u('modular-forms::common.form.validation')</i>
    </div>
</div>
