<?php
    /** @var String $mode (edit|show|print) */
    /** @var array $last_update [optional] */
?>
@if($mode==='edit')
    <p class="text-right module-log" v-if="last_update!=null && last_update.id!=null">
        @lang('modular-forms::entities.common.last_update'):&nbsp;
        <b data-toggle="tooltip" data-placement="top" v-bind:title="'#'+last_update.id">@{{ last_update.name }}</b>&nbsp;
        <i>@{{ last_update.date }}</i>
    </p>
@else
    @if(isset($last_update) && $last_update['date']!==null)
        <p class="text-right module-log">
            @lang('modular-forms::entities.common.last_update'):&nbsp;
            <b data-toggle="tooltip" data-placement="top" title="{{ $last_update['id'] }}">{{ $last_update['name'] }}</b>&nbsp;
            <i>{{ $last_update['date'] }}</i>
        </p>
    @endif
@endif
