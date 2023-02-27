<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

$vue_record_index = '0';

if (!function_exists('formatNum')) {
    function formatNum($value){
        return str_replace('.', ',', $value);
    }
}

$vue_data['AdministrativeArea_ha'] = $vue_data['AdministrativeArea_ha_full'] = formatNum($vue_data['records'][0]['AdministrativeArea']);
$vue_data['AdministrativeArea_km2'] = $vue_data['AdministrativeArea_km2_full'] = formatNum($vue_data['records'][0]['AdministrativeArea']/100);
$vue_data['WDPAArea_ha'] = $vue_data['WDPAArea_ha_full'] = formatNum($vue_data['records'][0]['WDPAArea']);
$vue_data['WDPAArea_km2'] = $vue_data['WDPAArea_ha_full'] = formatNum($vue_data['records'][0]['WDPAArea']/100);
$vue_data['GISArea_ha'] = $vue_data['GISArea_ha_full'] = formatNum($vue_data['records'][0]['GISArea']);
$vue_data['GISArea_km2'] = $vue_data['GISArea_km2_full'] = formatNum($vue_data['records'][0]['GISArea']/100);


?>

@foreach($definitions['fields'] as $field_index => $field)

    @component('modular-forms::module.field_container', [
            'name' => $field['name'],
            'label' => $field['label'] ?? '',
            'label_width' => $definitions['label_width']
        ])


        @if($field_index<=2)

            @include('modular-forms::module.edit.field.vue', [
                'type' => 'hidden',
                'v_value' => 'records['.$vue_record_index.'].'.$field['name'],
                'id' => "'".$definitions['module_key']."_'+".$vue_record_index."+'_".$field['name']."'"
            ])

            @include('modular-forms::module.edit.field.vue', [
                'type' => $field['type'],
                'v_value' => $field['name'].'_ha',
                'id' =>"'".$definitions['module_key'].\AndreaMarelli\ModularForms\Helpers\ModuleKey::separator.$field['name']."_ha'"
            ])
            &nbsp;[ha]

            &nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;

            @include('modular-forms::module.edit.field.vue', [
                'type' => $field['type'],
                'v_value' => $field['name'].'_km2',
                'id' =>"'".$definitions['module_key'].\AndreaMarelli\ModularForms\Helpers\ModuleKey::separator.$field['name']."_km2'"
            ])
            &nbsp;[km2]

        @else

            {{-- input field --}}
            @include('modular-forms::module.edit.field.module-to-vue', [
                'definitions' => $definitions,
                'field' => $field,
                'vue_record_index' => $vue_record_index
            ])
            &nbsp;[km2]

        @endif

    @endcomponent

@endforeach

@push('scripts')
    <style>
        #module_imet__oecm__context__areas .module-row__input div{
            display: inline-block;
        }
    </style>
    <script>
        // ## Initialize Module controller ##
        let module_{{ $definitions['module_key'] }} = new window.ModularForms.ModuleController({
            el: '#module_{{ $definitions['module_key'] }}',
            data: @json($vue_data),

            watch: {
                AdministrativeArea_ha: function(value){
                    this.convert('AdministrativeArea', 'ha', value);
                },
                AdministrativeArea_km2: function(value){
                    this.convert('AdministrativeArea', 'km2', value);
                },
                WDPAArea_ha: function(value){
                    this.convert('WDPAArea', 'ha', value);
                },
                WDPAArea_km2: function(value){
                    this.convert('WDPAArea', 'km2', value);
                },
                GISArea_ha: function(value){
                    this.convert('GISArea', 'ha', value);
                },
                GISArea_km2: function(value){
                    this.convert('GISArea', 'km2', value);
                }
            },

            methods: {

                convert: function (fieldName, convertFrom, value) {
                    if(convertFrom==='ha'){
                        if(parseFloat(this[fieldName+'_ha_full']).toFixed(2) !== parseFloat(value).toFixed(2)){
                            this.records[0][fieldName] = parseFloat(value);
                            this[fieldName+'_ha_full'] = this.records[0][fieldName];
                            this[fieldName+'_km2_full'] = parseFloat(this[fieldName+'_ha_full'])/100;
                            this[fieldName+'_km2'] = this[fieldName+'_km2_full'].toFixed(2);
                        }
                    } else if(convertFrom==='km2'){
                        if(parseFloat(this[fieldName+'_km2_full']).toFixed(2) !== parseFloat(value).toFixed(2)){
                            this.records[0][fieldName] = parseFloat(value)*100;
                            this[fieldName+'_ha_full'] = this.records[0][fieldName];
                            this[fieldName+'_km2_full'] = parseFloat(value);
                            this[fieldName+'_ha'] = this[fieldName+'_ha_full'].toFixed(2);
                        }
                    }
                }

            }

        });
    </script>
@endpush
