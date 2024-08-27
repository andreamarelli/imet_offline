<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vueData */

?>

{{-- ####  Module type: SIMPLE  #### --}}
@if($definitions['module_type']=='SIMPLE')
    @include('modular-forms::module.edit.type.simple', compact(['collection', 'vueData', 'definitions']))

    {{-- ####  Module type: TABLE  #### --}}
@elseif($definitions['module_type']=='TABLE')
    @include('modular-forms::module.edit.type.table', compact(['collection', 'vueData', 'definitions']))
    @include('modular-forms::module.edit.type.commons', compact(['collection', 'vueData', 'definitions']))

    {{-- ####  Module type: ACCORDION  #### --}}
@elseif($definitions['module_type']=='ACCORDION')
    @include('modular-forms::module.edit.type.accordion', compact(['collection', 'vueData', 'definitions']))
    @include('modular-forms::module.edit.type.commons', compact(['collection', 'vueData', 'definitions']))

    {{-- ####  Module type: GROUP_TABLE  #### --}}
@elseif($definitions['module_type']=='GROUP_TABLE')
    @include('modular-forms::module.edit.type.group_table', compact(['collection', 'vueData', 'definitions']))
    @include('modular-forms::module.edit.type.commons', compact(['collection', 'vueData', 'definitions']))

    {{-- ####  Module type: GROUP_ACCORDION  #### --}}
@elseif($definitions['module_type']=='GROUP_ACCORDION')
    @include('modular-forms::module.edit.type.group_accordion', compact(['collection', 'vueData', 'definitions']))
    @include('modular-forms::module.edit.type.commons', compact(['collection', 'vueData', 'definitions']))

@else
    <b class="error">Type "{{ $definitions['module_type'] }}" has not been implemented yet.</b>
@endif
