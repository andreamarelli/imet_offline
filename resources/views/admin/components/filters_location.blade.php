<?php
    /** @var \Illuminate\Http\Request | array $request */
    /** @var bool $project_intersection */

    $params = $request instanceof \Illuminate\Http\Request ? $request->all() : $request;

    use \App\Models\AdministrationLevel;

    $project_intersection = $project_intersection ?? false;

    $vue_data = [
        'intervention_level' =>         $params['intervention_level'] ?? null,
        'continental_location' =>       $params['continental_location'] ?? null,
        'regional_location' =>          $params['regional_location'] ?? null,
        'national_location' =>          $params['national_location'] ?? null,
        'Concession_location' =>        $params['Concession_location'] ?? null,
        'ProtectedArea_location' =>     $params['ProtectedArea_location'] ?? null,
        'Landscape_location' =>         $params['Landscape_location'] ?? null,
        'KeyLandscapeConservation_location' =>        $params['KeyLandscapeConservation_location'] ?? null,
        'administrative_location' =>    $params['administrative_location'] ?? null,
        'level_intersections' =>        isset($params['level_intersections'])
    ];

    $InitVueData = AdministrationLevel::getVueInitData();
    $InitEmptyData = AdministrationLevel::getVueInitEmptyData();
    $vue_data['administrative_location_record_data'] = $InitEmptyData;
    if($vue_data['intervention_level']==='administrativeLevels' && $vue_data['administrative_location']!==null){
        $vue_data['administrative_location_record_data'] = AdministrationLevel::getVueInitRecordData($vue_data['administrative_location']);
    }

?>


{{--
{!! \App\Library\Ofac\Input\DropDownVue::simple('intervention_level', $vue_data['intervention_level'], 'ProjectLocation') !!}
--}}


<div id="location_filter">

    {{-- level --}}
    {!! ucfirst(trans('form/project.intervention_level')).': ' !!}<br />
    @include('admin.components.module.edit.field.vue', [
        'type' => 'dropdown-ProjectLocation',
        'v_value' => 'intervention_level',
        'id' => 'intervention_level',
        'other' => '@change=trigger'
    ])
    <input type="hidden" name="intervention_level" v-model="intervention_level" />

    <br />

    {{-- continental_location --}}
    <div v-show="intervention_level === 'continental'">
        @include('admin.components.module.edit.field.vue', [
            'type' => 'dropdown-Continents',
            'v_value' => 'continental_location',
            'id' => 'continental_location',
            'other' => '@change=trigger'
        ])
        <input type="hidden" name="continental_location" v-model="continental_location" />
    </div>

    {{-- regional_location --}}
    <div v-show="intervention_level === 'regional'">
        @include('admin.components.module.edit.field.vue', [
            'type' => 'dropdown-Regions',
            'v_value' => 'regional_location',
            'id' => "'regional_location'",
            'other' => 'name="regional_location" @change=trigger'
        ])
        <input type="hidden" name="regional_location" v-model="regional_location" />
    </div>


    {{-- national_location --}}
    <div v-show="intervention_level === 'national'">
        @include('admin.components.module.edit.field.vue', [
            'type' => 'dropdown-countryOFAC',
            'v_value' => 'national_location',
            'id' => "'national_location'",
            'other' => 'name="national_location" @change=trigger'
        ])
        <input type="hidden" name="national_location" v-model="national_location" />
    </div>

    {{-- Concession_location --}}
    <div v-show="intervention_level === 'Concession'">
        @include('admin.components.module.edit.field.vue', [
            'type' => 'dropdown-Concession',
            'v_value' => 'Concession_location',
            'id' => "'Concession_location'",
            'other' => 'name="Concession_location" @change=trigger'
        ])
        <input type="hidden" name="Concession_location" v-model="Concession_location" />
    </div>

    {{-- ProtectedArea_location --}}
    <div v-show="intervention_level === 'ProtectedArea'">
        @include('admin.components.module.edit.field.vue', [
            'type' => 'dropdown-ProtectedArea',
            'v_value' => 'ProtectedArea_location',
            'id' => "'ProtectedArea_location'",
            'other' => 'name="ProtectedArea_location" @change=trigger'
        ])
        <input type="hidden" name="ProtectedArea_location" v-model="ProtectedArea_location" />
    </div>

    {{-- Landscape_location --}}
    <div v-show="intervention_level === 'Landscape'">
        @include('admin.components.module.edit.field.vue', [
            'type' => 'dropdown-Landscape',
            'v_value' => 'Landscape_location',
            'id' => "'Landscape_location'",
            'other' => 'name="Landscape_location" @change=trigger'
        ])
        <input type="hidden" name="Landscape_location" v-model="Landscape_location" />
    </div>

    {{-- KeyLandscapeConservation_location --}}
    <div v-show="intervention_level === 'KeyLandscapeConservation'">
        @include('admin.components.module.edit.field.vue', [
            'type' => 'dropdown-KeyLandscapeConservation',
            'v_value' => 'KeyLandscapeConservation_location',
            'id' => "'KeyLandscapeConservation_location'",
            'other' => 'name="KeyLandscapeConservation_location" @change=trigger'
        ])
        <input type="hidden" name="KeyLandscapeConservation_location" v-model="KeyLandscapeConservation_location" />
    </div>

    {{-- administrative_location --}}
    <div v-show="intervention_level === 'administrativeLevels'">
        <input type="hidden"
               v-model="administrative_location"
               name="administrative_location"
               @change=trigger
        />
        <administrative-location
                v-model="administrative_location"
                :init_data='@json($InitVueData)'
                :record_data.sync=administrative_location_record_data
                :label_width=4
                :label_same_row=false
                v-on:administrative_location_updated="administrative_location_updated"
        ></administrative-location>
    </div>

    @if($project_intersection)
        <div v-if="intervention_level !== null && intervention_level !== '' && intervention_level !== 'mondial' && intervention_level !== 'administrativeLevels'">
            <checkbox-boolean
                    id="level_intersections" v-model="level_intersections" label="{{ trans('form/project.level_intersections') }}"
                    @change=trigger
            ></checkbox-boolean>
        </div>
    @endif

</div>

<script>
    new Vue({
        el: '#location_filter',
        data: JSON.parse('{!! App\Library\Utils\Type\JSON::toVue($vue_data) !!}'),

        watch: {
            intervention_level: {
                handler: function (value) {
                    this.clearAll();
                }
            }
        },

        methods: {

            trigger(){
                if(window.location_event){
                    window.dispatchEvent(window.location_event);
                }
            },

            /**
             * Clear all the selections
             */
            clearAll: function () {
                this.continental_location = null;
                this.regional_location = null;
                this.national_location = null;
                this.Concession_location = null;
                this.Landscape_location = null;
                this.KeyLandscapeConservation_location = null;
                this.ProtectedArea_location = null;
                this.administrative_location = null;
                this.administrative_location_record_data = JSON.parse('{!! App\Library\Utils\Type\JSON::toVue($InitEmptyData) !!}');
                this.level_intersections = null;
            },

            administrative_location_updated: function (evt) {
                this.administrative_location = evt.hasOwnProperty(0)
                        && evt[0].hasOwnProperty('selected_id')
                        && evt[0].selected_id!=null
                    ? evt[0].selected_id.toString()
                    : null;
            }

        }
    })
</script>

