<?php

    $type = isset($type) ? $type : 'alphabetic';

    if(strtolower($type)=='alphabetic')
        $chars = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','y','x','w','z');
    elseif(strtolower($type)=='numeric')
        $chars = array('0','1','2','3','4','5','6','7','8','9');
    elseif(strtolower($type)=='alphanumeric')
        $chars = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','y','x','w','z',
            '0','1','2','3','4','5','6','7','8','9');

?>

<label for="filter_initials">@lang('common.initial')</label>
<div class="btn-group" role="group" id="filter_initials">
    @foreach($chars as $l)
        <input type="button"
            value="{{ strtoupper($l) }}"
            v-on:click="initial = (initial!=='{{ $l }}') ? '{{ $l }}' : null"
            :class="initial === '{{ $l }}' ? 'btn act-btn-active' : 'btn act-btn-basic'"
            @if(!in_array($l, $existing))
                disabled="disabled"
            @endif
        />
    @endforeach
</div>
