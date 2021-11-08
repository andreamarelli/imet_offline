<?php
    /** @var String $type */
    /** @var String $id */
    /** @var String $value */
    /** @var String $class [optional] */
    /** @var bool  $disableJs [optional] */

    $class = $class ?? '';
    $class .= ' field-edit';

?>

@if($type=="preview")
    <div class="field-preview">{!! $value !!}</div>

@elseif($type=="hidden")
    {!! \AndreaMarelli\ModularForms\Helpers\Input\Input::hidden($id, $value)  !!}

@elseif($type=="text")
    {!! \AndreaMarelli\ModularForms\Helpers\Input\Input::text($id, $value, $class) !!}

@elseif($type=="date")
    {!! \AndreaMarelli\ModularForms\Helpers\Input\Input::dayPicker($id, $value, true, $class) !!}

@elseif(substr_count($type, "dropdown-")>0)
    {!! \AndreaMarelli\ModularForms\Helpers\Input\DropDown::simple($id, $value, str_replace('dropdown-', '', $type), $class) !!}

@else
    <b class="text-danger">Type "{{ $type }}" has not been implemented yet.</b>
@endif
