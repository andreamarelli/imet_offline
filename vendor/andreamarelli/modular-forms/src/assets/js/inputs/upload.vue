<template>

    <span>

        <input name="file_upload" type="file" v-show="false" v-on:change="validateFile">

        <modal-selector
                class="selector-upload"
                :parent-id=id
                :modal-title=uploadFileLabel
        >

            <template v-slot:custom_anchor>
                <!-- File  -->
               <span class="field-enabled field-edit">
                   {{ value instanceof Object ? value.original_filename : value }}
               </span>
                <!-- Download link button -->
                <a class="btn-nav dark small" target="_blank" v-bind:href="value.download_link" v-if="!changed && value.original_filename!==null">
                     <i class="fa fa-cloud-download-alt white" />
                </a>
                <!-- Delete Button -->
                <button type="button" class="btn-nav small red" v-if="value.original_filename!==null" v-on:click="deleteSelection">
                    <i class="fa fa-times-circle white" />
                </button>
                <!-- Upload Button-->
                <button type="button" class="btn-nav small" v-if="value.original_filename===null" v-on:click="openModal">
                    <i class="fa fa-upload white" />&nbsp;{{ uploadFileLabel }}
                </button>
            </template>

            <template v-slot:modal_anchor>&nbsp;</template>

            <template v-slot:modal_content>
                <div class="modal-body">

                    <span v-if="!isFileSelected">
                        <label>
                            {{ Locale.getLabel('modular-forms::common.upload.no_file_selected') }}
                        </label>
                        &nbsp;&nbsp;
                        <!-- Select Button -->
                        <button type="button" v-on:click="openFileSelection" class="btn-nav small">
                            <i class="fa fa-folder-open white" />
                            {{ Locale.getLabel('modular-forms::common.upload.select_file') }}
                        </button>
                    </span>

                    <span v-if="isFileSelected">
                        <label>
                            <span class="text-info">
                                <i class="fa fa-file" />&nbsp;{{ selectedFileName }}
                            </span>
                        </label>
                        &nbsp;&nbsp;
                        <!-- Upload Button -->
                        <button type="button" v-on:click="uploadFile" class="btn-nav small" v-if="!uploading">
                            <i class="fa fa-upload white" />
                            {{ Locale.getLabel('modular-forms::common.upload.upload') }}
                        </button>

                        <!-- Uploading -->
                        <i v-if="uploading" class="fa fa-spinner fa-spin fa-2x green-800"></i>

                    </span>

                </div>
            </template>


        </modal-selector>

    </span>

</template>
<style lang="scss" scoped>



    .modal_selector.selector-upload{

        margin-top: 3px;
        .field-enabled{
            cursor: default;
            display: inline-block;
            /* padding: 8px 12px; */
            margin-right: 4px;
            /* max-width: 380px; */
            /* min-width: 150px; */
            vertical-align: middle;
            overflow: hidden;
            text-overflow: ellipsis;
            a, a:hover{
                text-decoration: none;
            }
        }
        .field-edit{
            max-width: 450px;
        }

    }

</style>


<script>

    import modal from './components/modal-selector.vue';

    export default {

        components: {
            'modal-selector': modal
        },

        mixins: [
            window.ModularForms.MixinsVue.values
        ],

        props: {
            uploadFileLabel: {
                type: String,
                default: () => {
                    return Locale.getLabel('modular-forms::common.upload.upload_file')
                },
            },
            allowedFormats: {
                type: Array,
                default: function () {
                    return null;
                }
            }
        },

        data () {
            return {
                Locale: window.Locale,
                isFileSelected: false,
                selectedFile: null,
                selectedFileName: null,
                modalId: 'upload-modal_' + this.id,
                changed: false,
                uploading: false,
            }
        },

        watch: {
            inputValue: function(value){
                if(value.changed === false){
                    this.changed = false;
                }
            }
        },

        mounted(){
            this.container = this.$el;
            this.modalComponent = this.$children[0];
        },

        methods: {

            openModal(){
                this.modalComponent.openModal();
            },

            beforeModalClose: function () {
                this.reset();
            },

            reset: function(){
                this.isFileSelected = false;
                this.selectedFile = null;
                this.selectedFileName =  null;
                this.changed = false;
            },

            openFileSelection: function () {
                this.container
                    .querySelector('input[name="file_upload"]')
                    .click();
            },

            validateFile: function(event){

                let errorMessage = null;
                this.modalComponent.resetError();

                if(event.target.files.length>0){

                    this.selectedFile = event.target.files[0];
                    this.selectedFileName =  this.selectedFile.name;
                    this.isFileSelected = true;
                    let extension = this.selectedFileName.split('.').pop();

                    // Prevent upload if too big
                    if(this.selectedFile.size > 50000000){
                        errorMessage = Locale.getLabel('modular-forms::common.upload.too_big');
                        this.isFileSelected = false;
                    }

                    // Check for allowed formats
                    if(this.allowedFormats!==null && !this.allowedFormats.includes(extension)){
                        errorMessage = Locale.getLabel('modular-forms::common.upload.not_valid_format');
                        this.isFileSelected = false;
                    }

                    let regex = /^[a-zA-Z0-9-_.&()\s]{1,250}\.[a-zA-Z0-9]{2,5}$/;
                    if(!regex.test(this.selectedFileName)){
                        errorMessage = Locale.getLabel('modular-forms::common.upload.not_valid_filename');
                         this.isFileSelected = false;
                    }
                }

                if(errorMessage!==null){
                    this.modalComponent.setError(errorMessage);
                }

                event.target.value = '';
            },

            uploadFile: function () {
                let _this = this;
                let data = new FormData();
                data.append('_token', window.Laravel.csrfToken);
                data.append('file_upload', this.selectedFile);
                this.uploading = true;

                window.axios({
                    method: 'post',
                    url: window.Laravel.baseUrl + 'ajax/upload',
                    data: data
                })
                    .then(function (response) {
                        _this.applySelection(response.data);
                    })
                    .catch(function (response) {
                        _this.modalComponent.setError(Locale.getLabel('modular-forms::common.upload.error'));
                    })
                    .finally(function (response) {
                        _this.uploading = false;
                        _this.loading = false;
                        _this.changed = true;
                    });
            },

            applySelection: function(response){
                let value = {
                    'original_filename': response.original_filename,
                    'temp_filename': response.temp_filename,
                    'download_link': response['download_link'],
                    'changed': true
                };
                this.emitValue(value);
                this.modalComponent.closeModal();
            },

            deleteSelection: function () {
                this.changed = true;
                this.emitValue({
                    'original_filename': null,
                    'temp_filename': null,
                    'download_link': null,
                    'changed': true
                });
            },

        }

    }
</script>
