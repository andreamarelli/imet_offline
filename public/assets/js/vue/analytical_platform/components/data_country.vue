<template>
 <div class="data data-country">
<button @click="toggle_component(name_to_toggle)" class="btn-nav rounded" >
    {{ Locale.getLabel('mapping.common.data_country') }}
</button>

        <div class="list-key-numbers" style="margin-top: 20px;"
             v-if="is_component_visible(name_to_toggle)">
            <div class="list-head">
                {{ Locale.getLabel('mapping.common.details_year') }}
            </div>

            <table class="lines">
                <tbody>
                    <tr v-for="(item,value) in source" v-if="Array.isArray(item) && item.length">
                        <td>  {{ value }}&nbsp;({{ item.length }}&nbsp;pays)</td>
                        <td><country_list :api_data=item ></country_list></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</template>

<script>
    import base from './_base.mixin';
    import visible_components from "../../../mapping_mapbox/mixins/visible_components";

    export default {
        mixins: [
            base,
            visible_components
        ],
        props: {
            source : {
                type: [Object, Array],
                default: []
            },
            name_to_toggle : {
                type: [String],
                default: 'target'
            }
        }
    }
</script>
