<template>
  <div style="display: flex;" id="general-elements">
    <div>
      <div>
        <div class="strong">{{
            stores.BaseStore.localization('imet-core::analysis_report.general_info.country')
          }}:
        </div>
        {{ info.countries }}
      </div>
      <div>
        <template>
          <div class="strong">{{
              stores.BaseStore.localization('imet-core::analysis_report.general_info.network')
            }}:
          </div>
          {{ info.network }}
        </template>
      </div>
<!--      <div>-->
<!--        <div class="strong">-->
<!--          {{ stores.BaseStore.localization('imet-core::analysis_report.general_info.transbondary_name') }}:-->
<!--        </div>-->
<!--        {{ info.landscapes }}-->
<!--      </div>-->
<!--      <div>-->
<!--        <div class="strong">-->
<!--          {{ stores.BaseStore.localization('imet-core::analysis_report.general_info.category_protected_area') }}:-->
<!--        </div>-->
<!--        {{ info.categories }}-->
<!--      </div>-->
<!--      <div>-->
<!--        <div class="strong">-->
<!--          {{ stores.BaseStore.localization('imet-core::analysis_report.general_info.main_values') }}:-->
<!--        </div>-->
<!--        {{ info.values_network }}-->
<!--      </div>-->
      <div>
        <div class="strong">
          {{ stores.BaseStore.localization('imet-core::analysis_report.general_info.total_surface_protected') }}:
        </div>
        {{ info.total_surface_protected_areas }} [km2]
      </div>
<!--      <div>-->
<!--        <div class="strong">-->
<!--          {{ stores.BaseStore.localization('imet-core::analysis_report.general_info.total_surface_landscape') }}:-->
<!--        </div>-->
<!--        {{ info.total_surface_area_of_landscape_protected_areas }} [km2]-->
<!--      </div>-->
<!--      <div>-->
<!--        <div class="strong">{{ stores.BaseStore.localization('imet-core::analysis_report.general_info.agency') }}:-->
<!--        </div>-->
<!--        {{ info.agencies }}-->
<!--      </div>-->
      <div>
        <div class="strong">{{
            stores.BaseStore.localization('imet-core::analysis_report.general_info.ecoregions')
          }}:
        </div>
        {{ info.eco_regions }}
      </div>
      <div>
        <div class="strong">{{ stores.BaseStore.localization('imet-core::analysis_report.general_info.vision') }}:
        </div>
        {{ info.LocalVision }}
      </div>
      <div>
        <div class="strong">{{
            stores.BaseStore.localization('imet-core::analysis_report.general_info.mission')
          }}:
        </div>
        {{ info.LocalMission }}
      </div>
      <div>
        <div class="strong">{{
            stores.BaseStore.localization('imet-core::analysis_report.general_info.objectives')
          }}:
        </div>
        {{ info.LocalObjective }}
      </div>
    </div>
  </div>
</template>

<script>


export default {
  name: "general_info",
  inject: ['stores'],
  props: {
    values: {
      type: [Array, Object],
      default: () => {
      }
    }
  },
  data: function () {
    return {
      info: {
        countries: null,
        network: null,
        categories: null,
        total_surface_protected_areas: null,
        total_surface_area_of_landscape_protected_areas: null,
        agencies: null,
        eco_regions: null,
        LocalVision: null,
        LocalMission: null,
        LocalObjective: null,
        landscapes: null,
        values_network:null
      }
    }
  },
  mounted() {
    this.init(this.values);
  },
  methods: {
    init: function (response) {

      Object.entries(this.info).forEach(object => {
        if (Array.isArray(response.general_info?.[object[0]])) {
          this.info[object[0]] = response.general_info?.[object[0]]?.filter(i => i).join(', ');
        } else {
          this.info[object[0]] = response.general_info?.[object[0]];
        }
      });
    }
  }
}


</script>

<style scoped>

</style>
