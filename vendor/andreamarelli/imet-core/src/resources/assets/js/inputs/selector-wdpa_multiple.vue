<template>

    <selectorDialog
        :parent-id=id
        :search-url=searchUrl
    >

        <!-- dialog anchor -->
        <template v-slot:selector-anchor>
            <span class="field-preview">
                <span class="item dontOpenDialog" v-for="item in inputValuesObj">
                    {{ item.label }}
                    <i class="fa fa-times removeItem" @click="removeItem(item.id)"></i>
                </span>
            </span>
        </template>

        <!-- api search - result header -->
        <template v-slot:selector-api-search-result-header>
            <th>{{ Locale.getLabel('imet-core::common.name') }}</th>
            <th>{{ Locale.getLabel('imet-core::common.protected_area.wdpa_id',1) }}</th>
            <th>{{ Locale.getLabel('imet-core::common.country') }}</th>
            <th>{{Locale.getLabel('imet-core::common.protected_area.iucn_category') }}</th>
        </template>

        <!-- api search - result items -->
        <template v-slot:selector-api-search-result-item="{ item }">
            <td><span class="result_left"><b>{{ item.name }}</b></span></td>
            <td><a v-if="item.wdpa_id!==null" target="_blank" :href="'https://www.protectedplanet.net/'+item.wdpa_id">{{ item.wdpa_id }}</a></td>
            <td>{{ item.country_name }}</td>
            <td>{{ item.iucn_category }}</td>
        </template>

    </selectorDialog>

</template>

<style lang="scss" scoped>

    .result_left{
      text-align: left;
    }
    .field-preview {
      min-width: 80px;
      display: flex;
      gap: 3px;
      max-width: none;
      vertical-align: top;
      padding: 3px 7px;

      .item{
        display: flex;
        gap: 3px;
        align-items: center;
        width: fit-content;
        padding: 0 3px;
        margin: 1px 0;
        @apply bg-gray-100 border border-gray-300 rounded;
        line-height: 1.4;

        i.removeItem {
          @apply text-red-400;
          cursor: pointer;
          &:hover {
            @apply text-gray-800;
          }
        }
      }


    }
</style>

<script>


export default {

    // components: {
    //     selectorDialog: selectorDialog
    // },

    mixins: [
        window.ModularForms.MixinsVue.values
    ],

    props: {
        searchUrl: {
            type: String,
            default: null
        },
        labelsUrl: {
            type: String,
            default: ''
        }
    },

    data (){
        return {
            Locale: window.Locale,
            assetPath: window.ModularForms.assetPath,
            searchComponent: null,
            selectorComponent: null,
            inputValue: null,
            inputValuesObj: [],
            inputValuesString: '',
        }
    },

    computed:{
        anchorLabel(){
            if(this.selectorComponent!==null && this.selectorComponent.selectedValue !== null){
                return this.selectorComponent.selectedValue['name'];
            }
            return null;
        },
    },

    mounted (){
        this.getPaLabels(this.value);
        this.selectorComponent = this.$children[0];
        this.searchComponent = this.$children[0].$children[0].$children[0];
    },

    methods: {

        getPaLabels(value) {
            let _this = this;
            this.inputValuesObj = [];
            this.inputValuesString = '';

            if (value !==null) {
                fetch(this.labelsUrl, {
                    method: 'POST',
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-Token": window.Laravel.csrfToken,
                    },
                    body: JSON.stringify({
                        ids: value
                    }),
                })
                    .then((response) => response.json())
                    .then(function(data){
                        if (Object.values(data).length > 0) {
                            Object.values(data).forEach(function (item) {
                                _this.pushItem(item);
                            });
                        }
                    })
                    .catch(function (error) {});
            }
        },

        getSelectedValue(value){
            this.pushItem({
                id: value.wdpa_id,
                label: value.name,
            });
            return this.inputValuesString;
        },

        pushItem(item){
            if(item!==null && item!==''){
                this.inputValuesObj.push({
                    id: item.id,
                    label: item.label
                });
                if(this.inputValuesString!==''){
                    this.inputValuesString += ',';
                }
                this.inputValuesString += item.id;
            }
        },

        removeItem(id){
            let values = this.inputValuesString
                .replace(id, '')
                .split(',')
                .filter(function(el) { return el !== ''; });
            this.inputValuesString = values.toString();

            let inputValuesObj = [];
            this.inputValuesObj.forEach(function (item) {
                if(item['id']!==id){
                    inputValuesObj.push(item);
                }
            });
            this.inputValuesObj = inputValuesObj;
            this.selectorComponent.emitValue(this.inputValuesString);
        }

    }



}
</script>
