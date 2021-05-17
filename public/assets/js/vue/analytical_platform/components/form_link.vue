<template>

    <div class="data-form-link">
        <a :href=link target="_blank" class="btn-nav small rounded">{{ Locale.getLabel('mapping.common.go_to_data') }}</a>
    </div>

</template>

<script>
    export default {

        props: {
            code: {
                type: String,
                default: ''
            },
            item: {
                type: [Number, String],
                default: ''
            },
            step: {
                type: [Number, String],
                default: ''
            }
        },

        data: function () {
            return {
                Locale: window.Locale,
            }
        },

        computed:{
            link: function () {
                let link =  window.Laravel.baseUrl + 'monitoring_system/national_indicators/' + this.code +'/'+this.item+'/publish/'+this.step;
//                if(this.year!==''){
//                    link += '&year=' + this.year;
//                }
                return link;
            }
        }


    }
</script>