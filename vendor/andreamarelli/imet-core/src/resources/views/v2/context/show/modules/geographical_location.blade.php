<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $records */


if(!$records[0]['LimitsExist']){
    $definitions['fields'] =  array_splice($definitions['fields'], 0, 1);
}

?>

@include('modular-forms::module.show.type.simple', ['definitions' => $definitions, 'records' => $records])
