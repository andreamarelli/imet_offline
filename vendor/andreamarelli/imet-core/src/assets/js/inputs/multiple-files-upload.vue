<template>
    <div>
        <vue-dropzone
            ref="myVueDropzone"
            id="dropzone"
            :options="options"
            :useCustomSlot="true"
            v-on:vdropzone-error="uploadError"
            v-on:vdropzone-processing="processing"
            v-on:vdropzone-success="uploadedSuccessfully"
            v-on:vdropzone-file-added="fileAdded"
        >
            <div class="dropzone-custom-content" style="margin-top: 100px">
                <h3 class="dropzone-custom-title">{{ Locale.getLabel('modular-forms::common.upload.multiple_files_description') }}</h3>
            </div>
        </vue-dropzone>
        <a class="btn-nav" v-show="files_added>0 && files_added===files_uploaded" :href=backUrl>
          {{ Locale.getLabel('modular-forms::common.go_back') }}
        </a>
    </div>
</template>

<script>
export default {
    name: "multipleUpload.vue",
    components: {
        vueDropzone: window.VueDropzone
    },
    props:{
        uploadUrl: {
            type: String,
            default: null
        },
        backUrl:{
          type: String,
          default: null
        },
    },
    data() {
        const Locale = window.Locale;
        return {
            Locale: Locale,
            modalIsOpen: false,
            options: {
                url: this.uploadUrl,
                previewTemplate: this.template(),
                params: {
                    _token: window.Laravel.csrfToken
                },
                addRemoveLinks: true,
                clickable: true,
                maxFiles: 20,
                maxFilesize: 150,
                timeout: 100000,
                acceptedFiles: ".json,.zip",
                autoProcessQueue: true,
                dictDefaultMessage: Locale.getLabel('modular-forms::common.upload.dict_default_message'),
                dictFallbackMessage: Locale.getLabel('modular-forms::common.upload.dict_fallback_message'),
                dictFallbackText: Locale.getLabel('modular-forms::common.upload.dict_fallback_text'),
                dictFileTooBig: Locale.getLabel('modular-forms::common.upload.dict_file_too_big'),
                dictInvalidFileType: Locale.getLabel('modular-forms::common.upload.dict_invalid_file_type'),
                dictResponseError: Locale.getLabel('modular-forms::common.upload.dict_response_error'),
                dictCancelUpload: Locale.getLabel('modular-forms::common.upload.dict_cancel_upload'),
                dictUploadCanceled: Locale.getLabel('modular-forms::common.upload.dict_upload_canceled'),
                dictRemoveFile: Locale.getLabel('modular-forms::common.upload.dict_remove_file'),
                dictMaxFilesExceeded: Locale.getLabel('modular-forms::common.upload.dictMaxFilesExceeded'),
            },
            formatTypes: ["application/json", "application/zip"],
            files_added: 0,
            files_uploaded: 0
        };
    },
    beforeCreate: function (){
      this.options.url = this.uploadUrl;
    },
    mounted: function () {
        window.confirm = function () {
            return true;
        };
    },
    methods: {
        template: function () {
            return `<div class="table table-striped files" id="previews">
                <div id="template" class="file-row">
                    <div>
                        <p class="name" data-dz-name></p>
                    </div>
                    <div>
                        <p class="size" data-dz-size></p>
                    </div>
                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"
                             aria-valuenow="0">
                        <div class="progress-bar progress-bar-success" id="total-progress" style="width:0%;" data-dz-uploadprogress></div>
                    </div>
                </div>
            </div>
        `;
        },

        progressBarConfiguration(file, label, color = 'blue', width = '100%') {
            const selector = file.previewTemplate.querySelector("#total-progress.progress-bar");
            selector.innerHTML = label;
            selector.style.backgroundColor = color;
            selector.style.color = "white";
            selector.style.width = width;
        },

        fileAdded(file) {
            this.files_added++
            //remove the last file and added to the top of the list
            const nodesArray = [...this.$refs.myVueDropzone.$el.children];
            const fileAdded = nodesArray.pop();
            nodesArray.unshift(fileAdded);
            const dropzoneArea = document.querySelector("#dropzone");
            dropzoneArea.append(...nodesArray);
        },

        uploadError(file, message) {
            this.files_uploaded++;
            let errorMessage = Locale.getLabel('modular-forms::common.upload.upload_error');
            if (message['message']) {
                errorMessage += message['message'];
            } else if (!this.formatTypes.includes(file.type)) {
                errorMessage = Locale.getLabel('modular-forms::common.upload.not_valid_format');
            } else {
                errorMessage += message;
            }
            this.progressBarConfiguration(file, errorMessage, 'red', '100%');
        },

        processing(file) {
            this.progressBarConfiguration(file, Locale.getLabel('modular-forms::common.upload.uploading'));
        },

        uploadedSuccessfully(file, response) {
            this.files_uploaded++;
            let message = Locale.getLabel('modular-forms::common.upload.uploaded');
            if (response.length > 1) {
                let filesDidNotUploaded = 0;
                response.forEach((r => {
                    if (r.status !== 'error') {
                        filesDidNotUploaded++;
                    }
                }))
                const totalFiles = response.length;
                message += Locale.getLabel('modular-forms::common.upload.not_all_imported').replace("{{filesDidNotUploaded}}", filesDidNotUploaded).replace("{{totalFiles}}", totalFiles);
            }
            this.progressBarConfiguration(file, message, "green");
        }
    }
}

</script>

<style lang="scss">
.vue-dropzone {
    height: 300px;
    max-height:300px;
    overflow:auto;
    background:#fff;
    margin-bottom: 10px;

    .files{
        display: flex;
        gap: 30px;
        .file-row{
            flex-grow: 1;
            display: flex;
            flex-direction: row;
            gap: 15px;
            .progress{
                flex-grow: 1;
            }
        }
    }

  a.dz-remove{
    display: none;
  }

}
</style>
