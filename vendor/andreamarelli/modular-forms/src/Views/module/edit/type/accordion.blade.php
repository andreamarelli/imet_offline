<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */
/** @var String $group_key (optional - only for GROUP_ACCORDION) */

$group_key = $group_key ?? '';

if($definitions['module_type']==='GROUP_ACCORDION'){
    $accordion_id = 'group_accordion_'.$definitions['module_key'].'_'.$group_key;
    $accordion_item_record = 'records[\''.$group_key.'\']';
    $accordion_titles = '{{ typeof accordion_titles[\''.$group_key.'\'] !== "undefined"  && typeof accordion_titles[\''.$group_key.'\'][index]!=="undefined" ? accordion_titles[\''.$group_key.'\'][index] : "" }}';
} else {
    $accordion_id = 'accordion_'.$definitions['module_key'];
    $accordion_item_record = 'records';
    $accordion_titles = '{{  accordion_titles[index] }}';
}

?>

<div class="accordion module_accordion_container" id="{{ $accordion_id }}">

    <div class="card module_accordion module_accordion_item" v-for="(item, index) in {{ $accordion_item_record }}">

        <div class="card-header" :id="'{{ $accordion_id }}_heading_'+index">
            <h4 class="card-title collapsed" role="button" data-toggle="collapse" :data-target="'#{{ $accordion_id }}_content_'+index">
                <div style="display: flex; align-items: center;">
                    <div style="flex-grow: 1">
                        {{ $accordion_titles }}
                    </div>
                    <div>
                        @if(!$definitions['fixed_rows'])
                            <span v-if="typeof item.__predefined === 'undefined'">
                                @include('modular-forms::buttons.delete_item')
                            </span>
                        @endif
                    </div>
                </div>
            </h4>
        </div>

        <div :id="'{{ $accordion_id }}_content_'+index" class="collapse" data-parent="#{{ $accordion_id }}" >
            <div class="card-body">
                @include('modular-forms::module.edit.type.simple', compact(['collection', 'vue_data', 'definitions']))
            </div>
        </div>

    </div>

</div>

@if(!$definitions['fixed_rows'])
    <div v-if="max_rows==null || {{ $accordion_item_record }}.length < max_rows" class="module-row">
        @include('modular-forms::buttons.add_item')
    </div>
@endif
