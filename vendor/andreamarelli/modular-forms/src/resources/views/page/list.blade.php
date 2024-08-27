<?php
/** @var AndreaMarelli\ModularForms\Controllers\Controller $controller */
/** @var Illuminate\Http\Request $request */
/** @var Illuminate\Pagination\LengthAwarePaginator $list */

$num_records = $list instanceof \Illuminate\Pagination\LengthAwarePaginator ? $list->total() : count($list);

?>

@extends('modular-forms::layouts.forms')

@section('content')

    <div id="page-container">

        {{-- Title --}}
        @hasSection('page-title')
            <div class="page-title">
                @yield('page-title')
            </div>
        @endif

        {{-- Functional buttons --}}
        @hasSection('functional-buttons')
            <div class="functional_buttons">
                @yield('functional-buttons')
            </div>
        @endif

       {{-- Filters --}}
        @hasSection('filters')
            @component('modular-forms::page.components.filters', [
                'controller' => $controller,
                'request' => $request
            ])
                @slot('content')
                    @yield('filters')
                @endslot
            @endcomponent
        @endif

        {{-- Selection buttons --}}
        @hasSection('functional-selection-buttons')
            <div class="functional_selection_buttons">
                @yield('functional-selection-buttons')
            </div>
        @endif

        {{-- custom section --}}
        @hasSection('custom')
            @yield('custom')
        @endif

        {{--  Pagination  --}}
        @include('modular-forms::page.components.pagination', ['list'=> $list])

        {{-- form list table --}}
        <table class="striped" id="item_list_table">
            <thead>
                <tr>
                    @yield('list-header')
                </tr>
            </thead>
            <tbody>
                @if($num_records>0)
                    @yield('list-body')
                @else
                    <tr>
                        <td class="text-center" colspan="100%">
                            @lang('common.no_data_found')
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>

    </div>

@endsection

@push('scripts')

    {{-- custom scripts --}}
    @hasSection('scripts')
        @yield('scripts')

    {{-- standard scripts --}}
    @else
        <script type="module">
            (new window.ModularForms.Apps.FormList())
                .mount('#page-container');
        </script>
    @endif

@endpush
