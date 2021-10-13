<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */

?>
<h3>@lang('imet-core::v2_context.Governance.governance')</h3>
@include('modular-forms::module.edit.type.commons', compact(['collection', 'vue_data', 'definitions']))

<h3>@lang('imet-core::v2_context.Governance.partnership')</h3>
@include('modular-forms::module.edit.type.accordion', compact(['collection', 'vue_data', 'definitions']))

@include('modular-forms::module.edit.script', compact(['collection', 'vue_data', 'definitions']))
