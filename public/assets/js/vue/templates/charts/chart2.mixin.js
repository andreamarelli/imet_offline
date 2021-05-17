export default {

    props: {
        title: {
            type: String,
            default: () => null
        },
        lines:{
            type: Array,
            default: () => []
        },
        bars:{
            type: Array,
            default: () => []
        },
        stacked: {
            type: Boolean,
            default: false
        },
        bar_and_line:{
            type: Boolean,
            default: false
        },
        pie: {
            type: Boolean,
            default: false
        },
        lines_labels: {
            type: Array,
            default: () => []
        },
        bars_labels: {
            type: Array,
            default: () => []
        },
        unit: {
            type: String,
            default: () => null
        },
        x_labels:{
            type: Array,
            default: () => null
        },
        y_start_at_zero: {
            type: Boolean,
            default: false
        },
        rotate_x_labels: {
            type: Boolean,
            default: false
        },
        colors: {
            type: Array,
            default: () => [
                '#41925a',
                '#cdc43c',
                '#365078',
                '#765816',
                '#94a34e',
                '#336399',
                '#3ccd72',
                '#6698d3',
                '#3cc1cd',
            ]
        },
        decimals: {
            type: Number,
            default: null
        }
    },

    watch: {
        lines(){
            this.refresh_chart();
        },
        bars(){
            this.refresh_chart();
        }
    },

    data: function () {
        return {
            Locale: window.Locale,

            show: true,
            options: {},
            chart: null,
            x_axis_labels: null
        }
    },

    beforeMount() {
    },

    mounted(){
        this.build_options();
        this.init_chart();
    },

    methods: {

        build_options(){
            this.x_axis_labels = this.x_labels || this.__last_years();
            this.basic_options();
            this.apply_custom_options();
            this.__no_data();
        },

        init_chart(){
            let canvas_container = this.$el;
            this.chart = echarts.init(canvas_container);
            this.chart.setOption(this.options);
        },

        refresh_chart(){
            this.build_options();
            this.chart.setOption(this.options, true);
        },

        /**
         * Set basic common options
         */
        basic_options(){
            this.options.toolbox = {
                feature: {
                    saveAsImage: {
                        type: 'png',
                        name: '',
                        show: true,
                        title: ' '
                    }
                }
            };
            this.options.color = this.colors;

            // Title
            if (this.title != null) {
                this.options.title = {
                    text: this.title,
                    left: 'center'
                };
            }
        },

        /**
         * Set common options for cartesian charts
         */
        set_cartesian_options() {

            // Tooltip
            this.options.tooltip = {
                trigger: 'axis',
                axisPointer: {
                    type: 'line',
                    lineStyle: {
                        opacity: 0.5
                    }
                },
                backgroundColor: '#5b5b5b' // $darkestGray
            };

            // Grid (according to documentation it applies only to line, bar, and scatter)
            this.options.grid = {
                left: '3%',
                right: '3%',
                bottom: '2%',
                top: this.title!=='' ? '12%' : '2%',
                containLabel: true
            };

            // xAxis labels
            this.options.xAxis = [
                {
                    type: 'category',
                    boundaryGap: false,
                    data: null,
                    axisLabel: {
                        interval: 0,
                        rotate: this.rotate_x_labels ? 45 : 0
                    }
                }
            ];

            // yAxis
            this.options.yAxis = [
                {
                    type: 'value',
                    scale: true,
                    splitLine: {
                        show: false
                    },
                    name: this.unit || null,
                    min: this.y_start_at_zero ? 0 : null
                }
            ];
        },

        /**
         * Add legend to chart
         */
        add_legend(){

            let margin = '12%';
            let num_chars = 0;
            this.options.series.forEach(function (item) {
                num_chars += item.name.length;
            })
            if (num_chars>50) {
                margin = '16%';
            }

            this.options.legend = {
                top: 'bottom'
            };
            if(this.options.hasOwnProperty('grid')){
                this.options.grid.bottom = margin;
            }
        },

        /**
         * Apply custom options: to be extended
         */
        apply_custom_options(){},

        /**
         * Check if contains data or not
         * @returns {boolean}
         */
        has_data(){},
        has_data_series(){
            let has_data = false;
            let series = this.options.series;
            if(series !== null){
                series.forEach(function(s, i){
                    if(typeof s.data !== "undefined" && s.data.length>0){
                        s.data.forEach(function (data) {
                            has_data = data!==null ? true : has_data;
                        });
                    }
                });
            }
            return has_data;
        },

        /**
         * Print NO DATA graphics
         *
         * @private
         */
        __no_data(){
            if(!this.has_data()) {
                this.options.graphic = [
                    {
                        id: 'no_data',
                        type: 'text',
                        left: '35%',
                        top: '50%',
                        style: {
                            text: this.Locale.getLabel('mapping.common.no_historic_data'),
                            font: 'bolder 1.7em sans-serif',
                            textAlign: 'center',
                            fill: '#aaa'
                        }
                    }
                ];
                this.options.tooltip = {};
            } else if(this.options.hasOwnProperty('graphic')){
                this.options.graphic = null;
            }
        },

        /**
         * Get last years array
         *
         * @returns {[]}
         * @private
         */
        __last_years(){
            let now = (new Date()).getFullYear();
            let oldest_year = now;
            this.lines.forEach(function (series) {
                for(let year in series){
                    if(series.hasOwnProperty(year)){
                        oldest_year = year<oldest_year ? year : parseInt(oldest_year.toString());
                    }
                }
            });
            this.bars.forEach(function (series) {
                for(let year in series){
                    if(series.hasOwnProperty(year)){
                        oldest_year = year<oldest_year ? year : parseInt(oldest_year.toString());
                    }
                }
            });

            let years = [];
            for (let year = oldest_year; year < now; year++) {
                years.push(year);
            }
            return years;
        },


        /**
         * Re-organize data from API to pair array
         *
         * @param labels
         * @param values
         * @returns {[]}
         */
        parse_values(labels, values){
            let _this = this;
            let data = [];
            if(values!==null){
                labels.forEach(function(year){
                    let value = values.hasOwnProperty(year) ? values[year] : null;
                    value = value!==null && _this.decimals!==null
                        ? parseFloat(value).toFixed(_this.decimals)
                        : value;
                    data.push(value);
                });
            }
            return data
        },

    }
}
