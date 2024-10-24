import {createApp, ref, provide} from "vue";
import actionButtonCookie from "./components/action-button-cookie.vue";
import LabelCloud from "./components/label-cloud.vue";
import imetEncodersResponsibles from "../templates/imet_encoders_responsibles.vue";
import imetRadar from "../templates/imet_radar.vue";
import actionButton from "./components/action-button.vue";
import mitt from "~/mitt";

export default class ScalingList {

    constructor(input_data = {}) {

        const options = {
            name: 'ScalingList',
            setup() {
                const selected = ref([]);
                const are_checked_all = ref(false)
                const emitter = mitt();

                provide('emitter', emitter);
                provide('selected', selected);
                const is_checked = (id) => {
                    return selected.value.some(item => parseInt(item.id)  === id);
                }

                function clearSelections() {
                    selected.value = [];
                    are_checked_all.value = false;
                }

                function retrieve_check_boxes() {
                    return [...document.querySelectorAll(".vue-checkboxes")].slice(1);
                }

                function check_all() {

                    if (!are_checked_all.value) {
                        const checkboxes_list = retrieve_check_boxes();
                        for (const key in checkboxes_list) {
                            const check_box = checkboxes_list[key];
                            const exist = is_checked(parseInt(check_box.defaultValue));
                            if (!exist) {
                                selected.value.push({
                                    id: check_box.defaultValue,
                                    value: check_box.getAttribute('data-name')
                                });
                            }
                        }
                        are_checked_all.value = true;
                    } else {
                        clearSelections();
                    }
                }

                const selectValueByIdAndValue = (id, value) => {
                    if (is_checked(parseInt(id))) {
                        selected.value = selected.value.filter(item => parseInt(item.id) !== parseInt(id));
                    } else {
                        selected.value.push({id, value});
                    }
                }
                const add_all = () => {
                    input_data.listItems.forEach(function (item) {
                        selectValueByIdAndValue(item.id, item.value);
                    });
                    emitter.emit('store_cookie_and_value', 'analysis', JSON.stringify(selected.value));
                    selected.value = [];
                }
                const is_value_included = (value) => {
                    return selected.value.some(item => parseInt(item.id) === parseInt(value));
                }
                const sortList = (list) => {
                    return list.sort((a, b) => {
                        return a.name.localeCompare(b.name);
                    });
                }
                return {
                    emitter,
                    selected,
                    is_checked,
                    check_all,
                    are_checked_all,
                    selectValueByIdAndValue,
                    add_all,
                    is_value_included,
                    sortList
                }
            }
        }

        const app = createApp(
            options || {},
            input_data || {}
        );

        // Register components
        app.component('action_button', actionButton);
        app.component('action_button_cookie', actionButtonCookie,);
        app.component('label_cloud', LabelCloud);
        app.component('imet_encoders_responsibles', imetEncodersResponsibles);
        app.component('imet_radar', imetRadar);

        return app;
    }

}
