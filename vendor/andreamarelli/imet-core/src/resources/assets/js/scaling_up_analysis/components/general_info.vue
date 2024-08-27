<template>
    <div id="general-elements">
        <div class="flex gap-3">
            <div class="strong">{{
                    stores.BaseStore.localization('imet-core::analysis_report.general_info.country')
                }}:
            </div>
            {{ info.countries }}
        </div>
        <div class="flex gap-3">
            <template>
                <div class="strong">{{
                        stores.BaseStore.localization('imet-core::analysis_report.general_info.network')
                    }}:
                </div>
                {{ info.network}}
            </template>
        </div>
        <div class="flex gap-3">
            <div class="strong">
                {{
                    stores.BaseStore.localization('imet-core::analysis_report.general_info.total_surface_protected')
                }}:
            </div>
            {{ info.total_surface_protected_areas }} [km2]
        </div>
        <div class="flex gap-3">
            <div class="strong">
                {{ stores.BaseStore.localization('imet-core::analysis_report.general_info.ecoregions') }}:
            </div>
            {{ info.eco_regions }}
        </div>
        <div class="flex gap-3">
            <div class="strong">{{
                    stores.BaseStore.localization('imet-core::analysis_report.general_info.vision')
                }}:
            </div>
            {{ info.local_vision }}
        </div>
        <div class="flex gap-3">
            <div class="strong">{{
                    stores.BaseStore.localization('imet-core::analysis_report.general_info.mission')
                }}:
            </div>
            {{ info.local_mission }}
        </div>
        <div class="flex gap-3">
            <div class="strong">{{
                    stores.BaseStore.localization('imet-core::analysis_report.general_info.objectives')
                }}:
            </div>
            {{ info.local_objective }}
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
                local_vision: null,
                local_mission: null,
                local_objective: null,
                landscapes: null,
                values_network: null
            }
        }
    },
    mounted() {
        this.init(this.values);
    },
    methods: {
        network_of:function(){
            const net = [];
            for(const item in this.info.network){
                net.push(this.info.network[item]);
            }

            return net.join(', ');
        },

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
