export default {

    data: function () {
        return {
            not_applicable: null,
            not_available: null,
        }
    },

    methods:{

        __init_applicable: function(){
            if(this.enable_not_applicable===true
                && 'not_applicable' in this.records[0]
            ){
                this.not_applicable = this.records[0]['not_applicable']===true;
                this.not_available = this.records[0]['not_available']===true;
            }
        },

        toggleNotApplicable: function () {
            let _this = this;
            _this.not_applicable = !_this.not_applicable;
            _this.not_available = false;
            _this.records = [];
            _this.records.push(_this.__no_reactive_copy(_this.empty_record));
            this.common_fields.forEach(function (field) {
                _this.records[0][field['name']] = null;
            });
            _this.records[0]['not_applicable'] = _this.not_applicable === true ? true : null;
        },

        toggleNotAvailable: function () {
            let _this = this;
            _this.not_available = !_this.not_available;
            _this.records = [];
            _this.records.push(_this.__no_reactive_copy(_this.empty_record));
            this.common_fields.forEach(function (field) {
                _this.records[0][field['name']] = null;
            });
            _this.records[0]['not_available'] = _this.not_available === true ? true : null;
        }

    }
}
