@if($definitions['module_info']!==null)

    {{-- #### Plain: div below module title bar #### --}}
    <div class="module-bar info-bar">
        <div class="icon">
            {!! \AndreaMarelli\ModularForms\Helpers\Template::icon('info-circle', '', '1.4em') !!}
        </div>
        <div class="message">
            {!! $definitions['module_info'] !!}
        </div>
    </div>

@endif
