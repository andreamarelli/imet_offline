<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

?>
<h3>@lang('form/imet/v2/context.Governance.governance')</h3>
@include('admin.components.module.edit.type.commons', compact(['collection', 'vue_data', 'definitions']))

<h3>@lang('form/imet/v2/context.Governance.partnership')</h3>
@include('admin.components.module.edit.type.accordion', compact(['collection', 'vue_data', 'definitions']))

@include('admin.components.module.edit.script', compact(['collection', 'vue_data', 'definitions']))