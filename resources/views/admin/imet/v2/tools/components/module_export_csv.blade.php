<?php
/** @var $moduleClass \App\Models\Components\Module */

$definitions = $moduleClass::getDefinitions();

?>
<td class="align-baseline width150px">
    <b>{{$definitions['module_code']}}</b>
</td>
<td class="align-baseline text-left">
    {{$definitions['module_title']}}
</td>
<td class="align-baseline width150px">
    <a href="{{ route('csv', ['ids' => $results,  'module_key' => \App\Models\Components\ModuleKey::ClassNameToKey($module)]) }}" target="_blank" role="button" data-toggle="tooltip" data-placement="top" data-original-title="Export" class="btn btn-sm btn-primary"><span class="fas fa-fw fa-cloud-download-alt  "></span></a>
</td>
