<?php

$scroll_buttons = [
    'ar1' => 'AR.1',
    'ar2' => 'AR.2',
    'ar3' => 'AR.3',
    'ar4' => 'AR.4',
    'ar5' => 'AR.5',
    'ar6' => 'AR.6'
];

?>

<div class="scrollButtons mb-5">
    <div onclick="window.ModularForms.Mixins.Animation.scrollPageTo(0)"
         class="scrollToTop">{!! AndreaMarelli\ModularForms\Helpers\Template::icon('arrow-up') !!}</div>
    @foreach($scroll_buttons as $anchor => $label)
        <div onclick="window.ModularForms.Mixins.Animation.scrollPageToAnchor('{{ $anchor }}')">{{ $label }}</div>
    @endforeach
    <div onclick="window.ModularForms.Mixins.Animation.scrollPageTo(document.body.scrollHeight)"
         class="scrollToBottom mb-5">{!! AndreaMarelli\ModularForms\Helpers\Template::icon('arrow-down') !!}</div>
</div>

