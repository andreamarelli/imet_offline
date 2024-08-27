<?php
/** @var $moduleClass \AndreaMarelli\ModularForms\Models\Module */

$definitions = $moduleClass::getDefinitions();

?>
<td class="align-baseline width150px">
    <b>{{$definitions['module_code']}}</b>
</td>
<td class="align-baseline text-left">
    {{$definitions['module_title']}}
</td>
<td class="align-baseline width150px">
    <a href="{{ route('imet-core::csv', ['ids' => $results,  'module_key' => \AndreaMarelli\ModularForms\Helpers\ModuleKey::ClassNameToKey($module)]) }}"
       class="btn-nav small"><span class="fas fa-fw fa-cloud-download-alt  "></span></a>
    <tooltip>@uclang('modular-forms::common.export')</tooltip>
</td>
