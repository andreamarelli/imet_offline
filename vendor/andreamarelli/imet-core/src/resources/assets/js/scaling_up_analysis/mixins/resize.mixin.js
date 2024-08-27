export default {
    inject: ['state'],
    props: {
        event_id: {
            type: String,
            default: 'save_image'
        },

    },
    data: function () {
        return {chart: null}
    },
    async mounted() {
        const _this = this;
        this.draw_chart();
        window.addEventListener('resize', this.handleResize)
        this.$parent.$on('save_data', (value, func, attr) => {
            if (_this.chart) {
                const value = _this.chart.getDataURL({
                    pixelRatio: 2,
                    backgroundColor: '#fff'
                });
                func(value, attr)
            }
        });
    },
    beforeDestroy: function () {
        window.removeEventListener('resize', this.handleResize)
    },
    methods: {
        handleResize: function () {
            if (this.chart) {
                this.chart.resize();
            }
        }
    }
}
