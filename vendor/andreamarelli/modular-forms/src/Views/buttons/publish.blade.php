<?php
/** @var \AndreaMarelli\ModularForms\Controllers\FormController $controller */
/** @var \AndreaMarelli\ModularForms\Models\Form $item */

?>

<a href="{{ action([$controller, 'publish'], [$item->getKey()]) }}"
   target="_blank"
   class="btn-nav small"
   role="button"
   data-toggle="tooltip" data-placement="top" data-original-title="@lang('modular-forms::common.show')">
    {!! AndreaMarelli\ModularForms\Helpers\Template::icon('eye', 'white') !!}
</a>
