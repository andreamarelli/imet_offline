<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vueData */
/** @var string $mode */

?>
<h3>@lang('imet-core::v2_context.Governance.governance')</h3>
@include('modular-forms::module.edit.type.commons', compact(['collection', 'vueData', 'definitions']))

<h3>@lang('imet-core::v2_context.Governance.partnership')</h3>
@include('modular-forms::module.edit.type.accordion', compact(['collection', 'vueData', 'definitions']))

@include('modular-forms::module.edit.script', compact(['collection', 'vueData', 'definitions']))
