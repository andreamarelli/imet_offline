<template>

    <div class="data data-source" v-if="source_list!==null">
        {{ Locale.getLabel('mapping.common.data_source') }}&nbsp;
        <strong>{{ source_list }}</strong>
    </div>

</template>

<script>
    export default {

        props: {
            source: {
                type: [Object, String],
                default: ''
            },
        },

        computed: {
            source_list: function () {
                if(typeof this.source === 'string' && this.source!==null){
                    return this.source!=='' ? this.source : null;
                } else if(typeof this.source === 'object'&& this.source !== null){
                    let sources = [];
                    Object.values(this.source).forEach(function(value) {
                        if(value!==null && !sources.includes(value)){
                            sources.push(value);
                        }
                    });
                    return sources.join(', ');
                }
                return null;
            }
        },

        data: function () {
            return {
                Locale: window.Locale,
            }
        }
    }
</script>