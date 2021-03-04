<?php

$definitions = $module::getDefinitions();
$type = in_array($step, $imet_keys) ? 'i' : 'i_ev';

?>
<td class="align-baseline col-md-3">
    {{$definitions['module_title']}}
</td>
<td class="align-baseline col-md-1">
    <a href="{{ route('csv', ['ids' => $results, 'step_id'=> $module_key, 'step'=> $step, 'type'=> $type]) }}" target="_blank" role="button" data-toggle="tooltip" data-placement="top" data-original-title="Export" class="btn btn-sm btn-primary"><span class="fas fa-fw fa-cloud-download-alt  "></span></a>
</td>