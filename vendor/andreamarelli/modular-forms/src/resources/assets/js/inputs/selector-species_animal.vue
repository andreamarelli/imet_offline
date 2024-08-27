<template>

    <selector-dialog
        v-model="inputValue"
        :parent-id=id
        :search-url=searchUrl
        :with-insert=withInsert
        ref="selectorDialogComponent"
    >

        <!-- api search - result search filters -->
        <template v-slot:searchResultFilters>
            <i>{{ Locale.getLabel('modular-forms::common.filter_results') }}: </i>&nbsp;&nbsp;
            {{ Locale.getLabel('modular-forms::entities.biodiversity.taxonomy.class') }}
            <select v-model=filterByClass v-on:change="filterList(true)" class="field-edit filterByClass">
                <option v-for="option in classes">
                    {{ option }}
                </option>
            </select>
            {{ Locale.getLabel('modular-forms::entities.biodiversity.taxonomy.order') }}
            <select v-model=filterByOrder v-on:change="filterList(false)" class="field-edit filterByOrder">
                <option v-for="option in orderByClass()">
                    {{ option }}
                </option>
            </select>
        </template>

        <!-- api search - result header -->
        <template v-slot:searchResultHeader>
            <th>{{ Locale.getLabel('modular-forms::entities.biodiversity.species', 1) }}</th>
            <th>{{ Locale.getLabel('modular-forms::entities.biodiversity.red_list_category') }}</th>
            <th>{{ Locale.getLabel('modular-forms::entities.biodiversity.red_list') }}</th>
        </template>

        <!-- api search - result items -->
        <template #searchResultItem="{ item }">
            <td><span class="result_left" v-html="getSpeciesDescription(item)"></span></td>
            <td><redlist_category :category=item.iucn_redlist_category></redlist_category></td>
            <td><a target="_blank" :href="'http://www.iucnredlist.org/details/'+item.iucn_redlist_id+'/0'"><img style="display: inline-block" :src=redListImgUrl alt="IUCN RedList"/></a></td>
        </template>

    </selector-dialog>


</template>

<style lang="scss" scoped>
    .result_left{
        text-align: left;
    }
    .field-edit.filterByClass,
    .field-edit.filterByOrder{
        width: 200px;
        margin: 0 5px;
    }
</style>


<script setup>

    import {ref, provide} from "vue";
    import selectorDialog from "./components/selector-dialog.vue";
    import redlist_category from "../templates/redlist_category.vue";
    import redListImgUrl from "../../images/iucn_red_list.png";
    const Locale = window.ModularForms.Helpers.Locale;

    const props = defineProps({
        id: {
            type: String,
            default: null
        },
        searchUrl: {
            type: String,
            default: null
        },
        withInsert: {
            type: Boolean,
            default: false,
        }
    });

    // components, injections & expose
    const selectorDialogComponent = ref(null);
    provide('setLabel', setLabel);
    provide('setValue', setValue);
    provide('afterSearch', afterSearch);

    // values
    const inputValue = defineModel();
    const filterByClass = ref(null);
    const filterByOrder = ref(null);
    const orders = ref([]);
    const classes = ref([]);

    function setLabel(item){
        if(typeof item === "object"){
            // return scientific name
            return item.genus + ' ' + item.species;
        }
        else if(item.split("|").length>3){
            let taxonomy = item.split("|");
            return taxonomy[4] + ' ' + taxonomy[5]
        }
        return item;
    }

    function setValue(item){
        if (typeof item == "object") {
            // return full taxonomy
            return item.phylum
                + '|' + item.class
                + '|' + item.order
                + '|' + item.family
                + '|' + item.genus
                + '|' + item.species
        }
        return item;
    }

    function getSpeciesDescription(item) {
        let description = '<div>' + item.class + ' ' + item.order + ' ' + item.family + ' <b>' + item.genus + ' ' + item.species + '</b>' + '</div>';
        if (hasCommonNames(item)) {
            description += '<div class="common_names"><b><i>' + Locale.getLabel('modular-forms::entities.biodiversity.common_names') + ':</i></b><br />';
            if (item.common_name_en !== null && item.common_name_en.toLowerCase() !== 'null') {
                description += '<div><span class="fi fi-gb"></span> ' + item.common_name_en.replace(/\,/g, ', ') + '</div>'
            }
            if (item.common_name_fr !== null && item.common_name_fr.toLowerCase() !== 'null') {
                description += '<div><span class="fi fi-fr"></span> ' + item.common_name_fr.replace(/\,/g, ', ') + '</div>'
            }
            if (item.common_name_sp !== null && item.common_name_sp.toLowerCase() !== 'null') {
                description += '<div><span class="fi fi-es"></span> ' + item.common_name_sp.replace(/\,/g, ', ') + '</div>'
            }
            description += '</div>';
        }
        return description;
    }

    function hasCommonNames(item) {
        return (item.common_name_en !== null || item.common_name_fr !== null || item.common_name_sp !== null);
    }

    function afterSearch(data){
        orders.value = data['orders'];
        classes.value = data['classes'];
        filterByOrder.value = null;
        filterByClass.value = null;
    }

    function orderByClass(){
        return filterByClass.value!=null
            ? orders.value[filterByClass.value]
            : [];
    }

    function filterList(alsoResetOrder){
        if(alsoResetOrder){
            filterByOrder.value = null;
        }
        filterByOrder.value = typeof filterByOrder.value === "undefined" ? null : filterByOrder.value;
        selectorDialogComponent.value.filterShowList({
            'class': filterByClass.value,
            'order': filterByOrder.value,
        });
    }



</script>
