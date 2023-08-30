<?php

use AndreaMarelli\ImetCore\Models\Imet\oecm\Imet;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\AnalysisStakeholderDirectUsers;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\AnalysisStakeholderIndirectUsers;
use AndreaMarelli\ImetCore\Models\Imet\oecm\Modules\Context\Stakeholders;
use Illuminate\Support\Facades\App;

/** @var Imet $item */

// Force Language
if($item->language != App::getLocale()){
    App::setLocale($item->language);
}

$stakeholders_direct = Stakeholders::getStakeholders($item->getKey(), Stakeholders::ONLY_DIRECT, true);
$stakeholders_indirect = Stakeholders::getStakeholders($item->getKey(), Stakeholders::ONLY_INDIRECT, true);

$definitions_direct = AnalysisStakeholderDirectUsers::getDefinitions($item->getKey());
$definitions_indirect = AnalysisStakeholderIndirectUsers::getDefinitions($item->getKey());

?>

@extends('modular-forms::layouts._base', ['class_to_body' => 'flex-col'])


@section('body')

    <main class="one-col">
        <section class="content">

            <button class="btn-nav" style="margin-bottom: 20px;" onclick="window.print()">PRINT</button>

            {{--  Modules (by step) --}}
            <div class="imet_modules">

                {{-- Direct --}}
                @foreach($stakeholders_direct as $stakeholder => $categories)
                    <div class="module-container">
                        <div class="module-header">
                            <div class="module-title">@lang('imet-core::oecm_context.AnalysisStakeholders.analysis')
                                - {{ $stakeholder }}</div>
                        </div>
                        @include('modular-forms::module.info', ['definitions' => $definitions_direct])
                        <div class="module-body">
                            @include('imet-core::oecm.context.modules_show.analysis_stakeholder_print', [
                                'item' => $item,
                                'stakeholders' => $stakeholders_direct,
                                'categories' => $categories,
                                'definitions' => $definitions_direct
                            ])
                        </div>
                    </div>
                    {{-- PDF page break --}}
                    <div style="page-break-before:always">&nbsp;</div>
                @endforeach

                {{-- Indirect --}}
                @foreach($stakeholders_indirect as $stakeholder => $categories)
                    <div class="module-container">
                        <div class="module-header">
                            <div class="module-title">@lang('imet-core::oecm_context.AnalysisStakeholders.analysis')
                                - {{ $stakeholder }}</div>
                        </div>
                        @include('modular-forms::module.info', ['definitions' => $definitions_indirect])
                        <div class="module-body">
                            @include('imet-core::oecm.context.modules_show.analysis_stakeholder_print', [
                                'item' => $item,
                                'stakeholders' => $stakeholders_indirect,
                                'categories' => $categories,
                                'definitions' => $definitions_indirect
                            ])
                        </div>
                    </div>
                    {{-- PDF page break --}}
                    <div style="page-break-before:always">&nbsp;</div>
                @endforeach


            </div>

        </section>
    </main>

@endsection
