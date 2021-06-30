<template>  
 <div class="data data-country">        
<button @click="toggle_hidden(name_to_toggle)" class="btn-nav rounded" >
    {{ Locale.getLabel('mapping.common.data_country') }}
</button>
        
        <div class="list-key-numbers" style="margin-top: 20px;"
             v-if="is_hidden_component_visible(name_to_toggle)">
            <div class="list-head">
                {{ Locale.getLabel('mapping.common.details_year') }}
            </div>
            
            <table class="lines">
            <tr v-for="(item,value) in source" v-if="Array.isArray(item) && item.length">
                <td>  {{ value }}&nbsp;({{ item.length }}&nbsp;pays)</td>
                <td> {{ item | country_names }} </td>      
            </tr>               
            </table>
        </div>
    </div>

</template>

<script>
    import base from './_base.mixin';

    export default {
        mixins: [base],
        props: {
            source : {
                type: [Object, Array],
                default: []
            },
            name_to_toggle : {
                type: [String],
                default: 'target'
            }
        },

        filters: {
            country_names : function (value) {
                
                let data = (typeof value !== 'undefined' && value.length > 0) ? value.join(', ')  : null;
                
                return data ;
                }
            }
    }
</script>