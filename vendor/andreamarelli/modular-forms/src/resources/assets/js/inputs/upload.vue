<template>

    <dialog-box ref="dialogComponent">

        <!-- ###################################################### -->
        <!-- ######################  anchor  ###################### -->
        <!-- ###################################################### -->
        <template v-slot:dialog-anchor>

            <div class="upload-anchor dontOpenDialog">

                <!-- File name  -->
                <span class="field-preview upload-filename">
                   {{ inputValue instanceof Object ? inputValue.original_filename : inputValue }}
                </span>

                <!-- Download link button -->
                <a class="btn-nav dark small" target="_blank"
                   :href="inputValue.download_link"
                   v-show="inputValue.original_filename!==null">
                    <i class="fa fa-cloud-download-alt white" />
                </a>

                <!-- Delete Button -->
                <button type="button" class="btn-nav small red"
                        v-show="inputValue.original_filename!==null"
                        v-on:click=deleteSelection>
                    <i class="fa fa-times-circle white" />
                </button>

                <!-- Upload Button -->
                <button type="button" class="btn-nav small"
                        v-show="inputValue.original_filename===null"
                        v-on:click=openUploadDialog>
                    <i class="fa fa-upload white" />&nbsp;
                    {{ Locale.getLabel('modular-forms::common.upload.upload_file') }}
                </button>

            </div>

        </template>

        <!-- ###################################################### -->
        <!-- ######################  dialog  ###################### -->
        <!-- ###################################################### -->
        <template v-slot:dialog-content>

            <input ref="fileInput" name="file_upload" type="file" v-show="false" v-on:change="validateFile">

            <div class="with_header_and_footer">

                <!-- dialog header -->
                <div class="header">
                    <div class="dialog-title">{{ Locale.getLabel('modular-forms::common.upload.upload_file') }}</div>
                    <button type="button" class="close" v-on:click=closeUploadDialog><i class="fa fa-times black"></i></button>
                </div>

                <!-- dialog body -->
                <div class="body">

                    <!-- Select file -->
                    <span v-if="!isFileSelected">
                        <label>
                            {{ Locale.getLabel('modular-forms::common.upload.no_file_selected') }}
                        </label>
                        &nbsp;&nbsp;
                        <!-- open selection dialog button -->
                        <button type="button" v-on:click="openFileSelection" class="btn-nav small">
                            <i class="fa fa-folder-open white" />
                            {{ Locale.getLabel('modular-forms::common.upload.select_file') }}
                        </button>
                    </span>

                    <!-- Upload selected file -->
                    <span v-if="isFileSelected">
                         <!-- selected filename -->
                        <label>
                            <span class="text-info">
                                <i class="fa fa-file" />&nbsp;{{ selectedFileName }}
                            </span>
                        </label>
                        &nbsp;&nbsp;
                        <!-- upload spinner -->
                         <i v-if="isUploading" class="fa fa-spinner fa-spin fa-2x green-800"></i>
                        <!-- start upload button -->
                        <button type="button" v-on:click="uploadFile" class="btn-nav small" :class="{ hidden: isUploading }">
                            <i class="fa fa-upload white" />
                            {{ Locale.getLabel('modular-forms::common.upload.upload') }}
                        </button>

                    </span>

                </div>

                <!-- dialog footer -->
                <div class="footer" v-show="errorMessage!=null">
                    <div class="error text-sm">{{ errorMessage }}</div>
                </div>

            </div>

        </template>

    </dialog-box>


</template>

<style lang="scss" scoped>

    .upload-anchor{
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: flex-start;
        column-gap: 5px;

        button{
            white-space: nowrap;
        }

        a.btn-nav{
            cursor: pointer;
        }

        .upload-filename{
            min-width: 300px;
        }

    }

    button{
        &.hidden{
            display: none;
        }
    }

    .with_header_and_footer{
        min-width: 200px;
        max-width: 500px;
        .body{
            margin: 20px 0 10px 0;
            text-align: center;
        }
    }

</style>

<script setup>

    import {ref, provide, onMounted} from "vue";
    const Locale = window.ModularForms.Helpers.Locale;

    const props = defineProps({
        uploadUrl: {
            type: String,
            default: null
        },
        allowedFormats: {
            type: Array,
            default: function () {
                return null;
            }
        },
        maxFileSize: {
            type: Number,
            default: 10000000   // 10Mb
        }
    });

    // components, injections & expose
    const dialogComponent = ref(null);
    const fileInput = ref(null);

    // values
    const inputValue = defineModel();
    let isFileSelected = ref(false);
    let selectedFile = ref(null);
    let selectedFileName = ref(null);
    let errorMessage = ref(null);
    let isUploading = ref(false);


    function openUploadDialog(){
        resetUploadDialog();
        dialogComponent.value.openDialog();
    }

    function closeUploadDialog(){
        dialogComponent.value.closeDialog();
        resetUploadDialog();
    }

    function resetUploadDialog(){
        isFileSelected.value = false;
        selectedFile.value = null;
        selectedFileName.value =  null;
    }

    function openFileSelection(){
        fileInput.value.click();
    }

    function validateFile(event){

        errorMessage.value = null;
        let message = null;

        if(event.target.files.length>0){

            selectedFile.value = event.target.files[0];
            selectedFileName.value = selectedFile.value.name;
            isFileSelected.value = true;
            let extension = selectedFileName.value.split('.').pop();

            // Prevent upload if too big
            if(selectedFile.value.size > props.maxFileSize){
                message = Locale.getLabel('modular-forms::common.upload.too_big');
                message = message.replace('__maxFileSize__', props.maxFileSize/1000000);
                isFileSelected.value = false;
            }

            // Check for allowed formats
            if(props.allowedFormats!==null && !props.allowedFormats.includes(extension)){
                message = Locale.getLabel('modular-forms::common.upload.not_valid_format');
                isFileSelected.value = false;
            }

            let regex = /^[a-zA-Z0-9-_.&()\s]{1,250}\.[a-zA-Z0-9]{2,5}$/;
            if(!regex.test(selectedFileName.value)){
                message = Locale.getLabel('modular-forms::common.upload.not_valid_filename');
                isFileSelected.value = false;
            }
        }

        if(message!==null){
            errorMessage.value = message;
        }

        event.target.value = '';
    }

    function uploadFile() {
        isUploading.value = true;

        let data = new FormData();
        data.append('file_upload', selectedFile.value);


        fetch(props.uploadUrl, {
            method: 'post',
            headers: {
                "X-CSRF-Token": window.Laravel.csrfToken
            },
            body: data
        })
            .then((response) => response.json())
            .then(function(data){
                applyAndClose(data);
            })
            .catch(function (data) {
                errorMessage.value = Locale.getLabel('modular-forms::common.upload.error');
            })
            .finally(function (data) {
                isUploading.value = false;
            });
    }

    function applyAndClose(response){
        inputValue.value =  {
            'original_filename': response.original_filename,
            'temp_filename': response.temp_filename,
            'download_link': response['download_link'],
            'changed': true
        };
        closeUploadDialog();
    }

    function deleteSelection(){
        inputValue.value = {
            'original_filename': null,
            'temp_filename': null,
            'download_link': null,
            'changed': true
        };
    }




</script>
