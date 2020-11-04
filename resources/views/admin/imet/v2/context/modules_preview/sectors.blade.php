<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */

$table_id = 'table_'.$definitions['module_key'];
$group_key = '';

$area = \App\Models\Imet\v2\Modules\Context\Areas::getArea($collection[0]->FormID);
$sumUnderControlArea = $UnderControlPatrolKm = $UnderControlPatrolManDay = 0

?>

<table id="{{ $table_id }}"  class="table module-table">

    {{-- labels  --}}
    <thead>
    <tr>
        @foreach($definitions['fields'] as $f_index=>$field)
            @if($field['type']!=='hidden')
                <th class="text-center">{{ isset($field['label']) ? ucfirst($field['label']) : '' }}</th>
            @endif
            @if($f_index==1)
                <th class="text-center">@lang('form/imet/v2/context.Sectors.area_percentage')</th>
            @endif
            @if($f_index==3)
                <th class="text-center">@lang('form/imet/v2/context.Sectors.average_time')</th>
            @endif
        @endforeach

    </tr>
    </thead>

    {{-- inputs --}}
    <tbody class="{{ $group_key }}">
        @foreach($records as $record)

            <?php
                $area_percentage = $average_time = null;
                if(floatval($area)>0 && floatval($record['UnderControlArea'])>0){
                    $area_percentage = round(floatval($record['UnderControlArea'])/$area*100, 2);
                }
                if(floatval($area)>0 && floatval($record['UnderControlPatrolManDay'])>0){
                    $average_time = round(floatval($record['UnderControlPatrolManDay'])/$area, 2);
                }
                $sumUnderControlArea += floatval($record['UnderControlArea']);
                $UnderControlPatrolKm += floatval($record['UnderControlPatrolKm']);
                $UnderControlPatrolManDay += floatval($record['UnderControlPatrolManDay']);
            ?>

            <tr class="module-table-item">
                @foreach($definitions['fields'] as $f_index=>$field)
                    <td>
                        @include('admin.components.module.preview.field', [
                            'type' => $field['type'],
                            'value' => $record[$field['name']]
                       ])
                    </td>
                    @if($f_index==1)
                        <td>
                            @include('admin.components.module.preview.field', [
                                'type' => 'numeric',
                                'value' => $area_percentage
                           ])
                        </td>
                    @elseif($f_index==3)
                        <td>
                            @include('admin.components.module.preview.field', [
                                'type' => 'numeric',
                                'value' => $average_time
                           ])
                        </td>
                    @endif

                @endforeach
            </tr>
        @endforeach

        <tr>
            <td></td>
            <td>
                @include('admin.components.module.preview.field', [
                    'type' => 'numeric',
                    'value' => $sumUnderControlArea
               ])
            </td>
            <td></td>
            <td>
                @include('admin.components.module.preview.field', [
                    'type' => 'numeric',
                    'value' => $UnderControlPatrolKm
               ])
            </td>
            <td>
                @include('admin.components.module.preview.field', [
                    'type' => 'numeric',
                    'value' => $UnderControlPatrolManDay
               ])
            </td>
            <td></td>
        </tr>

    </tbody>

</table>

@include('admin.components.module.preview.type.commons', compact(['definitions', 'records']))

