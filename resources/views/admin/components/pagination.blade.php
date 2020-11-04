<?php
/** @var \Illuminate\Database\Eloquent\Collection|\Illuminate\Pagination\LengthAwarePaginator $list */

$num_records = $list instanceof \Illuminate\Pagination\LengthAwarePaginator ? $list->total() : count($list);
?>

{{-- Records count and pagination pages --}}
<div class="row">
    <div class="col-lg-7">
        <b>{{ $num_records }}</b> {{ trans_choice('common.record_found', $num_records) }}.
    </div>
    <div class="col-lg-5 text-right">
        @if($list instanceof \Illuminate\Pagination\LengthAwarePaginator && $list->lastPage()>1)
            {{ucfirst(trans('common.page'))}} {{ $list->currentPage() }} / {{ $list->lastPage() }}
        @endif
    </div>
</div>

{{-- item list --}}
<div>
    @if($num_records>0)
        {{ $items_list }}
    @endif
</div>

{{-- Pagination links --}}
@if($list instanceof \Illuminate\Pagination\LengthAwarePaginator && $list->lastPage()>1)
    <div class="row">
        <div class="col-lg-12 text-right">
            {{ $list->appends(\Illuminate\Support\Facades\Request::except('page'))->links() }}
        </div>
    </div>
@endif