<template>
    <div>

        <div>

            <h5 @click="toggle_species('species')">
                <span class="fas fa-fw" :class="{'fa-caret-up': !data.show_species,'fa-caret-down':data.show_species}"></span>
                {{ stores.BaseStore.localization('imet-core::analysis_report.management_context.key_species') }}
            </h5>
            <container_actions
                :data="data.species"
                :name="'species'"
                :comment_title="stores.BaseStore.localization('imet-core::analysis_report.management_context.comments_plants_species')"
                :event_image="'save_entire_block_as_image'"
                :exclude_elements="''">
                <template v-slot:default="species_data">

                    <div id="species" v-if="data.show_species">
                        <elements :values="species_data.props.group0"
                                  :title="stores.BaseStore.localization('imet-core::analysis_report.management_context.animal_species')"
                                  :comment_title="stores.BaseStore.localization('imet-core::analysis_report.management_context.comments_animal_species')"
                                  :show_element="data.show_species">

                            <template v-slot>

                                <div v-if="data.show_species && data.show_group0" class="mb-3">
                                     <imet_bar_chart :fields="remove_parenthesis_words(Object.keys(data.species_statistics_group0))"
                                         :title_data="stores.BaseStore.localization('imet-core::analysis_report.management_context.animal_species_chart')"
                                         :title="stores.BaseStore.localization('imet-core::analysis_report.management_context.occurrences_species')"
                                         :rotate="0" :zoom="true"
                                         :values='Object.values(data.species_statistics_group0)'></imet_bar_chart>
                                </div>
                            </template>
                        </elements>
                        <elements :values="species_data.props.group1"
                                  :title="stores.BaseStore.localization('imet-core::analysis_report.management_context.plants_species')"
                                  :show_element="data.show_species">
                            <template v-slot>
                                <div v-if="data.show_species && data.show_group1" class="mb-3">
                                    <imet_bar_chart :fields="remove_parenthesis_words(Object.keys(data.species_statistics_group1))"
                                         :title_data="stores.BaseStore.localization('imet-core::analysis_report.management_context.plant_species_chart')"
                                         :title="stores.BaseStore.localization('imet-core::analysis_report.management_context.occurrences_plants')"
                                         :rotate="0" :zoom="true"
                                         :values='Object.values(data.species_statistics_group1)'></imet_bar_chart>
                                </div>
                            </template>
                        </elements>
                    </div>
                </template>
            </container_actions>

        </div>

        <div>

            <h5 @click="toggle_species('habitats')">
                <span class="fas fa-fw" :class="{'fa-caret-up': !data.show_habitats,'fa-caret-down':data.show_habitats}"></span>
                {{
                    stores.BaseStore.localization('imet-core::analysis_report.management_context.terrestrial_marine_habitats')
                }}
            </h5>

            <container_actions :data="data.habitats" :name="'habitats'"
                               :event_image="'save_entire_block_as_image'"
                               :comment_title="stores.BaseStore.localization('imet-core::analysis_report.management_context.comments_terrestrial')"
                               :exclude_elements="''">
                <template v-slot:default="habitats_data">
                    <div id="habitats"  v-if="data.show_habitats">
                        <elements :values="habitats_data.props"
                                  :show_element="data.show_habitats">
                            <template v-slot>
                                <div v-if="data.show_habitats" class="mb-3">
                                    <imet_bar_chart :fields="remove_parenthesis_words(Object.keys(data.habitats_statistics))"
                                         :title_data="stores.BaseStore.localization('imet-core::analysis_report.management_context.habitats_chart')"
                                         :title="stores.BaseStore.localization('imet-core::analysis_report.management_context.occurrences_habitats')"
                                         :rotate="0" :zoom="true"
                                         :values='Object.values(data.habitats_statistics)'></imet_bar_chart>
                                </div>
                            </template>
                        </elements>
                    </div>
                </template>
            </container_actions>
        </div>
        <div>
            <div @click="toggle_species('climate')"><h5><span class="fas fa-fw"
                                                              :class="{'fa-caret-up': !data.show_climate,'fa-caret-down':data.show_climate}"></span>
                {{ stores.BaseStore.localization('imet-core::analysis_report.management_context.climate_change') }}
            </h5>
            </div>
            <container_actions :data="data.climate_change" :name="'climate_change'"
                               :event_image="'save_entire_block_as_image'"
                               :comment_title="stores.BaseStore.localization('imet-core::analysis_report.management_context.comments_climate')"
                               :exclude_elements="''">
                <template v-slot:default="climate_change_data">
                    <div :id="'climate_change'" v-if="data.show_climate">
                        <elements :values="climate_change_data.props"
                                  :show_element="data.show_climate">
                            <template v-slot>
                                <div v-if="data.show_climate" class="mb-3">
                                    <imet_bar_chart :fields="remove_parenthesis_words(Object.keys(data.climate_change_statistics))"
                                         :title_data="stores.BaseStore.localization('imet-core::analysis_report.management_context.values_sensitive_chart')"
                                         :title="stores.BaseStore.localization('imet-core::analysis_report.management_context.occurrences_climate')"
                                         :rotate="0" :zoom="true"
                                         :values='Object.values(data.climate_change_statistics)'></imet_bar_chart>
                                </div>
                            </template>
                        </elements>
                    </div>
                </template>
            </container_actions>
        </div>
        <div>
            <div @click="toggle_species('ecosystem')"><h5><span class="fas fa-fw"
                                                                :class="{'fa-caret-up': !data.show_ecosystem,'fa-caret-down':data.show_ecosystem}"></span>
                {{ stores.BaseStore.localization('imet-core::analysis_report.management_context.ecosystem_services') }}
            </h5></div>
            <container_actions :data="data.ecosystem_services" :name="'ecosystem_services'"
                               :event_image="'save_entire_block_as_image'"
                               :comment_title="stores.BaseStore.localization('imet-core::analysis_report.management_context.comments_ecosystem')"
                               :exclude_elements="''">
                <template v-slot:default="ecosystem_services_data">
                    <div :id="'ecosystem_services'" v-if="data.show_ecosystem">
                        <elements :values="ecosystem_services_data.props"
                                  :show_element="data.show_ecosystem">
                            <template v-slot>
                                <div class="mb-3">
                                    <imet_bar_chart :fields="remove_parenthesis_words(Object.keys(data.ecosystem_services_statistics))"
                                         :title_data="stores.BaseStore.localization('imet-core::analysis_report.management_context.ecosystem_services_chart')"
                                         :title="stores.BaseStore.localization('imet-core::analysis_report.management_context.occurrences_ecosystem_services')"
                                         :rotate="0" :zoom="true"
                                         :values='Object.values(data.ecosystem_services_statistics)'></imet_bar_chart>
                                </div>
                            </template>
                        </elements>
                    </div>
                </template>
            </container_actions>
        </div>

        <div>
            <div @click="toggle_species('threats')"><h5><span class="fas fa-fw"
                                                              :class="{'fa-caret-up': !data.show_threats,'fa-caret-down':data.show_threats}"></span>
                {{ stores.BaseStore.localization('imet-core::analysis_report.management_context.label_threats') }} </h5>
            </div>
            <container_actions :data="data.threats" :name="'threats'"
                               :event_image="'save_entire_block_as_image'"
                               :comment_title="stores.BaseStore.localization('imet-core::analysis_report.management_context.comments_threats')"
                               :exclude_elements="''">
                <template v-slot:default="threats_data">
                    <div id="threats" v-if="data.show_threats">
                        <elements :values="threats_data.props"
                                  :show_element="data.show_threats">
                            <template v-slot>
                                <div class="mb-3">
                                     <imet_bar_chart :fields="remove_parenthesis_words(Object.keys(data.threats_statistics))"
                                         :title="stores.BaseStore.localization('imet-core::analysis_report.management_context.occurrences_threats')"
                                         :title_data="stores.BaseStore.localization('imet-core::analysis_report.management_context.threats_charts')"
                                         :rotate="0" :zoom="true"
                                         :values='Object.values(data.threats_statistics)'></imet_bar_chart>
                                </div>
                            </template>
                        </elements>
                    </div>
                </template>
            </container_actions>
        </div>
    </div>
