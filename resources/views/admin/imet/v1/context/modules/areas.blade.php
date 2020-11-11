<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

$vue_record_index = '0';

$vue_data['AdministrativeArea_ha'] = $vue_data['records'][0]['AdministrativeArea'];
$vue_data['AdministrativeArea_km2'] = $vue_data['records'][0]['AdministrativeArea']/100;
$vue_data['WDPAArea_ha'] = $vue_data['records'][0]['WDPAArea'];
$vue_data['WDPAArea_km2'] = $vue_data['records'][0]['WDPAArea']/100;
$vue_data['GISArea_ha'] = $vue_data['records'][0]['GISArea'];
$vue_data['GISArea_km2'] = $vue_data['records'][0]['GISArea']/100;

?>

@foreach($definitions['fields'] as $field_index => $field)

    @component('admin.components.module.components.row', [
            'name' => $field['name'],
            'label' => $field['label'] ?? '',
            'label_width' => $definitions['label_width']
        ])


        @if($field_index<3)

            @include('admin.components.module.edit.field.vue', [
                'type' => 'hidden',
                'v_value' => 'records['.$vue_record_index.'].'.$field['name'],
                'id' => "'".$definitions['module_key']."_'+".$vue_record_index."+'_".$field['name']."'"
            ])

            @include('admin.components.module.edit.field.vue', [
                'type' => 'integer',
                'v_value' => ''.$field['name'].'_ha',
                'id' =>"'".$definitions['module_key'].\App\Models\Components\ModuleKey::separator.$field['name']."_ha'"
            ])
            [ha]

            &nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;

            @include('admin.components.module.edit.field.vue', [
                'type' => 'integer',
                'v_value' => ''.$field['name'].'_km2',
                'id' =>"'".$definitions['module_key'].\App\Models\Components\ModuleKey::separator.$field['name']."_km2'"
            ])
            [km2]

        @else

            {{-- input field --}}
            @include('admin.components.module.edit.field.auto_vue', [
                'definitions' => $definitions,
                'field' => $field,
                'vue_record_index' => $vue_record_index
            ])

        @endif

    @endcomponent

@endforeach

@push('scripts')
    <script>
        // ## Initialize Module controller ##
        let module_{{ $definitions['module_key'] }} = new ModuleController({
            el: '#module_{{ $definitions['module_key'] }}',
            data: JSON.parse('{!! App\Library\Utils\Type\JSON::toVue($vue_data) !!}'),

            watch: {
                AdministrativeArea_ha: function(value){
                    this.convert('AdministrativeArea_ha', value);
                },
                AdministrativeArea_km2: function(value){
                    this.convert('AdministrativeArea_km2', value);
                },
                WDPAArea_ha: function(value){
                    this.convert('WDPAArea_ha', value);
                },
                WDPAArea_km2: function(value){
                    this.convert('WDPAArea_km2', value);
                },
                GISArea_ha: function(value){
                    this.convert('GISArea_ha', value);
                },
                GISArea_km2: function(value){
                    this.convert('GISArea_km2', value);
                },
            },

            methods: {

                convert: function (field, value) {
                    let [fieldName, convertFrom] = field.split("_");

                    if(convertFrom==='ha'){
                        let new_km2 = (value/100).toFixed(2);
                        let prev_km2 = parseFloat(this[fieldName+'_km2']).toFixed(2);
                        if(prev_km2!==new_km2){
                            this.records[0][fieldName] = value;
                            this[fieldName+'_km2'] = new_km2;
                        }
                    }
                    else if(convertFrom==='km2') {
                        let new_ha = (value*100).toFixed(2);
                        let prev_ha = parseFloat(this[fieldName+'_ha']).toFixed(2);
                        if(prev_ha!==new_ha){
                            this.records[0][fieldName] = new_ha;
                            this[fieldName+'_ha'] = new_ha;
                        }
                    }
                }


            }

        });
    </script>
@endpush

