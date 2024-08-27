
import { createApp, reactive } from "vue";
export default class AnalysisStakeholderSummary {

    constructor(input_data = {}) {

        const options = {

            name: 'AnalysisStakeholderSummary',

            props: {
                key_elements_importance: {
                    type: Object,
                    default: () => {}
                }
            },

            setup(props, context) {

                const Locale = window.ModularForms.Helpers.Locale;
                let key_elements_importance = reactive(props.key_elements_importance);

                function refresh_importance(new_items) {
                    // remove everything
                    key_elements_importance.forEach(function (item, index) {
                        key_elements_importance.splice(index, 1);
                    });
                    // add back new items
                    new_items.forEach(function (item, index) {
                        key_elements_importance[index] = JSON.parse(JSON.stringify(new_items[index]));
                    });
                }

                function key_elements_importance_composition(element) {
                    return Locale.getLabel('imet-core::oecm_evaluation.KeyElements.key_elements_importance_composition', {
                        'imp_dir': '<b>' + element['importance_direct'] + '</b>',
                        'imp_ind': '<b>' + element['importance_indirect'] + '</b>',
                        'num_dir': '<b>' + element['stakeholder_direct_count'] + '</b>',
                        'num_ind': '<b>' + element['stakeholder_indirect_count'] + '</b>',
                    })
                }

                return {
                    key_elements_importance,
                    key_elements_importance_composition,
                    refresh_importance
                }

            }
        };

        return createApp(options, input_data)
    }

}