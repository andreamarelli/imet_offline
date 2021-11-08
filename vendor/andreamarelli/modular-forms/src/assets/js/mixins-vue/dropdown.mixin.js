
import common from '../mixins-vue/values.mixin';

export default {

    mixins: [
        common
    ],

    props: {
        dataValues: {
            type: String,
            default: '{}',
        },
        placeholder: {
            type: String,
            default: () => {
                return Locale.getLabel('modular-forms::common.select_item') + '...'
            }
        },
        suggestion: {
            type: Boolean,
            default: false,
        },
        sort: {
            type: Boolean,
            default: true,
        }
    },

    data (){
        return {
            Locale: window.Locale,
            defaultValue: '',
            selectedValue: '',
            selectedLabel: '',
            defaultOptions: {},
            data: {},
            options: {},
            dropdown: null
        }
    },

    beforeMount: function () {
        this.populateData();
        this.initDefaultOptions();
    },

    mounted (){
        this.dropdown = $('#' + this.id);
        this.initSelect2();
    },

    watch : {
        value : function(newValue){
            this.setValue(newValue);
            this.refreshSelect2(newValue);
        },
        dataValues : function(){
            this.refreshList();
        }
    },

    methods: {

        /**
         * Initialize select2 default options
         */
        initDefaultOptions: function(){

            this.defaultOptions = {
                // minimumInputLength: 2,
                placeholder: this.placeholder,
                allowClear: true,
                data: this.data,
                tags: this.suggestion,
                width: '100%',
                theme: "bootstrap4"
            };

            // if(Object.keys(this.data).length <= 10 && this.suggestion === false){
            //     this.defaultOptions.minimumResultsForSearch = 'Infinity';
            // }

            if(this.sort){
                this.defaultOptions.sorter = function(data) {
                    return data.sort(function (a, b) {
                        let value_a = a.text.toLowerCase().trim();
                        let value_b = b.text.toLowerCase().trim();
                        if(value_a > value_b){ return 1; }
                        if(value_a < value_b){ return -1; }
                        return 0;
                    });
                }
            }

            this.options = this.defaultOptions;
        },

        /**
         * Initialize select2
         */
        initSelect2: function () {

            let _this = this;

            this.dropdown.select2(this.options);
            this.dropdown
                .on('select2:select', function (evt) {
                    _this.emitValue(evt.params.data.id);    // update dropdown with the selected value
                })
                .on("select2:unselect", function () {
                    _this.emitValue('');                    // update dropdown with empty value
                });


            // Increase default width to include clear button
            if(this.options.width !== '100%'){
                let select2container = this.dropdown.parent().find(".select2-container");
                let defaultWidth = $(select2container).width();
                if(defaultWidth!==0){
                    $(select2container).css('width', (defaultWidth + 15) + 'px');
                }
            }

        },

        /**
         * Populate data and set default selected value
         * @param newList
         */
        populateData(newList = null) {

            let data = [];
            newList = newList === null ? JSON.parse(this.dataValues) : newList;

            for(let key in newList) {
                if((key !== null && key !== '' && key !== 'null')
                    && newList.hasOwnProperty(key)) {
                        data.push({'text': newList[key], 'id': key});
                        if(this.value !== null &&
                            key.toString() === this.value.toString()){
                                this.selectedValue = key;
                                this.selectedLabel = newList[key];
                        }
                }
            }

            // In case of suggestion force to add current value which is not in the options list
            if(this.suggestion === true && this.value !== '' && this.value !== null){
                data.push({'text': this.value, 'id': this.value});
                this.selectedValue = this.value;
                this.selectedLabel = this.value;
            }

            this.data = data;
            this.defaultValue = this.selectedValue;
        },

        refreshList: function (newList = null, selectedValue = null){

            selectedValue = selectedValue === null ? this.defaultValue : selectedValue;

            if(newList === null) {
                this.populateData();
                this.data.push({'text': selectedValue, 'id': selectedValue});
            } else {
                this.populateData(newList);
            }

            this.options.data = this.data;
            this.refreshSelect2(selectedValue);
        },

        refreshSelect2: function (selectedValue) {
            this.dropdown
                .select2('destroy')
                    .empty()
                .select2(this.options)
                    .val(selectedValue)
                    .trigger('change');

        },

        addItem: function(key, label=null){
            label = label === null ? key : label;
            let newList = JSON.parse(this.dataValues);
            newList[key] = label;
            this.refreshList(newList, key);
            this.emitValue(key);
        },

        setValue: function(value){
            value = (value === null || typeof value === 'undefined') ? '' : value;
            if(value === this.defaultValue || value === '') {
                this.dropdown.val(value).trigger('change');
            }
        }

    }
}
