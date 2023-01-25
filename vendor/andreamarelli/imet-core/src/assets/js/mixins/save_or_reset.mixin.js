const STATUS_INIT = 'init';
const STATUS_IDLE = 'idle';
const STATUS_CHANGED = 'changed';
const STATUS_SAVING = 'saving';
const STATUS_SAVED = 'saved';

module.exports = {

    data (){
        return {
            records_backup: null,
            status: null,
            warning_on_save: null,
        }
    },

    created: function () {
        this.status = STATUS_INIT;   // Avoid watch() on records during initialization
        this.records_backup = this.__no_reactive_copy(this.records);
    },

    mounted: function () {
        this.set_status(STATUS_IDLE);
    },

    watch: {

        records:{
            handler: function () {
                if (this.status !== STATUS_INIT) {
                    this.status = STATUS_CHANGED;
                }
            },
            deep: true
        }

    },

    methods: {

        /**
         * Copy records values $data/$records_backup (or vice-versa) avoiding reactivity
         * @param data
         * @private
         */
        __no_reactive_copy: function (data) {
            return JSON.parse(JSON.stringify(data));
        },

        /**
         * Set controller's status to a given state
         * @param status
         */
        set_status: function (status) {
            let _this = this;
            Vue.nextTick(function () {
                _this.status = status;
            });
        },

        /**
         * Reset records: retrieve original data from "records_backup"
         */
        resetModule(){
            this.records = this.__no_reactive_copy(this.records_backup);
            this.resetData();
            this.set_status(STATUS_IDLE);
        },

        /**
         * Save records: retrieve original data from "records_backup"
         */
        saveModule(){
            this.set_status(STATUS_SAVING);
            this.saveData();
            this.set_status(STATUS_SAVED);
        },

        // Allows additional executions by component
        resetData(){},
        // saveData(){}, // Require instantiation


        /**
         * Manage bar show/hide transitions
         */
        beforeShowBar: function (el) {
            $(el).css("display", 'none');
        },
        showBar: function (el, done) {
            $(el).slideDown(400, function () {
                $(this).css("display", 'block');
                done();
            });
        },
        hideBar: function (el, done) {
            $(el).slideUp(400, function () {
                $(this).css("display", 'none');
                done();
            });
        },

    }

}
