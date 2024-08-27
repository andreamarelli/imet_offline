<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vueData */
/** @var String $group_key (optional - only for GROUP_ACCORDION) */

$group_key = $group_key ?? '';

$accordion_id = \Illuminate\Support\Str::contains($definitions['module_type'], 'GROUP_')
    ? 'group_accordion_'.$definitions['module_key'].'_'.$group_key
    : 'accordion_'.$definitions['module_key'];

?>


<x-modular-forms::accordion.container :id="$accordion_id">

    <template v-for="(item, index) in records">

        <x-modular-forms::accordion.item v-if="recordIsInGroup(item, '{{ $group_key }}')">

            <x-slot:title>
                <span>@{{ accordionTitle(index) }}</span>
            </x-slot:title>

            <x-slot:header-actions>
                @if(!$definitions['fixed_rows'])
                    <span v-if="typeof item.__predefined === 'undefined'">
                        <x-modular-forms::module.components.buttons.delete-item />
                    </span>
                @endif
            </x-slot:header-actions>

            @include('modular-forms::module.edit.type.simple', compact(['collection', 'vueData', 'definitions']))

        </x-modular-forms::accordion.item>

    </template>

    @if(!$definitions['fixed_rows'])
        <div v-if="max_rows==null || numRecordsInGroup('{{ $group_key }}') < max_rows">
            <x-modular-forms::module.components.buttons.add-item :group-key="$group_key" />
        </div>
    @endif


</x-modular-forms::accordion.container>



