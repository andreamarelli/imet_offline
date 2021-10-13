import actions from './mixins/actions.mixin'
import calc from './mixins/calc.mixin'
import preload from './mixins/preload.mixin'
import transitions from './mixins/transitions.mixin'

window.ModularForms.ModuleController = window.Vue.extend({

    mixins: [
        actions,
        calc,
        preload,
        transitions
    ],

    store: window.ModularForms.formStore,

    props: [
        'status',
        'error_messages',
        'records_backup',
        'container'
    ],

    data: function () {
        return {
            module_key: null,
            module_type: null,
            common_fields: null,
            groups: null,
            group_key_field: null,
            predefined_values: null,
            accordion_title_field: null,
            empty_record: null,
            records: null,
            last_update: null,
            action: null,
            form_id: null,
            visible: null,
            warning_on_save: null,
            reset_status: 'idle'
        }
    },

    computed: {
        common_fields_names() {
            let names = [];
            this.common_fields.forEach(function (field) {
                names.push(field['name'])
            });
            return names
        },
        accordion_titles() {
            let _this = this;
            let accordion_titles = [];
            if (_this.module_type === "ACCORDION") {
                _this.records.forEach(function (item, index) {
                    let input_value = item[_this.accordion_title_field] || '';
                    input_value = (parseInt(index) + 1) + ' - ' + input_value;
                    accordion_titles.push(input_value);
                });
            } else if (_this.module_type === "GROUP_ACCORDION") {
                Object.keys(_this.records).forEach(function (key) {
                    let group_title = [];
                    _this.records[key].forEach(function (item, index) {
                        let input_value = item[_this.accordion_title_field] || '';
                        input_value = (parseInt(index) + 1) + ' - ' + input_value;
                        group_title.push(input_value);
                    });
                    accordion_titles[key] = group_title;
                });
            }
            return accordion_titles;
        }

    },

    /**
     *  Vue controller initialization
     */
    created: function () {
        this.status = 'init'; // Avoid watch() on records during initialization
        this.records_backup = this.__no_reactive_copy(this.records);
        this.__init_empty_record();
        this.__arrange_records_by_group();
        this.__init_applicable();
    },

    mounted: function () {
        let _this = this;
        _this.container = $(_this.$el)[0];

        _this.__set_predefined_as_disabled();

        Vue.nextTick(function () {
            _this.status = _this.reset_status;
        });

        _this.mountedCallback();
    },

    watch: {

        /**
         * Automatic watch to supervise input changes
         */
        records: {
            handler: function () {
                this.recordChangedCallback();
                if (this.status !== 'init') {
                    let _this = this;
                    _this.status = (_this.status !== 'changed') ? 'changed' : _this.status;
                    _this.__sync_common_fields();
                }
            },
            deep: true
        }
    },

    methods: {

        /**
         * Reset module to initial state (reset all inputs)
         */
        resetModule: function () {
            let _this = this;
            _this.records = _this.__no_reactive_copy(_this.records_backup);
            _this.__arrange_records_by_group();
            _this.__init_applicable();
            _this.resetModuleCallback();
            Vue.nextTick(function () {
                _this.status = _this.reset_status;
            });
        },

        /**
         *  Save module
         */
        saveModule: function () {
            let _this = this;
            let form = $(this.container).find('form')[0];
            _this.status = 'saving';

            $.ajax({
                method: $(form).attr('method'),
                url: $(form).attr('action'),
                data: _this.__parse_form(),
                cache: false
            })
                .done(function (response) {
                    if (response.hasOwnProperty('status')) {
                        if (response['status'] === 'success') {
                            if (_this.action === 'store') {
                                window.location.href = response['edit_url'];
                                return;
                            }
                            _this.records = _this.__no_reactive_copy(response['records']);
                            if (response.hasOwnProperty('last_update')) {
                                _this.last_update = _this.__no_reactive_copy(response['last_update']);
                            }
                            _this.records_backup = _this.__no_reactive_copy(_this.records);
                            _this.__arrange_records_by_group();
                            _this.saveModuleDoneCallback(response);
                            window.vueBus.$emit('refresh_validation', _this.module_key);
                            window.vueBus.$emit('refresh_assessment');      // only for IMET
                            Vue.nextTick(function () {
                                _this.status = 'saved';
                            });
                        } else if (response['status'] === 'validation_error') {
                            _this.setErrorStatus(response);
                            _this.saveModuleFailCallback(response);
                        }
                        return;
                    }
                    _this.setErrorStatus(response);
                    _this.saveModuleFailCallback(response);
                })
                .fail(function (response) {
                    _this.setErrorStatus(response);
                    _this.saveModuleFailCallback(response);
                })
                .always(function (response) {
                    _this.saveModuleAlwaysCallback(response);
                });
        },

        // Allows additional executions by child components
        recordChangedCallback(){},
        mountedCallback: function(){},
        resetModuleCallback: function () {},
        saveModuleDoneCallback: function (response) {},
        saveModuleFailCallback: function (response) {},
        saveModuleAlwaysCallback: function (response) {},

        /**
         * Clean (empty) all fields
         *
         */
        cleanAll: function(){
            let _this = this;

            if (_this.predefined_values === null) {
                _this.records.splice(1);
                Object.keys(_this.records).forEach(function(index) {
                    Object.keys(_this.records[index]).forEach(function (field) {
                        _this.records[index][field] = _this.empty_record[field];
                    });
                });
            } else {
                _this.records.splice(_this.predefined_values['values'].length);
                Object.keys(_this.records).forEach(function(index) {
                    let predefined_field = _this.predefined_values['field'];
                    let predefined_value = _this.records[index][predefined_field];
                    Object.keys(_this.records[index]).forEach(function (field) {
                        _this.records[index][field] = _this.empty_record[field];
                    });
                    _this.records[index]['__predefined'] = true;
                    _this.records[index][predefined_field] = predefined_value;
                });
            }

        },

        /**
         *
         * @param response
         */
        setErrorStatus: function (response) {
            let _this = this;
            _this.status = 'error';
            _this.error_messages = [];
            if (response.hasOwnProperty('errors')) {
                Object.keys(response['errors']).forEach(function (field) {
                    response['errors'][field].forEach(function (message) {
                        _this.error_messages.push(message);
                    });
                });
            }
        },

        /**
         * Synchronize common fields values to all records (when changed)
         */
        __sync_common_fields: function () {
            let _this = this;
            _this.common_fields.forEach(function (field) {
                if (_this.groups !== null && _this.groups.length > 0) {
                    let first_group = Object.keys(_this.groups)[0];
                    let value = _this.records[first_group][0][field['name']];
                    Object.keys(_this.records).forEach(function (group_key) {
                        _this.records[group_key].forEach(function (item, index) {
                            _this.records[group_key][index][field['name']] = value;
                        });
                    });
                } else {
                    let value = _this.records[0][field['name']];
                    _this.records.forEach(function (item, index) {
                        _this.records[index][field['name']] = value;
                    });
                }
            });
        },
        __set_predefined_as_disabled: function () {
            let _this = this;
            if (_this.predefined_values !== null) {
                if (_this.module_type === "GROUP_ACCORDION" || _this.module_type === "GROUP_TABLE") {
                    Object.keys(_this.records).forEach(function (group_key) {
                        _this.records[group_key].forEach(function (item, index) {
                            if (typeof item.__predefined !== 'undefined' && item.__predefined === true) {
                                let input = $(_this.container).find("[id$=_" + group_key + "_" + index + "_" + _this.predefined_values['field'] + "]");
                                input.attr('readonly', 'readonly');
                                input.addClass('field-disabled');
                            }
                        });
                    });
                } else {
                    _this.records.forEach(function (item, index) {
                        if (typeof item.__predefined !== 'undefined' && item.__predefined === true) {
                            let input = $(_this.container).find("[id$=_" + index + "_" + _this.predefined_values['field'] + "]");
                            input.attr('readonly', 'readonly');
                            input.addClass('field-disabled');
                        }
                    });
                }
            }
        },

        /**
         * Copy records values $data/$records_backup (or vice-versa) avoiding reactivity
         * @param data
         * @private
         */
        __no_reactive_copy: function (data) {
            return JSON.parse(JSON.stringify(data));
        },

        /**
         * Copy common fields values in empty records array
         * @returns {null}
         */
        __init_empty_record: function () {
            let _this = this;
            let empty_record = _this.empty_record;
            Object.keys(empty_record).forEach(function (key) {
                if (_this.common_fields_names.includes(key)) {
                    empty_record[key] = _this.records[0][key];
                }
            });
            _this.empty_record = empty_record;
        },

        /**
         * Parse form data to be sent for saving
         * @returns {*}
         * @private
         */
        __parse_form: function () {
            let _this = this;
            let form = $(_this.container).find('form')[0];
            let records = _this.__no_reactive_copy(_this.$data['records']);
            let data = {};
            data['form_id'] = _this.form_id;
            data['module_key'] = _this.module_key;
            data['_token'] = $($(form).find('input[name="_token"]')[0]).val();
            data['_method'] = $($(form).find('input[name="_method"]')[0]).val();
            records = _this.parseRecordLocally(records);
            if (this.module_type === "GROUP_ACCORDION" || this.module_type === "GROUP_TABLE") {
                data['records_json'] = JSON.stringify(_this.__arrange_back_records_by_group(records));
            } else {
                data['records_json'] = JSON.stringify(records);
            }
            return data;
        },
        parseRecordLocally: function (records) {
            return records
        },

        /**
         * Re-organize records for groups (from array to set of arrays organized by group)
         * Applied only for GROUP_ACCORDION and GROUP_TABLE
         * @private
         */
        __arrange_records_by_group: function () {
            if (this.module_type === 'GROUP_ACCORDION' || this.module_type === 'GROUP_TABLE') {
                let _this = this;
                let records_by_group = {};
                Object.keys(_this.groups).forEach(function (key) {
                    records_by_group[key] = [];
                });
                _this.records.forEach(function (item) {
                    if (item[_this.group_key_field] !== null) {
                        let group_key = item[_this.group_key_field];
                        if(group_key in records_by_group){
                            records_by_group[group_key].push(item);
                        }
                    }
                });
                Object.keys(records_by_group).forEach(function (key) {
                    if (records_by_group[key].length === 0) {
                        records_by_group[key].push(_this.__no_reactive_copy(_this.empty_record));
                        records_by_group[key][0][_this.group_key_field] = key;
                    }
                });
                _this.records = records_by_group;
            }
        },

        /**
         * Re-organize records to simple array
         * Applied only for GROUP_ACCORDION and GROUP_TABLE
         * @param records_by_group
         * @returns {Array}
         * @private
         */
        __arrange_back_records_by_group(records_by_group) {
            let records = [];
            if (this.module_type === "GROUP_ACCORDION" || this.module_type === "GROUP_TABLE") {
                Object.keys(records_by_group).forEach(function (key) {
                    records_by_group[key].forEach(function (item) {
                        records.push(item);
                    })
                });
                return records;
            }
            return records_by_group;
        },

        /**
         * Add new item (row) at TABLE or ACCORDION module
         */
        addItem: function () {
            let key = null;

            if (this.module_type === "GROUP_TABLE") {
                let table = $(event.currentTarget).parents('table');
                key = $(table).attr('id').replace('group_table_' + this.module_key + '_', '');
            } else if (this.module_type === "GROUP_ACCORDION") {
                let accordion = $(event.currentTarget).parent().prev();
                key = $(accordion).attr('id').replace('group_accordion_' + this.module_key + '_', '');
            }

            if (key === null) {
                this.records.push(this.__no_reactive_copy(this.empty_record));
            } else {
                this.records[key].push(this.__no_reactive_copy(this.empty_record));
                this.records[key][this.records[key].length - 1][this.group_key_field] = key;
            }
        },

        /**
         * Remove item (row) from TABLE module
         * @param event
         */
        deleteItem: function (event) {
            let _this = this;
            // It's important to read empty record and keep it in a temp variable before deleting rows
            let $empty_record = _this.empty_record;

            let row_index = null;
            let group_key = null;
            if (_this.module_type === "TABLE") {
                let table_cell = $(event.currentTarget).parents('td')[0];
                row_index = $(table_cell).parent().index();
            } else if (_this.module_type === "ACCORDION") {
                let accordion = $(event.currentTarget).parents('.module_accordion')[0];
                let accordion_container = $(accordion).parent('.module_accordion_container')[0];
                row_index = $(accordion_container).find('.module_accordion').index(accordion);
            } else if (_this.module_type === "GROUP_TABLE") {
                let table_cell = $(event.currentTarget).parents('td')[0];
                row_index = $(table_cell).parent().index();
                group_key = $(table_cell).parents('table').attr('id').replace('group_table_' + _this.module_key + '_', '');
            } else if (_this.module_type === "GROUP_ACCORDION") {
                let accordion = $(event.currentTarget).parents('.module_accordion')[0];
                let accordion_container = $(accordion).parent('.module_accordion_container')[0];
                row_index = $(accordion_container).find('.module_accordion').index(accordion);
                group_key = $(accordion_container).attr('id').replace('group_accordion_' + _this.module_key + '_', '');
            }

            if (group_key === null) {
                _this.records.splice(row_index, 1);
                if (_this.records.length === 0) {
                    _this.records[0] = _this.__no_reactive_copy($empty_record);
                }
            } else {
                _this.records[group_key].splice(row_index, 1);
                if (_this.records[group_key].length === 0) {
                    _this.records[group_key][0] = _this.__no_reactive_copy($empty_record);
                }
            }
        }

    }
});
