import FormList from "@modular-forms/js/apps/FormList.js";

import imet_encoders_responsibles from "../templates/imet_encoders_responsibles.vue";
import imet_radar from "../templates/imet_radar.vue";

export default class FormListImet extends FormList {

    constructor(options, input_data) {

        return super(options, input_data)

            // Register components
            .component('imet_encoders_responsibles', imet_encoders_responsibles)
            .component('imet_radar', imet_radar)

        ;
    }

}
