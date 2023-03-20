<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

$record  = $records[0];

?>

@foreach($definitions['fields'] as $f_index => $field)

    @component('modular-forms::module.field_container', [
            'name' => $field['name'],
            'label' => $field['label'] ?? '',
            'label_width' => $definitions['label_width']
        ])


        @if($f_index>2)

            <div style="display: flex; justify-content: space-between;">
                @include('modular-forms::module.show.field', [
                   'type' => $field['type'],
                   'value' => $record[$field['name']]
                ])
                <div style="margin: 0 40px 0 5px;">[ha]</div>

                @include('modular-forms::module.show.field', [
                   'type' => $field['type'],
                   'value' => $record[$field['name']]/100
                ])
                <div style="margin: 0 40px 0 5px;">[km2]</div>
            </div>

        @else

            {{-- input field --}}
            @include('modular-forms::module.show.field', [
               'type' => $field['type'],
               'value' => $record[$field['name']]
            ])
            [km2]

        @endif

    @endcomponent

@endforeach

