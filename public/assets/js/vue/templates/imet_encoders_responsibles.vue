<template>
    
    <div class="imet_responsible">
        
        <div v-if="to_be_shown['internal'].length>0">
            <b>{{ Locale.getLabel('form/imet/common.responsible_internal') }}</b>:<br />
            <ul>
                <li v-for="resp in to_be_shown['internal']"
                    >{{ resp['Name'] }} <span v-if="resp['Institution']"><i>({{ resp['Institution'] }})</i></span></li>
            </ul>
        </div>

        <div v-if="to_be_shown['external'].length>0">
            <b>{{ Locale.getLabel('form/imet/common.responsible_external') }}</b>:
            <ul>
                <li v-for="resp in to_be_shown['external']"
                    >{{ resp['Name'] }} <span v-if="resp['Institution']"><i>({{ resp['Institution'] }})</i></span></li>
            </ul>
        </div>

        <div v-if="to_be_shown['encoders'].length>0">
            <b>{{ Locale.getLabel('form/imet/common.encoders') }}</b>:
            <ul>
                <li v-for="resp in to_be_shown['encoders']"
                    >{{ resp['name']}} <span v-if="resp['institution']"><i>({{ resp['institution'] }})</i></span></li>
            </ul>
        </div>


        <button class="btn btn-sm" v-if="total_count>max_visible && !showHidden" @click=toggleShown ><i class="fas fa-plus-square" /> {{ Locale.getLabel('common.view_all') }}</button>
        <button class="btn btn-sm" v-if="showHidden" @click=toggleShown ><i class="fas fa-minus-square" /> {{ Locale.getLabel('common.hide') }}</button>

    </div>


</template>

<style lang="scss" type="text/scss" scoped>

</style>

<script>

    export default {

        props: {
            max_visible: {
                type: Number,
                default: 4
            },
            items: {
                type: [String, Object],
                default: () => {
                    return {
                        'internal': [],
                        'external': [],
                        'encoders': [],
                    }
                }
            }
        },

        data: function () {
            return {
                Locale: window.Locale,
                showHidden: false,
            }
        },

        computed: {
            total_count(){
                return this.items['internal'].length
                    + this.items['external'].length
                    + this.items['encoders'].length;
            },
            to_be_shown(){
                let _this = this;
                let items = {
                    'internal': [],
                    'external': [],
                    'encoders': [],
                };

                let current_shown = 0;
                this.items['internal'].forEach(function (item) {
                    if(current_shown<_this.max_visible || _this.showHidden){
                        items['internal'].push(item);
                    }
                    current_shown++;
                });
                this.items['external'].forEach(function (item) {
                    if(current_shown<_this.max_visible || _this.showHidden){
                        items['external'].push(item);
                    }
                    current_shown++;
                });
                this.items['encoders'].forEach(function (item) {
                    if(current_shown<_this.max_visible || _this.showHidden){
                        items['encoders'].push(item);
                    }
                    current_shown++;
                });
                return items;
            }
        },

        methods: {

            toggleShown(){
                this.showHidden = !this.showHidden;
            }

        }
    }

</script>