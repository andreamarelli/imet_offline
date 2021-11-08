<?php
/** @var String $type */
/** @var String $v_value */
/** @var String $id */
/** @var String $class */
/** @var String $rules */
/** @var String $other */
/** @var Mixed $definitions */

?>

@include('modular-forms::module.edit.field.vue', [
    'type' => 'text-area',
    'v_value' => $v_value,
    'id' => $id,
    'class' => $class,
    'rules' => $rules,
    'other' => $other,
    'module_key' => $definitions['module_key']
])


<ul class="text-2xs" style="margin-top: 10px; padding-inline-start: 20px;">
    <li>
        <b>@lang('imet-core::v2_context.CreateNonWdpa.allowed_international')</b>:
        <ul>
            <li>Ramsar Site, Wetland of International Importance</li>
            <li>UNESCO-MAB Biosphere Reserve</li>
            <li>World Heritage Site (natural or mixed)</li>
        </ul>
    </li>
    <li>
        <b>@lang('imet-core::v2_context.CreateNonWdpa.allowed_regional')</b>:
        <ul>
            <li>Baltic Sea Protected Area (HELCOM)</li>
            <li>Specially Protected Area (Cartagena Convention)</li>
            <li>Marine Protected Area (CCAMLR)</li>
            <li>Marine Protected Area (OSPAR)</li>
            <li>Site of Community Importance (Habitats Directive)</li>
            <li>Special Protection Area (Birds Directive)</li>
            <li>Specially Protected Areas of Mediterranean Importance (Barcelona Convention)</li>
        </ul>
    </li>
    <li>
        <b>@lang('imet-core::v2_context.CreateNonWdpa.allowed_national')</b>
    </li>
</ul>

