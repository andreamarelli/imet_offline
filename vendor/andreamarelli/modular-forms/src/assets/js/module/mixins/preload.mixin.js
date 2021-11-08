export default {

    props: {
        preload_records: {
            type: Array,
            default: () => []
        },
    },

    mounted (){
        let _this = this;
        $(document).on('show.bs.modal','#preload_modal__'+this.module_key, function () {
            _this.__retrieve_preload_data();
        });
    },

    methods: {

        __retrieve_preload_data: function(){
            let _this = this;
            $.ajax({
                url: window.Laravel.baseUrl + 'api/' + this.module_key.split('__')[0] + '/preload',
                type: "POST",
                data: {
                    '_token': window.Laravel.csrfToken,
                    'module_key': _this.module_key,
                    'form_id': _this.form_id,
                }
            })
                .done(function (response) {
                    _this.preload_records = response['records'];
                    $(_this.container).find("div.preload_container").html(response['view']);
                })
        },

        show_previous_year: function(year){
            $(this.container).find(".preload_preview").css('display', 'none');
            $(this.container).find(".preload_button").removeClass('active-disabled').addClass('basic');
            $(this.container).find(".preload_preview.year_"+year).css('display', 'inline-block');
            $(this.container).find(".preload_button.year_"+year).removeClass('basic').addClass('active-disabled');
        },

        apply_preload_one_record: function (year, index) {
            let _this = this;
            let record = _this.preload_records[year][index];
            if (_this.predefined_values !== null && record['__predefined']) {
                let pred_field =_this.predefined_values.field;
                _this.records.forEach(function(r, i) {
                    if(record[pred_field] === r[pred_field]){
                        _this.records.splice(i, 1, record);
                    }
                });
            } else {
                _this.records.push(record);
            }
        },

        // apply_preload_all: function (year) {
        //     let _this = this;
        //     let records = this.preload_records[year];
        //     records.forEach(function(record) {
        //         _this.records.push(record);
        //     });
        // }

    }
}
