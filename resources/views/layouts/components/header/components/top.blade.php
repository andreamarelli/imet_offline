<div id="top">
    {{-- Search --}}
{{--    <form id="search" action="{{ url('/') }}/tools/search" method="GET">--}}
{{--        <span id="search_form" class="closed">--}}
{{--            <input type="text" id="key" name="key" /><br />--}}
{{--            <input type="radio" id="search_pages" name="search_pages" value="page" checked="checked">@lang('layout.search.pages')<br />--}}
{{--            <input type="radio" id="search_glossary" name="search_glossary" value="glossary">@lang('layout.search.glossary')<br />--}}
{{--            <input type="submit" id="doSearch" value="@lang('layout.search.search')"/>--}}
{{--        </span>--}}
{{--        <span id="search_button">--}}
{{--            <a href="#" class="open">--}}
{{--                <img class="lineal" src="{{ asset('images/icons/lineal/32/dark').'/' }}magnifier.png" style="width: 24px;" />--}}
{{--            </a>--}}
{{--        </span>--}}
{{--    </form>--}}

{{--    <script>--}}
{{--        $(function() {--}}

{{--            let searchForm = $('#search');--}}

{{--            $(searchForm).find('.open').click(function (e) {--}}
{{--                e.preventDefault();--}}
{{--                let search_form = $(this).parents('#search').children('#search_form');--}}
{{--                if ($(search_form).hasClass('closed')) {--}}
{{--                    $(search_form).removeClass('closed');--}}
{{--                } else {--}}
{{--                    $(search_form).addClass('closed');--}}
{{--                }--}}
{{--            });--}}
{{--            $(searchForm).on('submit', function (e) {--}}
{{--                if ($(this).children('#search_form').children('#key').val() === '') {--}}
{{--                    e.preventDefault();--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}

    {{-- Admin --}}
    <span id="admin">
        <a href="{{ url('/') }}/admin">
            <img class="lineal" src="{{ asset('images/icons/lineal/32/dark').'/' }}user.png" style="width: 24px;" />
        </a>
    </span>

    {{-- Language --}}
    <span id="language">
        <a href="{{ url()->current() }}?lang=fr" class="selected">Fr</a><a href="{{ url()->current() }}?lang=en">En</a>
    </span>

</div>