<template>

    <div>
        <span :class="[compact ? 'compact' : '', 'red-list_'+category]"
              data-toggle="tooltip" data-placement="top"
              :title=category_plain>
            {{ category }}
        </span>
    </div>

</template>


<script>

    export default {

        data: function () {
            return {
                Locale: window.Locale
            }
        },

        props: {
            category: {
                type: String,
                default: null
            },
            compact:{
                type: Boolean,
                default: false
            }
        },

        computed: {
            category_plain(){
                return Locale.getLabel('modular-forms::entities.biodiversity.red_list_categories.'+this.category)
            }
        },

        mounted() {
            let elements = this.$el.querySelector('[data-toggle="tooltip"]');
            $(elements).tooltip();

            // $('[data-toggle="tooltip"]').tooltip();
        }

    }

</script>
