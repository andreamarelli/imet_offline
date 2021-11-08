export default {

    dayPicker: function($item){
        $item.datepicker({
            format: "yyyy-mm-dd",
            language: window.Locale.getLocale(),
            clearBtn: true,
            autoclose: true,
            todayHighlight: true
        })
            .on('keypress', function(evt){
                evt.preventDefault();
            });
    },

    filteredDropdown: function(masterDropdown, slaveDropDown, dataStructure, placeHolder){
        $(masterDropdown).change(function (){

            // Clean SELECT
            $(slaveDropDown).empty();

            // Add empty value
            if (typeof placeHolder === 'undefined'){
                $(slaveDropDown).append('<option value=""> - - </option>');
            } else {
                $(slaveDropDown).append('<option value=""> -- '+ placeHolder +' -- </option>');
            }

            // Re-organize and sort list
            let list = dataStructure[$(this).val()];
            let sorted_list = [];
            for (let key in list) {
                if(list.hasOwnProperty(key)){
                    sorted_list.push([key, list[key]]);
                }
            }
            sorted_list.sort(function(a,b) {
                return (a[1] > b[1]) ? 1 : ((b[1] > a[1]) ? -1 : 0);}
            );

            // Populate SELECT
            sorted_list.forEach(function(item){
                $(slaveDropDown).append('<option value="' + item[1] + '">' + item[1] + '</option>');
            });
            $(slaveDropDown).selectpicker('refresh');
            $(slaveDropDown).selectpicker('deselectAll');
        });
    }

}
