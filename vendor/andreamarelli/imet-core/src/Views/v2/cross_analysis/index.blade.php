<?php
/** @var \AndreaMarelli\ImetCore\Models\Imet\v2\Imet $item */

// Force Language
if ($item->language != \Illuminate\Support\Facades\App::getLocale()) {
    \Illuminate\Support\Facades\App::setLocale($item->language);
}
$i = 0;
?>

@extends('layouts.admin')

@section('admin_breadcrumbs')
    @include('modular-forms::page.breadcrumbs', ['show' => false, 'links' => [
        action([\AndreaMarelli\ImetCore\Controllers\Imet\Controller::class, 'index']) => trans('imet-core::common.imet_short')
    ]])
@endsection


@section('content')
    @include('imet-core::components.heading', ['phase' => 'cross-analysis'])
    <div class="module-bar info-bar mt-2 mb-2 guidance">
        <div class="icon blue"><span class="fas fa-fw fa-info-circle" style="font-size: 1.4em;"></span>
        </div>
        <div class="message">
            <div>
                <span>{{trans('imet-core::common.cross_analysis_info')}}</span>
            </div>
        </div>
    </div>
    <div class="imet_modules">
        @if(count($warnings) > 0)
            @foreach($warnings as $k => $w)
                <div class="module-container">
                    <div class="module-header">
                        <div class="module-code text-center">
                            {{$i + 1}}
                        </div>
                    </div>
                    <div class="module-body">
                        <table id="short_names" class="table module-table ">
                            <tbody>
                            @foreach($w as $warning)
                                <tr>
                                    <td class="col-1">{{ $warning['code'] }}</td>
                                    <td class="col-11">
                                        <strong> <a
                                                href="{{ action([\AndreaMarelli\ImetCore\Controllers\Imet\EvalControllerV2::class, 'edit'], [$item->getKey(), $warning['step']]) }}#{{$warning['key']}}"
                                            >{{ $warning['question'] }}</a>
                                        </strong>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php $i++; ?>
            @endforeach
        @else
            <div class="row mt-5">
                <div class="col text-center"> {{trans('imet-core::common.nothing_found')}}</div>
            </div>
        @endif
    </div>
@endsection
