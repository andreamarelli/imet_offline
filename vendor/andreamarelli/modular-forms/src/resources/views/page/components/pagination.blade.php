<?php
/** @var \Illuminate\Database\Eloquent\Collection|\Illuminate\Pagination\LengthAwarePaginator $list */

$num_records = $list instanceof \Illuminate\Pagination\LengthAwarePaginator ? $list->total() : count($list);
?>

    {{-- Records count and pagination pages --}}
    <div class="row">
        <div class="col-lg-7">
            <b>{{ $num_records }}</b> {{ trans_choice('modular-forms::common.record_found', $num_records) }}.
        </div>
        <div class="col-lg-5 text-right">
            @if($list instanceof \Illuminate\Pagination\LengthAwarePaginator && $list->lastPage()>1)
                <i>
                    {{ucfirst(trans('modular-forms::common.page'))}} {{ $list->currentPage() }} / {{ $list->lastPage() }}
                </i>
                {{-- Pagination links --}}
                &nbsp;
                @if($list->onFirstPage())
                    <a class="btn-nav gray small" disabled><i class="fa fa-step-backward"></i></a>
                @else
                    <a class="btn-nav gray small" href="{{ $list->appends(\Illuminate\Support\Facades\Request::except('page'))->previousPageUrl() }}"><i class="fa fa-step-backward"></i></a>
                @endif
                &nbsp;
                @if ($list->hasMorePages())
                    <a class="btn-nav gray small" href="{{ $list->appends(\Illuminate\Support\Facades\Request::except('page'))->nextPageUrl() }}"><i class="fa fa-step-forward"></i></a>
                @else
                    <a class="btn-nav gray small" disabled=""><i class="fa fa-step-forward"></i></a>
                @endif
            @endif
        </div>
    </div>
