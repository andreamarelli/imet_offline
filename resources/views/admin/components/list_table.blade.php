<?php
/** @var \Illuminate\Database\Eloquent\Collection|\Illuminate\Pagination\LengthAwarePaginator $list */

$num_records = $list instanceof \Illuminate\Pagination\LengthAwarePaginator ? $list->total() : count($list);
?>

    {{-- Records count and pagination pages --}}
    <div class="row num_records">
        <div class="col-lg-7">
            <b>{{ $num_records }}</b> {{ trans_choice('common.record_found', $num_records) }}.
        </div>
        <div class="col-lg-5 text-right">
            <i>
                {{ucfirst(trans('common.page'))}} {{ $list->currentPage() }} / {{ $list->lastPage() }}
            </i>
            @if($list instanceof \Illuminate\Pagination\LengthAwarePaginator && $list->lastPage()>1)
                &nbsp;
                @if($list->onFirstPage())
                    <a class="btn act-btn-basic btn-sm" disabled><i class="fa fa-step-backward"></i></a>
                @else
                    <a class="btn act-btn-basic btn-sm" href="{{ $list->appends(\Illuminate\Support\Facades\Request::except('page'))->previousPageUrl() }}"><i class="fa fa-step-backward"></i></a>
                @endif
                &nbsp;
                @if ($list->hasMorePages())
                    <a class="btn act-btn-basic btn-sm" href="{{ $list->appends(\Illuminate\Support\Facades\Request::except('page'))->nextPageUrl() }}"><i class="fa fa-step-forward"></i></a>
                @else
                    <a class="btn act-btn-basic btn-sm" disabled=""><i class="fa fa-step-forward"></i></a>
                @endif
            @endif
        </div>
    </div>

    {{-- Records list TABLE --}}
    <table class="striped" id="item_list_table">
        <thead>
            <tr>
                {{ $header }}
            </tr>
        </thead>
        <tbody>
            @if($num_records>0)
               {{ $rows }}
            @else
                <tr>
                    <td class="text-center" colspan="100%">
                        @lang('common.no_data_found')
                    </td>
                </tr>
            @endif
        </tbody>
    </table>

    <script>
        new Vue({
            el: '#item_list_table',
        });
    </script>