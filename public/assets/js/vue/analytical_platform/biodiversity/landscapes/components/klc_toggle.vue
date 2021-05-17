<template>

    <div class="text-center">

        <button @click="toggle_klc('klc')"
                class="btn-nav rounded"
                :class="{active: is_active('klc')}"
        >{{ Locale.getLabel('mapping.platform.cards.biodiversity.klc.action_buttons.klc') }}</button>

        <button @click="toggle_klc('klc_without_pas')"
                class="btn-nav rounded"
                :class="{active: is_active('klc_without_pas')}"
        >{{ Locale.getLabel('mapping.platform.cards.biodiversity.klc.action_buttons.klc_without_pas') }}</button>

        <button v-if=include_pas @click="toggle_klc('protected_areas')"
                class="btn-nav rounded"
                :class="{active: is_active('protected_areas')}"
        >{{ Locale.getLabel('mapping.platform.cards.biodiversity.klc.action_buttons.protected_areas') }}</button>

        <div v-if="pa_list!==null">
            <button v-for="(name, id) in pa_list" @click="toggle_klc('protected_area_' + id)"
                    class="btn-nav small rounded"
                    :class="{active: is_active('protected_area_' + id)}">
                {{ name }}
            </button>
        </div>

    </div>


</template>

<style lang="scss" scoped>

button{
    margin: 2px;
}

</style>

<script>
import base from '../../../components/_base.mixin';
import visible_components from "../../../../../mapping_mapbox/mixins/visible_components";

export default {

    mixins: [
        base,
        visible_components
    ],

    props: {
        theme: {
            type: String,
            default: null
        },
        include_pas: {
            type: Boolean,
            default: false
        },
        pa_list:{
            type: Object,
            default: () => null
        }
    },

    methods:{

        component_id(component){
            return this.theme + '.' + component;
        },

        is_active(component){
            return this.is_component_visible(this.component_id(component));
        },

        toggle_klc(component){
            let _this = this;
            let component_id = this.component_id(component);

            // hide other components of the same card
            ['klc', 'klc_without_pas', 'protected_areas'].forEach(function(item){
                let item_id = _this.component_id(item)
                if(item_id!==component_id){
                    _this.hide_component(item_id);
                }
            });
            if(this.pa_list!=null){
                Object.keys(_this.pa_list).forEach(function(id) {
                    let item = _this.component_id('protected_area_' + id)
                    if(item!==component_id){
                        _this.hide_component(item);
                    }
                });
            }

            // toggle selected
            Vue.nextTick(function () {
                _this.toggle_component(component_id);
            });
        },

    }

}
</script>
