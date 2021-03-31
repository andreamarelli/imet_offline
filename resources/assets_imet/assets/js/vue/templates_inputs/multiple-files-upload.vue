<template>
  <div>
    <button class="btn btn-danger mb-2" v-on:click="clearDropzone">{{ Locale.getLabel('common.upload.remove_all') }}</button>
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
        <h3 class="dropzone-custom-title">{{ Locale.getLabel('common.upload.multiple_files_description') }}</h3>
      </div>
    </vue-dropzone>
  </div>
</template>

<script>


import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";

export default {
  name: "multipleUpload.vue",
  components: {
    vueDropzone: vue2Dropzone
  },
  data() {
    const Locale = window.Locale;
    return {
      Locale: Locale,
      modalIsOpen: false,
      options: {
        url: window.Laravel.baseUrl + 'admin/imet/ajax/upload',
        previewTemplate: this.template(),
        params: {
          _token: window.Laravel.csrfToken
        },
        addRemoveLinks: true,
        clickable: true,
        maxFiles: 10,
        maxFilesize: 1,
        acceptedFiles: ".json,.zip",
        autoProcessQueue: true,
        dictDefaultMessage: Locale.getLabel('common.upload.dict_default_message'),
        dictFallbackMessage: Locale.getLabel('common.upload.dict_fallback_message'),
        dictFallbackText: Locale.getLabel('common.upload.dict_fallback_text'),
        dictFileTooBig: Locale.getLabel('common.upload.dict_file_too_big'),
        dictInvalidFileType: Locale.getLabel('common.upload.dict_invalid_file_type'),
        dictResponseError: Locale.getLabel('common.upload.dict_response_error'),
        dictCancelUpload: Locale.getLabel('common.upload.dict_cancel_upload'),
        dictUploadCanceled: Locale.getLabel('common.upload.dict_upload_canceled'),
        dictRemoveFile: Locale.getLabel('common.upload.dict_remove_file'),
        dictMaxFilesExceeded: Locale.getLabel('common.upload.dictMaxFilesExceeded'),
      },
      formatTypes: ["application/json", "application/zip"]
    };
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
                        <span class="preview"><img data-dz-thumbnail/></span>
                    </div>
                     <div>
                        <p class="name" data-dz-name></p>
                    </div>
                    <div>
                        <p class="size" data-dz-size></p>
                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"
                             aria-valuenow="0">
                            <div class="progress-bar progress-bar-success" id="total-progress" style="width:0%;" data-dz-uploadprogress></div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    },
    hideShowRemoveLink(file, value) {
      file.previewTemplate.querySelector("a.dz-remove").style.display = value;
    },
    clearDropzone() {
      this.$refs.myVueDropzone.removeAllFiles();
    },
    progressBarConfiguration(file, label, color = 'blue', width = '100%') {
      const selector = file.previewTemplate.querySelector("#total-progress.progress-bar");
      selector.innerHTML = label;
      selector.style.backgroundColor = color;
      selector.style.color = "white";
      selector.style.width = width;
    },
    fileAdded(file) {
      this.hideShowRemoveLink(file, 'none');

      //remove the last file and added to the top of the list
      const nodesArray = [...this.$refs.myVueDropzone.$el.children];
      const fileAdded = nodesArray.pop();
      nodesArray.unshift(fileAdded);
      const dropzoneArea = document.querySelector("#dropzone");
      dropzoneArea.append(...nodesArray);
    },
    uploadError(file, message) {
      let errorMessage = Locale.getLabel('common.upload.upload_error');
      if (message['message']) {
        errorMessage += message['message'];
      } else if (!this.formatTypes.includes(file.type)) {
        errorMessage = Locale.getLabel('common.upload.not_valid_format');
      } else {
        errorMessage += message;
      }
      this.hideShowRemoveLink(file, 'block');
      this.progressBarConfiguration(file, errorMessage, 'red', '100%');
    },
    processing(file) {
      this.progressBarConfiguration(file, Locale.getLabel('common.upload.uploading'));
    },
    uploadedSuccessfully(file, response) {

      let message = Locale.getLabel('common.upload.uploaded');
      if (response.length > 1) {
        let filesDidNotUploaded = 0;
        response.forEach((r => {
          if (r.status !== 'error') {
            filesDidNotUploaded++;
          }
        }))
        const totalFiles = response.length;

        message += Locale.getLabel('common.upload.not_all_imported').replace("{{filesDidNotUploaded}}", filesDidNotUploaded).replace("{{totalFiles}}", totalFiles);
      }
      this.hideShowRemoveLink(file, 'block');
      this.progressBarConfiguration(file, message, "green");
    }
  }
}

</script>

<style lang="scss" type="text/scss" scoped>
.vue-dropzone {
  height: 300px;
  max-height:300px;
  overflow:auto;
  background:#fff;
}
</style>