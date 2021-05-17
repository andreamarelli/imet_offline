<template>

    <div>

        <div class="list-key-numbers horizontal" style="margin: 10px 0;">
            <div class="list-head" v-if="title!=null">
                {{ title }}
            </div>
            <div>
                <div class="content">
                    <span>Surface (1984)</span>
                    <span class="number">{{ api_data['1984'] | pretty_number(2) }} {{ unit }}</span>
                </div>
            </div>
            <div>
                <div class="content">
                    <span>Surface (2018)</span>
                    <span class="number">{{ api_data['2018'] | pretty_number(2) }} {{ unit }}</span>
                </div>
            </div>
            <div>
                <div class="content">
                    <span>Changement [km2]</span>
                    <span class="number">{{ api_data['change_km2'] | pretty_number(2) }} {{ unit }}</span>
                </div>
            </div>
            <div>
                <div class="content">
                    <span>Changement [%]</span>
                    <span class="number">{{ api_data['change_percent'] | pretty_number(2) }} {{ unit }}</span>
                </div>
            </div>
        </div>

        <chart
            :title=title
            :bars=[chart_data]
            :x_labels="['1984','2018']"
            unit="[Km2]"
            :y_start_at_zero=true
            :colors=colors
            :decimals=2
        ></chart>

    </div>

</template>


<script>

    import base from '../../../components/_base.mixin';

    export default {

        mixins: [
            base
        ],

        props:{
            title:{
                type: String,
                default: ''
            },
            unit: {
                type: String,
                default: '[Km2]'
            },
            colors: {
                type: Array,
                default: () => []
            }
        },

        computed: {
            chart_data: function () {
                return {
                    '1984': this.api_data['1984'],
                    '2018': this.api_data['2018']
                }
            }
        }


    }
</script>
