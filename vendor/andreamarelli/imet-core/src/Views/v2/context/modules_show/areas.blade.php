<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

$record  = $records[0];

$calc = null;
$area = array_key_exists('FormID', $record) ? \AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Context\Areas::getArea($record['FormID']) : null;

if(floatval($area)>0 && floatval($record['BoundaryLength'])>0){
    $calc = sqrt(3.14)/(2*3.14)*floatval($record['BoundaryLength'])/sqrt($area);
    $calc = round($calc, 2);
//    $calc = $calc>=1 ? round($calc, 2) : null;
}

?>

@foreach($definitions['fields'] as $f_index => $field)

    @component('modular-forms::module.field_container', [
            'name' => $field['name'],
            'label' => $field['label'] ?? '',
            'label_width' => $definitions['label_width']
        ])


        @if($f_index<3)

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

        @elseif($f_index===3)

            {{-- input field --}}
            @include('modular-forms::module.show.field', [
               'type' => $field['type'],
               'value' => $record[$field['name']]
            ])
            [km]

        @elseif($f_index===4 || $f_index===5)

            {{-- input field --}}
            @include('modular-forms::module.show.field', [
               'type' => $field['type'],
               'value' => $record[$field['name']]
            ])
            [km2]

        @elseif($f_index<10)

            {{-- input field --}}
            @include('modular-forms::module.show.field', [
               'type' => $field['type'],
               'value' => $record[$field['name']]
            ])
            %

        @elseif($f_index===10)

            @include('modular-forms::module.show.field', [
                'type' =>'disabled',
                'value' => $calc
             ])

        @endif

    @endcomponent

@endforeach

