<?php
use AndreaMarelli\ImetCore\Controllers\Imet\Controller as ImetController;
use AndreaMarelli\ImetCore\Controllers\Imet\oecm\Controller as OecmController;
?>



@extends('layouts.admin')

@include('imet-core::components.breadcrumbs_and_page_title')

@section('content')

    <div class="welcome_container">
        <a class="welcome_button" href="{{ route(ImetController::ROUTE_PREFIX . 'index') }}">
            <div class="title">@lang('imet-core::common.imet_short')</div>
            <div class="description">@lang('imet-core::common.imet')</div>
        </a>
        <a class="welcome_button" href="{{ route(OecmController::ROUTE_PREFIX . 'index') }}">
            <div class="title">@lang('imet-core::oecm_common.oecm_short')</div>
        </a>
    </div>

@endsection

@push('scripts')
    <style>
        .welcome_container {
            display: flex;
            column-gap: 10px;
            justify-content: space-evenly;
        }

        .welcome_button {
            padding: 60px;
            background-color: #E5E5E5;
            color: #525252;
            border-radius: 4px;
            font-size: 3rem;
            width: 350px;
            text-align: center;
        }
        .welcome_button:hover{
            background-color: #737373;
            color: #D4D4D4;
            text-decoration: none;
        }
        .welcome_button .title{
            line-height: 3rem;
        }
        .welcome_button .description{
            margin-top: 30px;
            display: block;
            font-size: 1.5rem;
            line-height: 1.7rem;
        }

    </style>
@endpush