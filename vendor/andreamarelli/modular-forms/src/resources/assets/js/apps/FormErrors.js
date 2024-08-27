import {createApp, ref, computed, watch, onBeforeMount, reactive, onMounted} from "vue";

export default class FormErrors {

    constructor(input_data = {}) {

        const options = {

            name: 'FormErrors',

            props: {
                initial_errors: {
                    type: Array,
                    default: () => []
                }
            },

            setup(props){

                const validation_errors = reactive(props.initial_errors);

                let has_errors = computed(() => {
                    return Object.entries(validation_errors).length >= 1
                        && typeof validation_errors[0] !== 'undefined'
                        && validation_errors[0] !== null;
                })

                onMounted(() => {
                    displayNonValidModules();
                });
                watch(validation_errors, () => {
                    displayNonValidModules();
                });

                /**
                 * Display errors (non valid modules)
                 */
                function displayNonValidModules(){
                    let error_class = 'validation-error';
                    let invalid_modules = validation_errors.map(a => 'module_'+a.key);
                    let containers = document.querySelectorAll('.module-container');
                    containers.forEach(function (container) {
                        if(invalid_modules.includes(container.id)){
                            if(!container.classList.contains(error_class)){
                                container.classList.add(error_class);
                            }
                        } else {
                            if(container.classList.contains(error_class)){
                                container.classList.remove(error_class);
                            }
                        }
                    });
                }

                /**
                 * Refresh errors
                 * @param errors
                 */
                function refreshErrors(errors){
                    // remove everything from records
                    validation_errors.forEach(function (error, index) {
                        // delete validation_errors[index];
                        validation_errors.splice(index, 1);
                    });
                    // add back new records
                    errors.forEach(function (error, index) {
                        validation_errors[index] = JSON.parse(JSON.stringify(error));
                    })

                }

                return {
                    validation_errors,
                    has_errors,
                    refreshErrors
                };
            }

        };

        return createApp(options, input_data);
    }

}
