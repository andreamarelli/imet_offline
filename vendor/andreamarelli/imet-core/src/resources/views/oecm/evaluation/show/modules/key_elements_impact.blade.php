<?php
use Illuminate\Database\Eloquent\Collection;

/** @var Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

?>

@foreach($definitions['groups'] as $group_key => $group_label)
    <div class="{{ $group_key }}">

        <h5 class="highlight group_title_{{ $definitions['module_key'] }}_{{ $group_key }}">{{ $group_label }}</h5>

        <div id="{{ 'group_table_'.$definitions['module_key'].'_'.$group_key }}">

            {{-- labels  --}}
            <div class="grid_module">
                <div class="text-center"><b>{{ ucfirst($definitions['fields'][0]['label'] ?? '') }}</b></div>
                <div></div>
                <div class="text-center"><b>{{ ucfirst($definitions['fields'][1]['label'] ?? '') }}</b></div>
                <div class="text-center"><b>{{ ucfirst($definitions['fields'][2]['label'] ?? '') }}</b></div>
                <div class="text-center"><b>{{ ucfirst($definitions['fields'][3]['label'] ?? '') }}</b></div>
                <div class="text-center"><b>{{ ucfirst($definitions['fields'][4]['label'] ?? '') }}</b></div>
                <div class="text-center"><b>{{ ucfirst($definitions['fields'][5]['label'] ?? '') }}</b></div>
            </div>

            @php
                $table_id = 'group_table_'.$definitions['module_key'].'_'.$group_key;
                $group_records = array_filter($records, function($item) use ($group_key, $definitions){
                    return $item[$definitions['group_key_field']] === $group_key;
                });
            @endphp

            {{-- records --}}
            <div class="{{ $group_key }}">
                @foreach($group_records as $index => $record)
                    <div class="grid_module">

                        <div style="grid-row-start: 1; grid-row-end: span 2;">
                            @include('modular-forms::module.show.field', [
                                'type' => $definitions['fields'][0]['type'],
                                'value' => $record[$definitions['fields'][0]['name']]
                           ])
                        </div>

                        <div class="text-center"><b>@lang('imet-core::oecm_evaluation.KeyElementsImpact.from_sa')</b></div>
                        @for ($i = 1; $i <= 5; $i++)
                            <div>
                                @include('modular-forms::module.show.field', [
                                    'type' => $definitions['fields'][$i]['type'],
                                    'value' => $record[$definitions['fields'][$i]['name']]
                               ])
                            </div>
                        @endfor


                        <div class="text-center"><b>@lang('imet-core::oecm_evaluation.KeyElementsImpact.from_external_source')</b></div>
                        @for ($i = 6; $i <= 10; $i++)
                            <div>
                                @include('modular-forms::module.show.field', [
                                    'type' => $definitions['fields'][$i]['type'],
                                    'value' => $record[$definitions['fields'][$i]['name']]
                               ])
                            </div>
                        @endfor

                    </div>
                @endforeach
            </div>

        </div>

        <br />
        <br />

    </div>
@endforeach



@push('scripts')
    <style>
        .grid_module {
            display: grid;
            grid-template-columns: 170px 130px 122px 122px 120px 120px auto;
            column-gap: 10px;
            row-gap: 10px;
            border-bottom: 1px solid #A3A3A3; /* $gray-400; */
            padding: 5px;
        }

        .grid_module div {
            align-self: center;
        }
    </style>
@endpush