<?php

namespace AndreaMarelli\ModularForms\Helpers\Input;


class Input{

    /**
     * Input's label
     *
     * @param $name
     * @param $label
     * @param string $class
     * @return mixed
     */
    public static function label($name, $label, $class=''): string
    {
        return '<label for="'.$name.'" class="'.$class.'">'.ucfirst($label).'</label>';
    }

    /**
     * Hidden Field
     *
     * @param $name
     * @param $value
     * @return mixed
     */
    public static function hidden($name, $value): string
    {
        return '<input type="hidden" name="'.$name.'" value="'.$value.'" />';
    }

    /**
     * Text Field
     *
     * @param $name
     * @param $value
     * @param string $class
     * @return mixed
     */
    public static function text($name, $value, $class='field-edit'): string
    {
        return '<input type="text" name="'.$name.'" value="'.$value.'" class="'.$class.'" />';
    }


    /**
     * Single radio button
     *
     * @param $name
     * @param $value
     * @param $label
     * @param bool $checked
     * @param bool $inline
     * @return string
     */
    public static function radio($name, $value, $label, bool $checked, $inline=true): string
    {
        $input = '<input name="'.$name.'" type="radio" value="'.$value.'" '.( $checked ? 'checked="checked"' : '').' />'.$label;

        if($inline){
            return '<label class="radio-inline">'.$input.'</label>';
        } else {
            return '<div class="radio">
                        <label>'.$input.'</label>
                    </div>';
        }
    }

    /**
     * Radio button list
     *
     * @param $id
     * @param $selectedValue
     * @param mixed $list could be an array containing the value/label pairs OR the key of the list to retrieve
     * @param bool $inline
     * @return string
     * @throws \Exception
     */
    public static function radioGroup($id, $selectedValue=null, $list=null, $inline=true): string
    {
        $out = '';
        $list = $list===null ? $id : $list;
        if(is_string($list)){
            $list = SelectionList::getList($list);
        }

        foreach ($list as $value=>$label){
            $checked = $selectedValue===$value;
            $out .= Input::radio($id, $value, $label, $checked, $inline);
        }
        return $out;
    }

    /**
     * Single checkbox
     *
     * @param $name
     * @param $value
     * @param $label
     * @param bool $checked
     * @param bool $inline
     * @return string
     */
    public static function checkbox($name, $value, $label, bool $checked, $inline=true): string
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
     * Checbox list
     *
     * @param $id
     * @param $selectedValues
     * @param string $list
     * @param bool $inline
     * @return string
     * @throws \Exception
     */
    public static function checkboxGroup($id, $selectedValues=[], $list=null, $inline=true): string
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
     * @param $id
     * @param $request_parameters
     * @return array
     */
    public static function checkBoxSelectedFromRequest($id, $request_parameters): array
    {
        $selected = [];
        foreach ($request_parameters as $key => $index){
            if(substr( $key, 0, strlen($id) ) === $id){
                $selected[] = $index;
            }
        }
        return $selected;
    }

    /**
     * Date picker with day granularity (base on bootstrap-datepicker)
     *
     * @param string $name
     * @param string|null $value
     * @param bool $disableJavascript
     * @param string $class
     * @return string
     */
    public static function dayPicker(string $name, ?string $value, $disableJavascript = false, $class = 'field-edit'): string
    {
        $out = '<input type="text" name="'.$name.'" id="'.$name.'" value="'.$value.'" class="'.$class.' form-daypicker" />';
        if(!$disableJavascript){
            $out .= '<script>
                        $(function() {
                            window.ModularForms.Mixins.Input.dayPicker($(\'input#'.$name.'\'));
                        });
                    </script>';
        }

        return $out;
    }

    /**
     * @param $id
     * @param $value
     * @param array $options
     * @return string
     */
    public static function slider($id, $value, $options=[]): string
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
                        id="'.$id.'">
                    <span class="range-slider__value"></span>
                </div>
                <script>
                    let slider = document.getElementById("'.$id.'");
                    let slider__value =slider.nextElementSibling;
                    slider__value.innerHTML = slider.value;
                    slider.oninput = function() {
                        slider__value.innerHTML = this.value;
                    }
                </script>';
    }

}
