<?php
/** @var \AndreaMarelli\ModularForms\Models\Form $item */
/** @var string $step */

use \AndreaMarelli\ModularForms\Helpers\ModuleKey;

$scrollButtons = [];
foreach($item::modules()[$step] as $module){
    $code = $module::getDefinitions(null)['module_code'];
    $module_key = 'module_'.ModuleKey::ClassNameToKey($module);
    if($code!==null && !in_array($code, $scrollButtons)){
        $scrollButtons[$module_key] = $code;
    }
}

?>

<div class="scrollButtons">
    <div onclick="window.ModularForms.Mixins.Animation.scrollPageTo(0)" class="scrollToTop">{!! AndreaMarelli\ModularForms\Helpers\Template::icon('arrow-up') !!}</div>
    @if(count($scrollButtons)>=2)
        @foreach($scrollButtons as $anchor => $label)
            <div onclick="window.ModularForms.Mixins.Animation.scrollPageToAnchor('{{ $anchor }}')">{{ $label }}</div>
        @endforeach
    @endif
    <div onclick="window.ModularForms.Mixins.Animation.scrollPageTo(document.body.scrollHeight)" class="scrollToBottom">{!! AndreaMarelli\ModularForms\Helpers\Template::icon('arrow-down') !!}</div>
</div>
