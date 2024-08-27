<?php
/** @var Mixed $definitions */
/** @var Mixed $records */

?>

{{-- ########   Module type: SIMPLE   ######## --}}
@if($definitions['module_type']=='SIMPLE')
    @include('modular-forms::module.show.type.simple', compact(['definitions', 'records']))

    {{-- ########   Module type: TABLE   ######## --}}
@elseif($definitions['module_type']=='TABLE')
    @include('modular-forms::module.show.type.table', compact(['definitions', 'records']))
    @include('modular-forms::module.show.type.commons', compact(['definitions', 'records']))

    {{-- ########   Module type: ACCORDION   ######## --}}
@elseif($definitions['module_type']=='ACCORDION')
    @include('modular-forms::module.show.type.accordion', compact(['definitions', 'records']))
    @include('modular-forms::module.show.type.commons', compact(['definitions', 'records']))

    {{-- ####  Module type: GROUP_TABLE  #### --}}
@elseif($definitions['module_type']=='GROUP_TABLE')
    @include('modular-forms::module.show.type.group_table', compact(['definitions', 'records']))
    @include('modular-forms::module.show.type.commons', compact(['definitions', 'records']))

    {{-- ####  Module type: GROUP_ACCORDION  #### --}}
@elseif($definitions['module_type']=='GROUP_ACCORDION')
    @include('modular-forms::module.show.type.group_accordion', compact(['definitions', 'records']))
    @include('modular-forms::module.show.type.commons', compact(['definitions', 'records']))

@endif
