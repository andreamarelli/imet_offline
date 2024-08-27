<?php
/** @var \AndreaMarelli\ModularForms\Models\Form $item */
/** @var string $step */

use \AndreaMarelli\ModularForms\Helpers\ModuleKey;

$scrollButtons = [];
foreach($item::modulesByStep($step) as $module){
    $code = $module::getDefinitions(null)['module_code'];
    $module_key = 'module_'.ModuleKey::ClassNameToKey($module);
    if($code!==null && !in_array($code, $scrollButtons)){
        $scrollButtons[$module_key] = $code;
    }
}

?>

@if(!empty($scrollButtons))
    <div class="scrollButtons collapsible">
        <div onclick="window.ModularForms.Helpers.Animation.scrollPageTo(0)" class="scrollToTop">{!! AndreaMarelli\ModularForms\Helpers\Template::icon('arrow-up') !!}</div>
        <div class="scrollSpacer"></div>
        @if(count($scrollButtons)>2)
            @foreach($scrollButtons as $anchor => $label)
                <div onclick="window.ModularForms.Helpers.Animation.scrollPageToAnchor('{{ $anchor }}')" class="scrollToAnchor">{{ $label }}</div>
            @endforeach
        @endif
        <div onclick="window.ModularForms.Helpers.Animation.scrollPageTo(document.body.scrollHeight)" class="scrollToBottom">{!! AndreaMarelli\ModularForms\Helpers\Template::icon('arrow-down') !!}</div>
    </div>
@endif
