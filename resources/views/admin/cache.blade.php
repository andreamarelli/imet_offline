<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
$now = \Carbon\Carbon::now()->unix();
?>


@extends('layouts.admin')


@section('admin_page_title')
    API Cache Management
@endsection

@section('content')

<div id="app">

    <div class="text-right">
        <a class="btn btn-sm act-btn-darkred" href="{{ action([\App\Http\Controllers\CacheController::class, 'flushAll']) }}">
            <i class="fas fa-trash"></i>&nbsp;&nbsp;Remove All
        </a>
        <a class="btn btn-sm act-btn-darkred" href="{{ action([\App\Http\Controllers\CacheController::class, 'flushExpired']) }}">
            <i class="fas fa-trash"></i>&nbsp;&nbsp;Remove Expired
        </a>
    </div>

    <table class="striped">

        <tr>
            <th>key</th>
            <th>expiration</th>
            <th></th>
        </tr>

        @foreach($collection as $item)
            <tr>
                <td style="word-break: break-word;">
                    <b>{{ $item->api }}</b>
                    <br />
                    {{ $item->params }}
                </td>
                <td class="center width150px">
                    @if($item->expiration > $now)
                        <span>
                           {{ \Carbon\Carbon::createFromTimestamp($item->expiration)->toDateTimeString() }}
                        </span>
                    @else
                        <span>
                            expired<br />
                            <small>
                                <i>
                                    {{ \Carbon\Carbon::createFromTimestamp($item->expiration)->toDateTimeString() }}
                                </i>
                            </small>
                        </span>
                    @endif
                </td>
                <td class="width110px">
                    @if($item->expiration > $now)
                        <a class="btn btn-sm act-btn-darkred"
                           href="{{ action([\App\Http\Controllers\CacheController::class, 'flushExpired'], [$item->key]) }}">
                            <i class="fas fa-trash"></i>&nbsp;&nbsp;Remove
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach

    </table>
</div>
@endsection