</template>

<script setup>

import elements from "./management_context/elements.vue"
import imet_bar_chart from "../../templates/imet_bar_chart.vue"

import {ref, onMounted, inject, reactive} from 'vue';

const props = defineProps({
    values: {
        type: [Array, Object],
        default: () => {
        }
    }
});

const stores = inject('stores');
const Locale = window.Locale;
const data = reactive({
    Locale: Locale,
    show_species: false,
    show_habitats: false,
    show_climate: false,
    show_ecosystem: false,
    show_threats: false,
    species: [],
    climate_change: [],
    ecosystem_services: [],
    habitats: [],
    threats: [],
    items: [],
    species_statistics_group0: [],
    show_group0: true,
    show_group1: true,
    species_statistics_group1: [],
    habitats_statistics: [],
    climate_change_statistics: [],
    show_bar_climate: false,
    show_bar_habitats: false,
    show_bar_ecosystem_services: false,
    show_bar_threats: false,
    ecosystem_services_statistics: [],
    threats_statistics: []
});


onMounted(
    () => {
        const {
            species,
            climate_change,
            ecosystem_services,
            habitats,
            threats,
            species_statistics,
            habitats_statistics,
            climate_change_statistics,
            ecosystem_services_statistics,
            threats_statistics
        } = props.values;

        data.species = species;
        data.climate_change = climate_change;
        data.ecosystem_services = ecosystem_services;
        data.habitats = habitats;
        data.threats = threats;
        const group0 = Object.entries(species_statistics.group0);
        const group1 = Object.entries(species_statistics.group1);
        data.show_group0 = group0.length;
        data.show_group1 = group1.length;
        data.species_statistics_group0 = Object.fromEntries(group0);
        data.species_statistics_group1 = Object.fromEntries(group1);
        data.climate_change_statistics = climate_change_statistics;
        data.habitats_statistics = habitats_statistics;
        data.ecosystem_services_statistics = ecosystem_services_statistics;
        data.threats_statistics = threats_statistics;
    }
);


function remove_parenthesis_words(string) {
    let words = [];
    string.forEach(function (item) {
        words.push(item.replace(/ *\([^)]*\) */g, ""));
    });
    // //break sentence by space when is longer than 10 characters
    words.forEach(function (item, index) {
        if (item.length > 10) {
            words[index] = item.replace(/ /g, "\n") + " ";
        }
    });

    return words;
}

function show_specific_species(key) {
    return data.species[key].length;
}

function toggle_species(section) {
    data['show_' + section] = !data['show_' + section];
}

function species_count(value) {
    const species = data.species_statistics[value];

    return species > 1 ? ` (${species})` : '';
}

</script>
