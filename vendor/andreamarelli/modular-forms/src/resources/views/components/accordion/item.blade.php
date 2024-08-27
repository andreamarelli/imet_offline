<div {{ $attributes->merge(['class' => 'accordion-item']) }}>

    @if($title!=='')
        <div class="accordion-item-header">
                <div class="accordion-item-header-title" @if($isCollapsible) onclick="window.ModularForms.Accordion.toggle(event)" @endif>
                    {{ $title }}
                </div>
            <div>
                {{ $headerActions }}
            </div>
        </div>
    @endif

    <div class="accordion-item-body">
        <div class="accordion-item-body-content">
            {{ $slot }}
        </div>
    </div>

</div>
