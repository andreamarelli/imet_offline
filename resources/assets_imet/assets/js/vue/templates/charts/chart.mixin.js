export default {

    props: {
        title: {
            type: String,
            default: () => null
        },
        input_data: {
            type: [Array, Object],
            default: () => null
        },
        num_years: {
            type: Number,
            default: 15
        },
        unit: {
            type: String,
            default: () => null
        },
    },

    watch: {
        input_data(){
            this.refresh_chart();
        }
    },

    data: function () {
        return {
            Locale: window.Locale,
            colors: [
                '#41925a',
                '#cdc43c',
                '#365078',
                '#765816',
                '#94a34e',
                '#336399',
                '#3ccd72',
                '#6698d3',
                '#3cc1cd',
            ],
            show: true,
            options: {},
            chart: null,
            years: null,
            yy: null
        }
    },

    beforeMount() {
        this.years = this.__last_years();
        this.yy = this.__years();
    },

    mounted(){
        this.build_options();
        this.init_chart();
    },

    methods: {

        build_options(){
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
                    data: null
                }
            ];

            // yAxis
            this.options.yAxis = [
                {
                    type: 'value',
                    scale: true,
                    splitLine: {
                        show: false
                    }
                }
            ];

        },

        /**
         * Add legend to chart
         */
        add_legend(){
            this.options.legend = {
                top: 'bottom'
            };
            if(this.options.hasOwnProperty('grid')){
                this.options.grid.bottom = '12%';
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
        has_data_series(series){
            let has_data = false;
            series = series || this.options.series;
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
         * @param num_years
         * @returns {[]}
         * @private
         */
        __last_years(num_years = null) {
            num_years = num_years!==null ? num_years : this.num_years;
            let years = [];
            let now = (new Date()).getFullYear();
            for (let year = now - num_years; year < now; year++) {
                years.push(year);
            }
            return years;
        },
        __years(){
            let now = (new Date()).getFullYear();
            let oldest_year = now;
            if(Array.isArray(this.input_data)){
                this.input_data.forEach(function (series) {
                    for(let year in series){
                        if(series.hasOwnProperty(year)){
                            oldest_year = year<oldest_year ? year : oldest_year;
                        }
                    }
                });
            }
            oldest_year = parseInt(oldest_year+"");
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
            let data = [];
            if(values!==null){
                labels.forEach(function(year){
                    data.push(
                        values.hasOwnProperty(year)
                            ? values[year]
                            : null
                    );
                });
            }
            return data
        },

    }
}