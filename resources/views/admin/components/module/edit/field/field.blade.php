<?php
    /** @var String $type */
    /** @var String $id */
    /** @var String $value */
    /** @var String $class [optional] */
    /** @var bool  $disableJs [optional] */

    // Ensure at least empty strings
    $class =        isset($class)       ? $class        : '';

    // Set other attributes
    $class .= ' field-edit';

?>

@if($type=="hidden")
    {!! \App\Library\Ofac\Input\Input::hidden($id, $value)  !!}

@elseif($type=="text")
    {!! \App\Library\Ofac\Input\Input::text($id, $value, $class) !!}

@elseif($type=="date")
    {!! \App\Library\Ofac\Input\Input::dayPicker($id, $value, true, $class) !!}

@elseif(substr_count($type, "dropdown-")>0)
    {!! \App\Library\Ofac\Input\DropDown::simple($id, $value, str_replace('dropdown-', '', $type), $class) !!}

@else
    <b class="text-danger">Type "{{ $type }}" has not been implemented yet.</b>
@endif
