<template>
    <select :id="id">
        <option :value="selectedValue" selected="selected">{{ selectedLabel }}</option>
    </select>
</template>

<style lang="scss" scoped>


</style>

<script>

    export default {
        props: {
            id : String,
            value : [String, Number],
            dataClass: String,
            suggestion: {
                type: Boolean,
                default: false,
            },
            placeholder: {
                type: String,
                default: () => {
                    return Locale.getLabel('modular-forms::common.select_item') + '...'
                }
            },
            dataValues: String,
        },
        data (){
            return {
                Locale: window.Locale,
                defaultValue: '',
                selectedValue: '',
                selectedLabel: '',
                data: {}
            }
        },
        beforeMount: function () {
            // Prepare data for select2 and Set default selected value
            let $data = [],
                $values = JSON.parse(this.dataValues);
            for(let $key in $values) {
                if($values.hasOwnProperty($key)) {
                    let $item = {};
                    $item.text = $values[$key];
                    $item.id = $key;
                    $data.push($item);
                    if($key == this.value) {
                        this.selectedValue = $key;
                        this.selectedLabel = $values[$key];
                    }
                }
            }
            this.data = $data;
            this.defaultValue = this.selectedValue;
        },
        mounted (){
            let $component = $('#' + this.id);
            let  $options = {
                placeholder: this.placeholder,
                allowClear: true,
                data: this.data,
                tags: this.suggestion,
                matcher : this.customSearch,
                templateResult: this.formatResult,
                templateSelection: this.formatSelection,
                theme: "bootstrap4"
            };
            if(Object.keys(this.data).length <= 10) $options.minimumResultsForSearch = 'Infinity';
            $component.select2($options);

            let $el = this;
            $component.on('select2:select', function (evt) {
                $el.emitValue(evt.params.data.id); // update dropdown with the selected value
            }).on("select2:unselect", function (evt) {
                $el.emitValue(''); // update dropdown with empty value
            });

            // Resize dropdown default width to include clear button width
            let $defaultWidth = $component.parent().find(".select2-container").width();
            $component.parent().find(".select2-container").css('width', ($defaultWidth + 15 + 60) + 'px');
        },
        methods: {
            emitValue (value) {
                this.$emit('input', value);
                this.$emit('change');
            },
            formatResult: function ($item) {
                if(typeof $item.id !== 'undefined') {
                    let $text = '<span>' + $item.text + '</span>';
                    let $code = ' <span class="currency-code">' + $item.id + '</span>';
                    return $('<span class="currency-item">' + $text + $code + '</span>');
                }
                else return null;
            },
            formatSelection: function ($item) {
                if(typeof $item.id !== 'undefined') {
                    let $code = '<span class="currency-code">' + $item.id + '</span> - ';
                    let $text = '<span>' + $code + $item.text + '</span>';
                    return $('<span class="currency-item">'+ $text  + '</span>');
                }
                else return null;
            },
            customSearch (params, data){
                // `params.term` should be the term that is used for searching
                // `data.text` is the text that is displayed for the data object

                // If there are no search terms, return all of the data
                if ($.trim(params.term) === '') {
                    return data;
                }

                if (data.text.toLowerCase().indexOf(params.term.toLowerCase()) > -1 || data.id.toLowerCase().indexOf(params.term.toLowerCase()) > -1) {
                    return data;
                }

                // Return `null` if the term should not be displayed
                return null;
            },
        },
        watch : {
            value : function($newValue){
                // Reset dropdown field on modifications cancel
                $newValue = ($newValue === null || typeof $newValue === 'undefined') ? '' : $newValue;
                if($newValue == this.defaultValue)
                    $('#' + this.id).val(this.defaultValue).trigger('change');
            }
        }
    }
</script>
