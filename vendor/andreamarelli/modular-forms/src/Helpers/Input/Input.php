<?php

namespace AndreaMarelli\ModularForms\Helpers\Input;


use Illuminate\Support\Facades\App;

class Input{

    /**
     * Input's label
     */
    public static function label(string $name, string $label, string $class = ''): string
    {
        return '<label for="'.$name.'" class="'.$class.'">'.ucfirst($label).'</label>';
    }

    /**
     * Hidden Field
     */
    public static function hidden(string $name, ?string $value): string
    {
        return '<input type="hidden" name="'.$name.'" value="'.$value.'" />';
    }

    /**
     * Text Field
     */
    public static function text(string $name, ?string $value, string $class='field-edit'): string
    {
        return '<input type="text" name="'.$name.'" value="'.$value.'" class="'.$class.'" />';
    }

    /**
     * Single checkbox
     */
    public static function checkbox(string $name, ?string $value, string $label, bool $checked, bool $inline = true): string
    {
        $input = '<input name="'.$name.'" id="'.$name.'" type="checkbox" value="'.$value.'" '.( $checked ? 'checked="checked"' : '').' />';

        if($inline){
            return '<label class="checkbox-inline">'.$input.$label.'</label>';
        } else {
            return '<div class="checkbox">
                        '.$input.'
                        <label for="'.$name.'">'.$label.'</label>
                    </div>';
        }
    }

    /**
     * Checkbox list
     */
    public static function checkboxGroup(string $id, array $selectedValues = [], string|array $list = null, bool $inline = true): string
    {
        $out = '';
        $list = $list===null ? $id : $list;
        if(is_string($list)){
            $list = SelectionList::getList($list);
        }

        $i = 0;
        foreach ($list as $value=>$label){
            $checked = in_array($value, $selectedValues);
            $out .= Input::checkbox($id.'_'.$i, $value, $label, $checked, $inline);
            $i++;
        }
        return $out;
    }

    /**
     * Retrieve checkboxGroup selected items form request parameter
     */
    public static function checkBoxSelectedFromRequest(string $id, array $request_parameters): array
    {
        $selected = [];
        foreach ($request_parameters as $key => $index){
            if(str_starts_with($key, $id)){
                $selected[] = $index;
            }
        }
        return $selected;
    }

    /**
     * Date picker (based on air-datepicker)
     */
    public static function dayPicker(string $name, ?string $value, bool $disableJavascript = false, string $class = 'field-edit'): string
    {
        $out = '<input readonly type="text" name="'.$name.'" id="'.$name.'" class="'.$class.'" />';

        if(!$disableJavascript){
            $out .= '<script>
                        (function() {
                            new window.ModularFormsVendor.AirDatepicker("#' . $name . '", {
                                locale: window.ModularFormsVendor.AirDatepicker.locale["' . App::getLocale().'"],
                                autoClose: true,
                                toggleSelected: false,
                                buttons: ["clear"],
                                dateFormat: "yyyy-MM-dd",
                                ' . (!empty($value) ?  'selectedDates: ["' . $value. '"]' : '') . '
                            })
                        })();
                    </script>';
        }

        return $out;
    }

    /**
     * Slider
     */
    public static function slider(string $id, ?string $value, $options=[]): string
    {
        $defaultOptions = array(
            "min" => 0,
            "max" => 100,
            "step" => 1
        );
        $options = array_merge($defaultOptions, $options);

        return '<div class="range-slider">
                    <input type="range"
                        min="'.$options['min'].'"
                        max="'.$options['max'].'"
                        step="'.$options['step'].'"
                        value="'.$value.'"
                        name="'.$id.'"
                        id="'.$id.'">
                    <span class="range-slider__value"></span>
                </div>
                <script>
                    let slider = document.getElementById("'.$id.'");
                    let slider__value = slider.nextElementSibling;
                    slider__value.innerHTML = slider.value;
                    slider.oninput = function() {
                        slider.value = this.value;
                        slider__value.innerHTML = this.value;
                    }
                </script>';
    }

}
