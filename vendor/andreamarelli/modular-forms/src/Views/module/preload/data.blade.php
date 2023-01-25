<?php
/** @var Mixed $records */
/** @var Mixed $definitions */

?>


@if($definitions['module_type']==='SIMPLE')

    <table class="striped preload_preview">

        <thead>
        <tr>
            <th></th>
            @foreach($definitions['fields'] as $field)
                <th class="text-center">{{ ucfirst($field['label'] ?? '') }}</th>
            @endforeach
        </tr>
        </thead>

        <tbody>
        @foreach($records as $year=>$record)
            <tr>
                <td class="text-center"><b>{{ $year }}</b></td>
                @if(empty($record))
                    <td class="text-center" colspan="{{ count($definitions['fields']) }}">
                        <i>@lang('modular-forms::common.no_data')</i>
                    </td>
                @else
                    @if(array_key_exists('not_applicable' ,$record[0]) && $record[0]['not_applicable']===true)
                        <td class="text-center" colspan="{{ count($definitions['fields']) }}">
                            <i>@lang('modular-forms::common.form.not_applicable')</i>
                        </td>
                    @else
                        @foreach($definitions['fields'] as $field)
                            <td class="text-center">
                                {{  $record[0][$field['name']] }}
                            </td>
                        @endforeach
                    @endif
                @endif

            </tr>
        @endforeach
        </tbody>

    </table>

@elseif($definitions['module_type']==='TABLE' || $definitions['module_type']==='ACCORDION')

    {{-- Selection year buttons  --}}
    @lang('modular-forms::common.form.available_years'):&nbsp;
    @foreach($records as $year=>$record)
        @if(!empty($record))
            <button type="button" class="btn-nav small preload_button year_{{ $year }}" onclick="module_{{ $definitions['module_key'] }}.show_previous_year('{{ $year }}')">{{ $year }}</button>&nbsp;
        @else
            <button type="button" disabled="disabled" class="btn-nav disabled small">{{ $year }}</button>&nbsp;
        @endif
    @endforeach

    @foreach($records as $year=>$record_year)
        @if(!empty($record_year))

            @if(array_key_exists('not_applicable' ,$record_year[0]) && $record_year[0]['not_applicable']===true)

                <table class="striped preload_preview year_{{ $year }}" style="display: none;">
                    <thead>
                    <tr>
                        <th>@lang('modular-forms::common.form.not_applicable')</th>
                    </tr>
                    </thead>
                </table>

            @else

                <table class="striped preload_preview year_{{ $year }}" style="display: none;">

                    <thead>
                    <tr>
                        @foreach($definitions['fields'] as $field)
                            <th class="text-center">{{ ucfirst($field['label'] ?? '') }}</th>
                        @endforeach
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($record_year as $index=>$record)
                        <tr>
                            @foreach($definitions['fields'] as $field)
                                <td class="text-center">
                                    {{  !empty($record) && !is_array($record[$field['name']]) ? $record[$field['name']] : ' - ' }}
                                </td>
                            @endforeach
                            <td>
                                <button type="button" class="btn-nav small" onclick="module_{{ $definitions['module_key'] }}.apply_preload_one_record('{{ $year }}', '{{ $index }}')">@uclang('modular-forms::common.import')</button>
                            </td>
                        </tr>
                        @endforeach
                        </tr>
                    </tbody>

                </table>
            @endif

        @endif
    @endforeach

@endif
