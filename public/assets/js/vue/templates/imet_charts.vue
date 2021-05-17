<template>

    <div class="container">

        <!-- ##### Histogram ##### -->
        <div v-if=show_histogram class="imet_histogram">
            <div class="imet_histogram__row" v-for="item in values">
                <!-- label -->
                <div class="text-left imet_histogram__label">{{ item.label }}</div>
                <!-- value -->
                <div class="text-left imet_histogram__value">
                    <b><span v-if="item.value!==null">{{ item.value }}</span></b>
                </div>
                <!-- progress bar -->
                <div class="imet_histogram__progress_bar">
                    <progress_bar
                        :value=item.value
                        :color=item.color
                    />
                </div>
            </div>
        </div>

        <!-- ##### Radar ##### -->
        <div class="imet_radar">
            <imet_radar :values=radar_values :width=380 :height=250 ></imet_radar>
        </div>

    </div>


</template>

<style lang="scss" type="text/scss" scoped>

    .container{
        display: flex;
        width: 100%;
        @media (min-width: 1000px) {
            flex-direction: row;
            .imet_histogram{
                flex-grow: 1;
            }
        }
        @media (max-width: 999px) {
            flex-direction: column;
            align-items: center;
            .imet_histogram{
                width: 100%;
            }
        }
        .imet_histogram{
            .imet_histogram__row{
                display: flex;
                flex-direction: row;
                flex-wrap: nowrap;
                .imet_histogram__label{
                    width: 210px;
                    padding-left: 10px;
                    padding-top: 5px;
                    padding-bottom: 5px;
                }
                .imet_histogram__value{
                    width: 40px;
                }
                .imet_histogram__progress_bar{
                    flex-grow: 1;
                }
            }
         }
        .imet_radar{
            text-align: center;
        }
    }

</style>

<script>

    import Progress_bar from "./progress_bar";
    export default {
        components: {Progress_bar},
        props: {
            form_id: {
                type: [Number, String],
                default: null
            },
            input_data:{
                type: [Object],
                default: () => null
            },
            show_histogram: {
                type: Boolean,
                default: false
            },
            steps: {
                type: Array,
                default: () => {
                    return ['context', 'planning', 'inputs', 'process', 'outputs', 'outcomes' ]
                }
            },
            colors: {
                type: Array,
                default: () => {
                    return ['#FFFF00', '#BFBFBF', '#FFC000', '#00B0F0', '#92D050', '#00B050']
                }
            }
        },

        data: function () {
            return {
                chart: null,
                api_data: null
            }
        },

        beforeMount() {
            if(this.input_data!==null){
                this.api_data = this.input_data;
            }
        },

        mounted(){
            let _this = this;
            if(this.api_data===null){
                this.retrieve_api();
            }
            window.vueBus.$on('refresh_assessment', function () {
                _this.retrieve_api();
            });
        },

        computed: {

            version(){
                return this.api_data!==null ? this.api_data.version : null;
            },

            labels(){
                let _this = this;
                return this.version!==null ? [
                    Locale.getLabel('form/imet/' + _this.version + '/common.steps_eval.context'),
                    Locale.getLabel('form/imet/' + _this.version + '/common.steps_eval.planning'),
                    Locale.getLabel('form/imet/' + _this.version + '/common.steps_eval.inputs'),
                    Locale.getLabel('form/imet/' + _this.version + '/common.steps_eval.process'),
                    Locale.getLabel('form/imet/' + _this.version + '/common.steps_eval.outputs'),
                    Locale.getLabel('form/imet/' + _this.version + '/common.steps_eval.outcomes'),
                ] : [];
            },

            values(){
                let _this = this;
                let values = [];
                this.steps.forEach(function(step, index){
                    values.push({
                        'label': _this.labels[index],
                        'value': _this.get_key_from_api(step),
                        'color': _this.colors[index],
                    });
                });
                return values;
            },

            radar_values(){
                let values = {};
                if(this.values.length>0){
                    Object.entries(this.values).forEach(function([key, value]){
                        values[value.label] = parseFloat(value.value).toFixed(1);
                    });
                }
                return values;
            }

        },

        methods: {

            get_key_from_api(key){
                return this.api_data!==null && this.api_data.hasOwnProperty(key) && this.api_data[key]!==null
                    ? this.api_data[key].toFixed(1)
                    : null;
            },

            retrieve_api: function () {
                let _this = this;
                if(_this.form_id!==null){
                    $.ajax({
                        url: window.Laravel.baseUrl + 'api/imet/assessment/'+_this.form_id,
                        type: "GET",
                        dataType: "json"
                    })
                        .done(function (response) {
                            _this.api_data = response;
                        });
                }
            }
        }

    }
</script>