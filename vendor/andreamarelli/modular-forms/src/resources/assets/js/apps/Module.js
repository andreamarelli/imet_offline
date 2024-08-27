import {createApp, ref, unref, onMounted, toRaw, watch, reactive} from "vue";
import mitt from "~/mitt";

// Components
import tooltip from "../templates/tooltip.vue";
import dialogBox from "../templates/dialog_box.vue";

// Input Components
import simpleText from "../inputs/simple-text.vue";
import simpleTextarea from "../inputs/simple-textarea.vue";
import simpleUrl from "../inputs/simple-url.vue";
import simpleEmail from "../inputs/simple-email.vue";
import simplePassword from "../inputs/simple-password.vue";
import rating from "../inputs/rating.vue";
import dropdown from "../inputs/dropdown.vue";
import simpleDate from "../inputs/simple-date.vue";
import simpleNumeric from "../inputs/simple-numeric.vue";
import toggle from "../inputs/toggle.vue";
import checkbox from "../inputs/checkbox.vue";
import selectorSpeciesAnimal from "../inputs/selector-species_animal.vue";
import uploadFile from "../inputs/upload.vue";
import textEditor from "../inputs/text-editor.vue";

// Composables and Stores
import {useDataStatus} from "./composables/module.data_status.js";
import {useArrangeRecords} from "./composables/module.arrange_records.js";
import {useSave} from "./composables/module.save.js";
import {useCalc} from "./composables/module.calc.js";

export default class Module {

    constructor(input_data = {}, custom_props = {}) {

        let _this = this;

        const options = {

            name: input_data.module_key,

            props: {
                module_key: String,
                module_type: String,
                common_fields: Object,
                groups: Object,
                group_key_field: String,
                predefined_values: Object,
                max_rows: Number,
                accordion_title_field: String,
                empty_record: Object,
                records: Object,
                last_update: {
                    type: Object,
                    default: () => {
                        return {
                            user: null,
                            date: null
                        }
                    }
                },
                action: String,
                form_id: Number,
                enable_not_applicable: Boolean,
                warning_on_save: String,
                action_url: String,
                ...custom_props
            },

            setup(props, context){
                return _this.setupApp(props, input_data);
            }
        };

        // Create the app
        return this.createApp(options, input_data);
    }

    setupApp(props, input_data) {

        const moduleContainer = document.querySelector('#module_' + props.module_key);
        const emitter = mitt()

        // Define ref/reactive and local variables
        let records = reactive(props.records);
        let records_backup = JSON.parse(JSON.stringify(toRaw(records)));
        let status = ref('init'); // "init" state avoid watch() on records during initialization
        let empty_record = props.empty_record;
        let last_update = props.last_update;

        // Inject common fields values into empty record
        Object.keys(empty_record).forEach(function (key) {
            if (props.common_fields.map((f => f['name'])).includes(key)) {
                empty_record[key] = records[0][key];
            }
        });

        // import Composables
        const {
            accordionTitle,
            recordIsInGroup,
            numRecordsInGroup,
            ensureAteLeastOneRecordPerGroup,
            addItem,
            deleteItem
        } = useArrangeRecords({
            module_type: unref(props.module_type),
            groups: unref(props.groups),
            group_key_field: unref(props.group_key_field),
            accordion_title_field: unref(props.accordion_title_field),
            records: unref(records),
            empty_record: unref(empty_record)
        });
        const {refreshDataStatus, isNotApplicable, isNotAvailable, toggleDataStatus} = useDataStatus({
            enable_not_applicable: props.enable_not_applicable,
            empty_record: empty_record,
            records: records
        });
        const {
            resetModule,
            saveModule,
            error_messages,
        } = useSave({
            records: records,
            records_backup: records_backup,
            status: status,
            last_update: last_update,
            form_id: unref(props.form_id),
            module_key: unref(props.module_key),
            action_url: props.action_url,
            refreshDataStatus: refreshDataStatus,
            ensureAteLeastOneRecordPerGroup: ensureAteLeastOneRecordPerGroup,
            emitter: emitter
        });

        const {calculateAverage, calculateGroupsAverages, sumColumn, sumColumnFloat} = useCalc({
            records: records,
            groups: unref(props.groups),
            group_key_field: unref(props.group_key_field)
        });

        // Set initial status
        refreshDataStatus();
        ensureAteLeastOneRecordPerGroup();

        // Watch for changes in records
        watch(records, (value) => {
            syncCommonFields(value);
            if (status.value !== 'init' && status.value !== 'changed'){
                status.value = 'changed';
                emitter.emit('moduleChanged', { module_key: props.module_key, records: value });
            }
        });

        onMounted(() => {
            setPredefinedAsDisabled();
            status.value = 'idle';
            emitter.emit('moduleMounted', { module_key: props.module_key });
        });

        // #################################################
        // ##################   Methods   ##################
        // #################################################

        /**
         * Set predefined fields as disabled
         */
        function setPredefinedAsDisabled() {
            records.forEach((record, i) => {
                if (typeof record.__predefined !== 'undefined'
                    && record.__predefined === true
                    && props.predefined_values!==null) {
                    let input = moduleContainer.querySelector("[id$=_" + i + "_" + props.predefined_values['field'] + "]");
                    if(input){
                        input.setAttribute('readonly', 'readonly');
                        input.classList.add('field-disabled');
                    }
                }
            });
        }

        /**
         * Synchronize common fields on record change
         */
        function syncCommonFields() {
            props.common_fields.forEach((field) => {
                let value = records[0][field['name']];
                records.forEach(function (item, index) {
                    records[index][field['name']] = value;
                });
            });
        }

        function toggleNotApplicable() {
            toggleDataStatus('not_applicable');
        }

        function toggleNotAvailable() {
            toggleDataStatus('not_available');
        }

        return {
            status,
            records,
            last_update,
            error_messages,
            emitter,

            // objects from or related to composables
            isNotApplicable,
            isNotAvailable,
            toggleNotAvailable,
            toggleNotApplicable,
            saveModule,
            resetModule,
            recordIsInGroup,
            numRecordsInGroup,
            accordionTitle,
            addItem,
            deleteItem,
            calculateAverage,
            calculateGroupsAverages,
            sumColumn,
            sumColumnFloat,

            // TODO: remove
            records_backup
        }
    }

    createApp(options, input_data) {

        return createApp(options, input_data)

            // register common components
            .component('tooltip', tooltip)
            .component('dialogBox', dialogBox)

            // register input components
            .component('simpleText', simpleText)
            .component('simpleTextarea', simpleTextarea)
            .component('simpleUrl', simpleUrl)
            .component('simpleEmail', simpleEmail)
            .component('simplePassword', simplePassword)
            .component('rating', rating)
            .component('dropdown', dropdown)
            .component('simpleDate', simpleDate)
            .component('simpleNumeric', simpleNumeric)
            .component('toggle', toggle)
            .component('checkbox', checkbox)
            .component('selector-species_animal', selectorSpeciesAnimal)
            .component('upload', uploadFile)
            .component('textEditor', textEditor);
    }

}
