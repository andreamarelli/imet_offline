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
        <button class="btn btn-sm act-btn-darkred" @click="flush('all')">
            <i class="fas fa-trash"></i>&nbsp;&nbsp;Remove All
        </button>
        <button class="btn btn-sm act-btn-darkred" @click="flush('expired')">
            <i class="fas fa-trash"></i>&nbsp;&nbsp;Remove Expired
        </button>
    </div>

    <table class="striped">

        <tr>
            <th>key</th>
            <th>expiration</th>
            <th></th>
        </tr>

        <tr v-for="item in list">
            <td style="word-break: break-word;">
                <b>@{{ item.api }}</b>
                <br />
                @{{ item.params }}
            </td>
            <td class="center width150px">
                <span v-if="item.expiration>{{ $now }}">
                   @{{ human_readable_date(item.expiration) }}
                </span>
                <span v-else>
                    expired<br />
                    <small><i>@{{ human_readable_date(item.expiration) }}</i></small>
                </span>
            </td>
            <td class="width110px">
                <button v-if="item.expiration>{{ $now }}"
                        class="btn btn-sm act-btn-darkred" @click="flush(item.key)">
                    <i class="fas fa-trash"></i>&nbsp;&nbsp;Remove
                </button>
            </td>
        </tr>

    </table>
</div>
@endsection

@push('scripts')

    <script>
        new Vue({
            el: '#app',

            data: {
                list: @json($list)
            },

            methods:{

                human_readable_date(unix){
                    let date = new Date(unix * 1000);
                    return date.toLocaleString();
                },

                flush: function (key) {

                    let url = 'admin/cache/flush';
                    let data = {
                        _token: window.Laravel.csrfToken
                    };

                    if(key==='all'){
                        url = 'admin/cache/flush/all';
                    }
                    else if(key==='expired'){
                        url = 'admin/cache/flush/expired';
                    } else {
                        data.key = encodeURI(key)
                    }

                    window.axios({
                        method: 'post',
                        url: window.Laravel.baseUrl + url,
                        data: data
                    })
                    .then(function (response) {
                        console.log('flushed');
                    })
                    .catch(function (response) {
                        console.log('error');
                    })
                    .finally(function (response) {
                        console.log('finished');
                    });

                },

            }
        });
    </script>

@endpush