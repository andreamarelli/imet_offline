<?php
/** @var Mixed $definitions */
/** @var Mixed $records */

?>

{{-- ########   Module type: SIMPLE   ######## --}}
@if($definitions['module_type']=='SIMPLE')
    @include('admin.components.module.preview.type.simple', compact(['definitions', 'records']))

    {{-- ########   Module type: TABLE   ######## --}}
@elseif($definitions['module_type']=='TABLE')
    @include('admin.components.module.preview.type.table', compact(['definitions', 'records']))
    @include('admin.components.module.preview.type.commons', compact(['definitions', 'records']))

    {{-- ########   Module type: ACCORDION   ######## --}}
@elseif($definitions['module_type']=='ACCORDION')
    @include('admin.components.module.preview.type.accordion', compact(['definitions', 'records']))
    @include('admin.components.module.preview.type.commons', compact(['definitions', 'records']))

    {{-- ####  Module type: GROUP_TABLE  #### --}}
@elseif($definitions['module_type']=='GROUP_TABLE')
    @include('admin.components.module.preview.type.group_table', compact(['definitions', 'records']))
    @include('admin.components.module.preview.type.commons', compact(['definitions', 'records']))

    {{-- ####  Module type: GROUP_ACCORDION  #### --}}
@elseif($definitions['module_type']=='GROUP_ACCORDION')
    @include('admin.components.module.preview.type.group_accordion', compact(['definitions', 'records']))
    @include('admin.components.module.preview.type.commons', compact(['definitions', 'records']))

@endif