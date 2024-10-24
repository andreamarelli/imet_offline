import {createApp, ref, provide} from "vue";
import previewTemplate from "./components/preview_template.vue";
import application from './components/app.vue';

import mitt from "~/mitt";

export default class Preview {

    constructor(input_data = {}) {

        const options = {
            name: 'Preview',
            setup() {
                const emitter = mitt();
                provide('emitter', emitter);
                const printReport = () => {
                    window.print();
                };

                const downloadFiles = () => {
                    window.location.href = input_data.url;
                };

                return {
                    printReport,
                    downloadFiles
                }
            }

        }

        const app = createApp(
            options || {},
            input_data || {}
        );

        app.component('app',    application);
        // Register components
        app.component('preview_template', previewTemplate);

        return app;
    }
}
