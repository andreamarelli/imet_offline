<template>
    <div>

        <input type="hidden"
               v-model="record_data.selected_id" />

        <div class="module-row" v-for="i in [1,2,3,4]">

            <div class="module-row__label">
                <label>{{ init_data['labels']['level'+i] }}</label>
            </div>

            <div class="module-row__input">
                <select
                        v-model="record_data.selected['level'+i]"
                        class="field-edit"
                        v-bind:disabled="isDisabledLevel(i)"
                        v-on:change="updateLevels(i)"
                >
                    <option value=""> - - </option>
                    <option v-for="(item, index) in record_data.lists['level'+i]" v-bind:value="index" >{{ item }}</option>
                </select>
            </div>

        </div>

    </div>
</template>


<script>
    export default {

        props: {
            label_width: {
                type: Number,
                default: 2
            },
            parent_index: Number,
            init_data: {
                type: Object,
                default: () => {}
            },
            record_data: {
                type: Object,
                default: () => {}
            },
            label_same_row: {
                type: Boolean,
                default: true
            }
        },

        watch: {
            'record_data.selected_id': {
                handler: function () {
                    this.$emit('administrative_location_updated',
                        [this.record_data, this.parent_index]
                    );
                },
                deep: true
            }
        },

        methods: {

            updateLevels: function(currentLevel){

                let self = this;
                let nextLevel = currentLevel+1;
                let currentLevelValue = this.record_data.selected['level'+currentLevel] || null;

                // Populate next sub-level
                if(currentLevel===1){
                    this.__clean(currentLevel);
                    this.record_data.lists['level2'] = this.init_data['level2'][currentLevelValue];
                    this.record_data.selected_id = this.init_data['country_ids'][currentLevelValue];
                }
                else if(nextLevel!==null && currentLevelValue!==null) {

                    this.__clean(currentLevel);

                    $.ajax({
                        url: window.Laravel.baseUrl + 'ajax/administration_levels',
                        type: "POST",
                        dataType: "json",
                        data: {
                            '_token': window.Laravel.csrfToken,
                            'level': nextLevel,
                            'selected': currentLevelValue
                        }
                    })
                        .done(function(response){
                            if(response.hasOwnProperty('sub_level_list')){
                                Vue.set(self.record_data.lists, 'level'+nextLevel, response['sub_level_list']);
                            }
                            if(response.hasOwnProperty('record_id')){
                                self.record_data.selected_id = response['record_id'].toString();
                            } else {
                                self.record_data.selected_id = null;
                            }
                        })
                        .fail(function(error){
                            console.log(error);
                        });
                }
            },

            isDisabledLevel: function(level){
                return this.record_data.lists['level'+level]===null;
            },

            __clean: function(currentLevel){
                currentLevel = currentLevel + 1 || 1;
                for (let i = currentLevel; i < 5; i++) {
                    this.record_data.selected['level'+i] = null;
                    this.record_data.lists['level'+i] = null;
                }
            }

        }
    }
</script>