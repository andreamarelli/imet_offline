<?php
/** @var Mixed $definitions */
?>

@foreach($definitions['groups'] as $group_key => $group_label)

    <h5 class="highlight group_title_{{ $definitions['module_key'] }}_{{ $group_key }}">{{ $group_label }}</h5>

    <table id="{{ 'group_table_'.$definitions['module_key'].'_'.$group_key }}" class="table module-table">

        {{-- labels  --}}
        <thead>
        <tr>
            @foreach($definitions['fields'] as $field)
                @if($field['type']!=='hidden')
                    <th class="text-center">{{ ucfirst($field['label'] ?? '') }}</th>
                @endif
            @endforeach
            <th></th>
        </tr>
        </thead>

        {{-- inputs --}}
        <tbody class="{{ $group_key }}">
        @include('imet-core::components.module.nothing_to_evaluate', ['num_cols' => 4, 'attributes' => 'v-if="records[\'' . $group_key . '\'][0].' . $definitions['fields'][0]['name'] . '===null"'])
        <tr v-else class="module-table-item" v-for="(item, index) in {{ 'records[\''.$group_key.'\']' }}">
            {{--  fields  --}}
            @foreach($definitions['fields'] as $i => $field)
                <td>
                    @if($i===0 && $group_key==='group6')
                        @include('modular-forms::module.edit.field.vue', [
                             'type' => 'text-area',
                             'v_value' => 'records[\''.$group_key.'\'][index].'.$field['name'],
                             'id' => "'".$definitions['module_key']."_".$group_key."_'+index+'_".$field['name']."'"
                         ])
                    @else
                        @include('modular-forms::module.edit.field.module-to-vue', [
                            'definitions' => $definitions,
                            'field' => $field,
                            'vue_record_index' => 'index',
                            'group_key' => $group_key
                        ])
                    @endif
                </td>
            @endforeach
            <td>
                {{-- record id  --}}
                @include('modular-forms::module.edit.field.vue', [
                    'type' => 'hidden',
                    'v_value' => 'item.'.$definitions['primary_key']
                ])
                @if($group_key==='group6')
                    <span v-if="typeof item.__predefined === 'undefined'">
                            @include('modular-forms::buttons.delete_item')
                        </span>
                @endif
            </td>
        </tr>
        </tbody>

        @if($group_key==='group6')
            <tfoot v-if="max_rows==null || records.length < max_rows">
            {{-- add button --}}
            <tr>
                <td colspan="{{ count($definitions['fields']) + 1 }}">
                    @include('modular-forms::buttons.add_item')
                </td>
            </tr>
            </tfoot>
        @endif

    </table>

    <br />
    <br />

@endforeach

@push('scripts')
    <script>
        // ## Initialize Module controller ##
        let module_{{ $definitions['module_key'] }} = new window.ModularForms.ModuleController({
            el: '#module_{{ $definitions['module_key'] }}',
            data: @json($vue_data),

            methods: {
                plain_name(fullName){
                    return fullName!=null && this.isTaxonomy(fullName)
                        ? this.getScientificName(fullName)
                        : fullName;
                },

                tooltip(fullName){
                    return fullName!=null && this.isTaxonomy(fullName)
                        ? fullName.replace(/\|/g, " ")
                        : '';
                },

                isTaxonomy(fullName){
                    return (fullName.match(/\|/g) || []).length===5
                },

                getScientificName (fullName){
                    let sciName = null;
                    if(fullName!==null){
                        let taxonomy = fullName.split("|");
                        sciName =  taxonomy[4] + ' ' + taxonomy[5]
                    }
                    return sciName;
                },
            }

        });
    </script>
@endpush
