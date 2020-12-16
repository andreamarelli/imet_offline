<?php
/** @var String $accordion_group_id */
/** @var String $accordion_id */
/** @var Boolean $expanded (optional) */
/** @slot $accordion_title */
/** @slot $accordion_title_action (optional) */
/** @slot $accordion_content */

$expanded  = $expanded ?? false;
$accordion_title_action = $accordion_title_action ?? '';

$collapsed = $expanded ? '' : 'collapsed';
$show = $expanded ? 'show' : '';

?>

<div class="card">

    <div class="card-header" id="heading_{{ $accordion_id }}">
        <h4 class="card-title">
            <a role="button"
               class="{{ $collapsed }}"
               data-toggle="collapse"
               data-target="#content_{{ $accordion_id }}"
            >
                {!! $accordion_title !!}
            </a>
        </h4>
        <div class="card-header-action">
            {!! $accordion_title_action !!}
        </div>
    </div>

    <div id="content_{{ $accordion_id }}"
         data-parent="#{{ $accordion_group_id }}"
         class="collapse {{ $show }}"
    >
        <div class="card-body">
            {{ $accordion_content }}
        </div>
    </div>

</div>
