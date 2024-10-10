import Base from "@modular-forms/js/apps/Base.js";

import PasCountryUpdate from "./components/PasCountryUpdate.vue";

export default class PaUpdate extends Base {

    constructor(input_data) {

        const options = {
            name: 'PaUpdate',
        }

        return super(options, input_data)
            .component('pascountryupdate', PasCountryUpdate)
    }
}
