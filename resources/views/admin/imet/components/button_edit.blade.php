<?php
/** @var String $version */

if($version==='v1'){
    $controller_context = \App\Http\Controllers\Imet\ImetControllerV1::class;
    $controller_eval = \App\Http\Controllers\Imet\ImetEvalControllerV1::class;
} else {
    $controller_context = \App\Http\Controllers\Imet\ImetControllerV2::class;
    $controller_eval = \App\Http\Controllers\Imet\ImetEvalControllerV2::class;
}
?>

<span class="imet_encode_popover">

    <button class="btn btn-sm btn-warning"
       role="button"
       data-toggle="popover" data-trigger="focus" data-placement="top" :data-popover-content="'popover_edit_'+item.FormID" >
        {!! App\Library\Utils\Template::icon('pen', 'white') !!}
    </button>

    <div :id="'popover_edit_'+item.FormID" style="display: none">
        <div class="popover-heading">
            {{ ucfirst(trans('form/imet/common.encode')) }}
        </div>
        <div class="popover-body">

            {{-- Context --}}
            @include('admin.components.buttons._generic', [
                'controller' => $controller_context,
                'action' =>'edit',
                'item' => 'item.FormID',
                'label' => ucfirst(trans('form/imet/common.context')),
                'icon' => 'list',
                'class' => 'btn-warning',
                'new_page' => false
            ])

            {{-- Evaluation --}}
            @include('admin.components.buttons._generic', [
                'controller' => $controller_eval,
                'action' =>'edit',
                'item' => 'item.FormID',
                'label' => ucfirst(trans('form/imet/common.evaluation')),
                'icon' => 'check-circle',
                'class' => 'btn-warning',
                'new_page' => false
            ])

            {{-- Analysis Report --}}
            @if($version==='v2')
                @include('admin.components.buttons._generic', [
                    'controller' => $controller_context,
                    'action' =>'report',
                    'item' => 'item.FormID',
                    'label' => ucfirst(trans('form/imet/common.report')),
                    'icon' => 'flag-checkered',
                    'class' => 'btn-warning',
                    'new_page' => false
                ])
            @endif

        </div>
    </div>

</span>

@push('scripts')
    <style>
        .popover-header{
            font-size: 0.9em;
            font-style: italic;
            font-weight: bold;
            text-align: center;
        }
        .popover-body{
            display: flex;
            flex-direction: column;
        }
        .popover-body a{
            margin: 3px;
        }
    </style>

    @push('scripts')
        @once

        <script>

            // ###########################  Bootstrap popover  ###########################
            window.onload = function(){

                $('[data-toggle="popover"]').popover({
                    html : true,
                    content: function() {
                        return document
                            .getElementById(this.getAttribute('data-popover-content'))
                            .querySelector(".popover-body").innerHTML;
                    },
                    title: function() {
                        return document
                            .getElementById(this.getAttribute('data-popover-content'))
                            .querySelector(".popover-heading").innerHTML;
                    }
                });
            }

        </script>
        @endonce
    @endpush
@endpush
