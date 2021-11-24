<?php
/** @var string $filter_content */
/** @var string $url */
/** @var string $method [optional] */
/** @var \Illuminate\Http\Request $request [optional] */
/** @var boolean $expanded [optional] */
/** @var boolean $accordion_title [optional] */
/** @var boolean $submit_button_label [optional] */

$method              = $method ?? 'GET';
$url                 = \Illuminate\Support\Str::contains($url, url('/')) ? $url : url('/') . '/' . $url;
$expanded            = $expanded ?? false;
$accordion_title     = $accordion_title ?? trans('modular-forms::common.filters');
$submit_button_label = $submit_button_label ?? trans('modular-forms::common.apply_filters');

?>

<div class="accordion" id="accordion-filters" style="margin-bottom: 40px;">
    @component('modular-forms::page.accordion', [
                'accordion_group_id' => 'accordion-filters',
                'accordion_id' => 'accordion-filters-1',
                'accordion_title' => mb_strtoupper($accordion_title),
                'expanded' => $expanded,
            ])

        @slot('accordion_content')
            <form class="form-horizontal form-filters" method="{{ $method }}" action="{{ $url }}">
                {{ csrf_field() }}

                <div class="form-grid">
                    {{ $filter_content }}
                </div>

                <div class="text-right">
                    <button type="submit" class="btn-nav rounded">{{ ucfirst($submit_button_label) }}</button>
                </div>

            </form>
        @endslot

    @endcomponent
</div>
