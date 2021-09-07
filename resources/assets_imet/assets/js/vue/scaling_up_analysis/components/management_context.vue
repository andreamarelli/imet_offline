<template>
  <div>
    <div id="species">
      <div @click="toggle_species('species')"><h5><span class="fas fa-fw"
                                                        :class="{'fa-caret-up': !show_species,'fa-caret-down':show_species}"></span>
        {{ stores.BaseStore.localization('form/imet/analysis_report/report.management_context.key_species') }}</h5>
      </div>
      <container_actions :data="species" :name="'species'"
                         :comment_title="stores.BaseStore.localization('form/imet/analysis_report/report.management_context.comments_plants_species')"
                         :event_image="'save_entire_block_as_image'"
                         :exclude_elements="''">
        <template slot-scope="species_data">
          <div>
            <elements :values="species_data.props.group0"
                      :title="stores.BaseStore.localization('form/imet/analysis_report/report.management_context.animal_species')"
                      :comment_title="stores.BaseStore.localization('form/imet/analysis_report/report.management_context.comments_animal_species')"
                      :show_element="show_species">

              <template>
                <div v-if="show_species && show_group0" class="mb-3">
                  <bar :fields="Object.keys(species_statistics_group0)"
                       :title="stores.BaseStore.localization('form/imet/analysis_report/report.management_context.occurrences_species')"
                       :rotate="45" :zoom="true"
                       :values='Object.values(species_statistics_group0)'></bar>
                </div>
              </template>
            </elements>
            <elements :values="species_data.props.group1"
                      :title="stores.BaseStore.localization('form/imet/analysis_report/report.management_context.plants_species')"
                      :show_element="show_species">
              <template>
                <div v-if="show_species && show_group1" class="mb-3">
                  <bar :fields="Object.keys(species_statistics_group1)"
                       :title="stores.BaseStore.localization('form/imet/analysis_report/report.management_context.occurrences_plants')"
                       :rotate="45" :zoom="true"
                       :values='Object.values(species_statistics_group1)'></bar>
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
        {{
          stores.BaseStore.localization('form/imet/analysis_report/report.management_context.terrestrial_marine_habitats')
        }}
      </h5></div>
      <container_actions :data="habitats" :name="'habitats'"
                         :event_image="'save_entire_block_as_image'"
                         :comment_title="stores.BaseStore.localization('form/imet/analysis_report/report.management_context.comments_terrestrial')"
                         :exclude_elements="''">
        <template slot-scope="habitats_data">
          <elements :values="habitats_data.props"
                    :show_element="show_habitats">
            <template>
              <div v-if="show_habitats" class="mb-3">
                <bar :fields="Object.keys(habitats_statistics)"
                     :title="stores.BaseStore.localization('form/imet/analysis_report/report.management_context.occurrences_habitats')"
                     :rotate="45" :zoom="true"
                     :values='Object.values(habitats_statistics)'></bar>
              </div>
            </template>
          </elements>
        </template>
      </container_actions>
    </div>
    <div :id="'climate_change'">
      <div @click="toggle_species('climate')"><h5><span class="fas fa-fw"
                                                        :class="{'fa-caret-up': !show_climate,'fa-caret-down':show_climate}"></span>
        {{ stores.BaseStore.localization('form/imet/analysis_report/report.management_context.climate_change') }} </h5>
      </div>
      <container_actions :data="climate_change" :name="'climate_change'"
                         :event_image="'save_entire_block_as_image'"
                         :comment_title="stores.BaseStore.localization('form/imet/analysis_report/report.management_context.comments_climate')"
                         :exclude_elements="''">
        <template slot-scope="climate_change_data">
          <elements :values="climate_change_data.props"
                    :show_element="show_climate">
            <template>
              <div v-if="show_climate" class="mb-3">
                <bar :fields="Object.keys(climate_change_statistics)"
                     :title="stores.BaseStore.localization('form/imet/analysis_report/report.management_context.occurrences_climate')"
                     :rotate="60" :zoom="true"
                     :values='Object.values(climate_change_statistics)'></bar>
              </div>
            </template>
          </elements>
        </template>
      </container_actions>
    </div>
    <div id="ecosystem_services">
      <div @click="toggle_species('ecosystem')"><h5><span class="fas fa-fw"
                                                          :class="{'fa-caret-up': !show_ecosystem,'fa-caret-down':show_ecosystem}"></span>
        {{ stores.BaseStore.localization('form/imet/analysis_report/report.management_context.ecosystem_services') }}
      </h5></div>
      <container_actions :data="ecosystem_services" :name="'ecosystem_services'"
                         :event_image="'save_entire_block_as_image'"
                         :comment_title="stores.BaseStore.localization('form/imet/analysis_report/report.management_context.comments_ecosystem')"
                         :exclude_elements="''">
        <template slot-scope="ecosystem_services_data">
          <elements :values="ecosystem_services_data.props"
                    :show_element="show_ecosystem">
            <template>
              <div v-if="show_ecosystem" class="mb-3">
                <bar :fields="Object.keys(ecosystem_services_statistics)"
                     :title="stores.BaseStore.localization('form/imet/analysis_report/report.management_context.occurrences_ecosystem_services')"
                     :rotate="45" :zoom="true"
                     :values='Object.values(ecosystem_services_statistics)'></bar>
              </div>
            </template>
          </elements>
        </template>
      </container_actions>
    </div>
    <div id="threats">
      <div @click="toggle_species('threats')"><h5><span class="fas fa-fw"
                                                        :class="{'fa-caret-up': !show_threats,'fa-caret-down':show_threats}"></span>
        {{ stores.BaseStore.localization('form/imet/analysis_report/report.management_context.label_threats') }} </h5>
      </div>
      <container_actions :data="threats" :name="'threats'"
                         :event_image="'save_entire_block_as_image'"
                         :comment_title="stores.BaseStore.localization('form/imet/analysis_report/report.management_context.comments_threats')"
                         :exclude_elements="''">
        <template slot-scope="threats_data">
          <elements :values="threats_data.props"
                    :show_element="show_threats">
            <template>
              <div v-if="show_threats" class="mb-3">
                <bar :fields="Object.keys(threats_statistics)"
                     :title="stores.BaseStore.localization('form/imet/analysis_report/report.management_context.occurrences_threats')"
                     :rotate="30" :zoom="true"
                     :values='Object.values(threats_statistics)'></bar>
              </div>
            </template>
          </elements>
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
      threats_statistics: [],
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
    } = this.values;

    this.species = species;
    this.climate_change = climate_change;
    this.ecosystem_services = ecosystem_services;
    this.habitats = habitats;
    this.threats = threats;
    const group0 = Object.entries(species_statistics.group0);
    const group1 = Object.entries(species_statistics.group1);
    this.show_group0 = group0.length;
    this.show_group1 = group1.length;
    this.species_statistics_group0 = Object.fromEntries(group0);
    this.species_statistics_group1 = Object.fromEntries(group1);

    this.climate_change_statistics = climate_change_statistics;
    this.habitats_statistics = habitats_statistics;
    this.ecosystem_services_statistics = ecosystem_services_statistics;
    this.threats_statistics = threats_statistics;
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