<?php
/** @var String $version */

if($version === \AndreaMarelli\ImetCore\Models\Imet\Imet::IMET_V1){
    $controller_export = \AndreaMarelli\ImetCore\Controllers\Imet\v1\Controller::class;
}
else if($version === \AndreaMarelli\ImetCore\Models\Imet\Imet::IMET_V2){
    $controller_export = \AndreaMarelli\ImetCore\Controllers\Imet\v2\Controller::class;
}
else {
    $controller_export = \AndreaMarelli\ImetCore\Controllers\Imet\oecm\Controller::class;
}

?>


<span class="imet_show_popover">

    <button class="btn-nav small blue"
            role="button"
            data-toggle="popover" data-trigger="focus" data-placement="top"
            :data-popover-content="'popover_export_'+item.FormID">
        {!! AndreaMarelli\ModularForms\Helpers\Template::icon('cloud-download-alt', 'white') !!}
    </button>

    <div :id="'popover_export_'+item.FormID" style="display: none">
        <div class="popover-heading">
            @uclang('modular-forms::common.export')
        </div>
        <div class="popover-body">

            {{-- Export --}}
            @include('modular-forms::buttons._generic', [
               'controller' => $controller_export,
               'action' =>'export',
               'item' => 'item.FormID',
               'label' => ucfirst(trans('modular-forms::common.export')),
               'icon' => 'cloud-download-alt',
               'class' => 'blue'
           ])

            {{-- Export without attachments --}}
            @include('modular-forms::buttons._generic', [
                'controller' => $controller_export,
                'action' =>'export_no_attachments',
                'item' => 'item.FormID',
               'label' => ucfirst(trans('modular-forms::common.export_no_attachments')),
               'icon' => 'cloud-download-alt',
               'class' => 'blue'
           ])

        </div>
    </div>

</span>

@push('scripts')
    @include('imet-core::components.popover')
@endpush
