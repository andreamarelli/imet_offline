export default {

    data (){
        return {
            tooltipEnabled: false,
        }
    },

    methods:{

        addTooltip: function(){
            let _this = this;
            if(this.tooltipEnabled && this.value!==null){
                $(this.container).tooltip({
                    title: _this.value,
                    trigger: 'hover'
                });
            }
        },

        updateTooltip: function (value) {
            $(this.container).attr('data-original-title', value);
        },

    },

    watch: {
        value () {
            if(this.tooltipEnabled){
                this.updateTooltip(this.value);
            }
        }
    }
}