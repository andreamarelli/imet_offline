<template>

    <div class="list-key-numbers">
        <div>
            <div class="content">
                <span class="two_columns" v-for="(item, index) in list">
                    <span>{{ index }}</span>
                    <span >{{ item }}</span>
                </span>
            </div>
        </div>
    </div>

</template>


<script>

    import base from './_base.mixin';

    export default {

        mixins: [base],

        props: {
            sort_by_value : {
                type: Boolean,
                default: false
            },
            sort_by_label : {
                type: Boolean,
                default: false
            }
        },

        data() {
            return {
                list: []
            };
        },

        beforeMount() {
            let _this = this;
            this.list = this.api_data;

            if(this.sort_by_label){
                const ordered = {};
                Object.keys(this.list).sort().forEach(function(key) {
                    ordered[key] = _this.list[key];
                });
                this.list = ordered;
            } else if(this.sort_by_value){
                this.list = Object.fromEntries(
                    Object.entries(_this.list).sort(([,a],[,b]) => b-a)
                )
            }


        },

    }
</script>