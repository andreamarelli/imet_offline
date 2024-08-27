<?php
    /** @var Mixed $definitions */
    /** @var Mixed $records */
    /** @var Mixed $index */

    $index = $index ?? 0;
    $records = $records[$index];

?>

@foreach($definitions['fields'] as $field)

    <div class="module-row">

        {{-- label  --}}
        @if(isset($field['label']) && $field['label']!='')
            <div class="module-row__label">
                <label for="{{ $field['name'] }}">{!! ucfirst($field['label']) !!}</label>
            </div>
        @endif

        {{-- input --}}
        <div class="module-row__input">
            @include('modular-forms::module.show.field', [
                'type' => $field['type'],
                'value' => $records[$field['name']]
           ])
        </div>

    </div>

@endforeach
