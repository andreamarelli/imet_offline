<template>
  <div>

    <div id="species">
      <div @click="toggle_species('species')"><h5><span class="fas fa-fw"
                                                        :class="{'fa-caret-up': !show_species,'fa-caret-down':show_species}"></span>
        {{ stores.BaseStore.localization('form/imet/analysis_report/report.management_context.key_species') }}</h5></div>
      <container_actions :data="species" :name="'species'"
                         :event_image="'save_entire_block_as_image'"
                         :exclude_elements="''">
        <template slot-scope="species_data">
          <div>
            <elements :values="species_data.props.group0" :title="stores.BaseStore.localization('form/imet/analysis_report/report.management_context.animal_species')"
                      :comment_title="stores.BaseStore.localization('form/imet/analysis_report/report.management_context.comments_animal_species')"
                      :show_element="show_species">

              <template>
                <div v-if="show_species" class="mb-3">
                  <bar :fields="Object.keys(species_statistics.group0)" :title="stores.BaseStore.localization('form/imet/analysis_report/report.management_context.occurrences_species')" :rotate="30" :zoom="true"
                       :values='Object.values(species_statistics.group0)'></bar>
                </div>
              </template>
            </elements>

            <elements :values="species_data.props.group1"
                      :title="stores.BaseStore.localization('form/imet/analysis_report/report.management_context.plants_species')"
                      :comment_title="stores.BaseStore.localization('form/imet/analysis_report/report.management_context.comments_plants_species')"
                      :show_element="show_species">
              <template>
                <div v-if="show_species" class="mb-3">
                  <bar :fields="Object.keys(species_statistics.group1)" :title="stores.BaseStore.localization('form/imet/analysis_report/report.management_context.occurrences_species')" :rotate="30" :zoom="true"
                       :values='Object.values(species_statistics.group1)'></bar>
                </div>
              </template>
            </elements>
          </div>
        </template>
      </container_actions>

    </div>

    <div id="habitats">
      <div @click="toggle_species('habitats')"><h5><span class="fas fa-fw"
                                                         :class="{'fa-caret-up': !show_habitats,'fa-caret-down':show_habitats}"></span>
        {{stores.BaseStore.localization('form/imet/analysis_report/report.management_context.terrestrial_marine_habitats')}}</h5></div>

      <container_actions :data="habitats" :name="'habitats'"
                         :event_image="'save_entire_block_as_image'"
                         :exclude_elements="''">
        <template slot-scope="habitats_data">
          <elements :values="habitats_data.props" :comment_title="stores.BaseStore.localization('form/imet/analysis_report/report.management_context.comments_terrestrial')"
                    :show_element="show_habitats"></elements>
        </template>
      </container_actions>
    </div>
    <div :id="'climate_change'">
      <div @click="toggle_species('climate')"><h5><span class="fas fa-fw"
                                                        :class="{'fa-caret-up': !show_climate,'fa-caret-down':show_climate}"></span>
        {{stores.BaseStore.localization('form/imet/analysis_report/report.management_context.climate_change')}} </h5></div>
      <container_actions :data="climate_change" :name="'climate_change'"
                         :event_image="'save_entire_block_as_image'"
                         :exclude_elements="''">
        <template slot-scope="climate_change_data">
          <elements :values="climate_change_data.props" :comment_title="stores.BaseStore.localization('form/imet/analysis_report/report.management_context.comments_climate')"
                    :show_element="show_climate"></elements>
        </template>
      </container_actions>
    </div>
    <div id="ecosystem_services">
      <div @click="toggle_species('ecosystem')"><h5><span class="fas fa-fw"
                                                          :class="{'fa-caret-up': !show_ecosystem,'fa-caret-down':show_ecosystem}"></span>
        {{stores.BaseStore.localization('form/imet/analysis_report/report.management_context.ecosystem_services')}} </h5></div>
      <container_actions :data="ecosystem_services" :name="'ecosystem_services'"
                         :event_image="'save_entire_block_as_image'"
                         :exclude_elements="''">
        <template slot-scope="ecosystem_services_data">
          <elements :values="ecosystem_services_data.props" :comment_title="stores.BaseStore.localization('form/imet/analysis_report/report.management_context.comments_ecosystem')"
                    :show_element="show_ecosystem"></elements>
        </template>
      </container_actions>
    </div>

    <div id="threats">
      <div @click="toggle_species('threats')"><h5><span class="fas fa-fw"
                                                        :class="{'fa-caret-up': !show_threats,'fa-caret-down':show_threats}"></span>
        {{stores.BaseStore.localization('form/imet/analysis_report/report.management_context.threats')}}  </h5></div>
      <container_actions :data="threats" :name="'threats'"
                         :event_image="'save_entire_block_as_image'"
                         :exclude_elements="''">
        <template slot-scope="threats_data">
          <elements :values="threats_data.props" :comment_title="stores.BaseStore.localization('form/imet/analysis_report/report.management_context.comments_threats')"
                    :show_element="show_threats"></elements>
        </template>
      </container_actions>
    </div>
  </div>
</template>

<script>

import elements from './management_context/elements'

export default {
  components: {elements},
  inject: ['stores'],
  name: "management_context",
  props: {
    values: {
      type: [Array, Object],
      default: () => {
      }
    }
  },
  data: function () {
    const Locale = window.Locale;
    return {
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
      species_statistics: [],
      load_pop_over: false
    }
  },
  updated: function () {
    if (!this.load_pop_over) {
      this.pop_over();
      this.load_pop_over = true;
    }
  },
  mounted() {
    const {species, climate_change, ecosystem_services, habitats, threats, species_statistics} = this.values;

    this.species = species;
    this.climate_change = climate_change;
    this.ecosystem_services = ecosystem_services;
    this.habitats = habitats;
    this.threats = threats;
    this.species_statistics = species_statistics;
  },
  methods: {
    pop_over: function () {
      $(document).ready(function () {
        $('[data-toggle="popover"]').popover({
          html: true,
          trigger: 'hover',
          content: function () {
            return document
                .getElementById(this.getAttribute('data-popover-content'))
                .querySelector(".popover-body").innerHTML;
          },
          title: function () {
            return document
                .getElementById(this.getAttribute('data-popover-content'))
                .querySelector(".popover-heading").innerHTML;
          }
        });
      });
    },

    show_specific_species(key) {
      return this.species[key].length;
    },
    toggle_species: function (section) {
      this['show_' + section] = !this['show_' + section];
    },
    species_count: function (value) {
      const species = this.species_statistics[value];

      return species > 1 ? ` (${species})` : '';
    }
  }
}
</script>

<style scoped>

</style>