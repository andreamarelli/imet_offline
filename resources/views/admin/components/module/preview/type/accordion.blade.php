<?php
/** @var Mixed $definitions */
/** @var Mixed $records */
/** @var String $group_key (optional - only for GROUP_ACCORDION) */

$group_key = $group_key ?? null;

if($definitions['module_type']==='GROUP_ACCORDION'){
    $accordion_id = 'group_accordion_'.$definitions['module_key'].'_'.$group_key;
    $records = array_filter($records, function($item) use ($group_key){
        return $item['group_key'] === $group_key;
    });
} else {
    $accordion_id = 'accordion_'.$definitions['module_key'];
}

?>

<div id="{{ $accordion_id }}">

    @foreach($records as $index=>$record)
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <span>{{ $index+1 }}</span> -
                    <span>
                        @include('admin.components.module.preview.field', [
                            'type' => $definitions['fields'][0]['type'],
                            'value' => $record[$definitions['fields'][0]['name']],
                            'only_label' => true
                        ])
                    </span>
                </h4>
            </div>
            <div>
                <div class="card-body">
                    @include('admin.components.module.preview.type.simple', [
                        'definitions' => $definitions,
                        'records' => $records,
                        'index' => $index
                    ])
                </div>
            </div>
        </div>
    @endforeach

</div>