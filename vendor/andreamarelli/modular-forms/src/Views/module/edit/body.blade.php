<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

?>

{{-- ####  Module type: SIMPLE  #### --}}
@if($definitions['module_type']=='SIMPLE')
    @include('modular-forms::module.edit.type.simple', compact(['collection', 'vue_data', 'definitions']))

    {{-- ####  Module type: TABLE  #### --}}
@elseif($definitions['module_type']=='TABLE')
    @include('modular-forms::module.edit.type.table', compact(['collection', 'vue_data', 'definitions']))
    @include('modular-forms::module.edit.type.commons', compact(['collection', 'vue_data', 'definitions']))

    {{-- ####  Module type: ACCORDION  #### --}}
@elseif($definitions['module_type']=='ACCORDION')
    @include('modular-forms::module.edit.type.accordion', compact(['collection', 'vue_data', 'definitions']))
    @include('modular-forms::module.edit.type.commons', compact(['collection', 'vue_data', 'definitions']))

    {{-- ####  Module type: GROUP_TABLE  #### --}}
@elseif($definitions['module_type']=='GROUP_TABLE')
    @include('modular-forms::module.edit.type.group_table', compact(['collection', 'vue_data', 'definitions']))
    @include('modular-forms::module.edit.type.commons', compact(['collection', 'vue_data', 'definitions']))

    {{-- ####  Module type: GROUP_ACCORDION  #### --}}
@elseif($definitions['module_type']=='GROUP_ACCORDION')
    @include('modular-forms::module.edit.type.group_accordion', compact(['collection', 'vue_data', 'definitions']))
    @include('modular-forms::module.edit.type.commons', compact(['collection', 'vue_data', 'definitions']))

@else
    <b class="text-danger">Type "{{ $definitions['module_type'] }}" has not been implemented yet.</b>
@endif