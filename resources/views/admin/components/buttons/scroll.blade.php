<?php
/** @var \App\Models\Imet\v2\Imet $item */
/** @var string $step */

use \App\Models\Components\ModuleKey;

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
    <div onclick="window.Common.scrollPageTo(0)" class="scrollToTop">{!! App\Library\Utils\Template::icon('arrow-up') !!}</div>
    @if(count($scrollButtons)>=2)
        @foreach($scrollButtons as $anchor => $label)
            <div onclick="window.Common.scrollPageToAnchor('{{ $anchor }}')">{{ $label }}</div>
        @endforeach
    @endif
    <div onclick="window.Common.scrollPageTo(document.body.scrollHeight)" class="scrollToBottom">{!! App\Library\Utils\Template::icon('arrow-down') !!}</div>
</div>
