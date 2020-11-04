<?php
/** @var \Illuminate\Database\Eloquent\Collection $collection */
/** @var Mixed $definitions */
/** @var Mixed $vue_data */
?>

@if($definitions['module_subTitle']!==null)
    <div class="module-bar module_subTitle">
        <div class="message">
            {!! ucfirst($definitions['module_subTitle']) !!}
        </div>
    </div>
@endif

@if($definitions['module_info']!==null)
    <div class="module-bar info-bar">
        <div class="icon">
            {!! \App\Library\Utils\Template::icon('info-circle', '', '1.4em') !!}
        </div>
        <div class="message">
            {!! $definitions['module_info'] !!}
        </div>
    </div>
@endif

@if($definitions['module_info_EvaluationQuestion']!==null || $definitions['module_info_Rating']!==null)
    <div class="module-bar info-black-bar">
        <div class="icon blue">
            {!! \App\Library\Utils\Template::icon('file-alt', '', '1.4em') !!}
        </div>
        <div class="message">
            {{-- Methodology --}}
            <b class="blue">@lang('form/imet/v2/common.methodology')</b>
            @if(is_array($definitions['module_info_EvaluationQuestion']))
                <ul>
                    @foreach($definitions['module_info_EvaluationQuestion'] as $method)
                        <li>{!! $method !!}</li>
                    @endforeach
                </ul>
            @else
                <ul>
                    <li>{!! $definitions['module_info_EvaluationQuestion'] !!}</li>
                </ul>
            @endif
            {{-- Criteria --}}
            @if($definitions['module_info_Rating']!==null)
                <b class="blue">@lang('form/imet/v2/common.criteria')</b>
                @if(is_array($definitions['module_info_Rating']))
                    <ul>
                        @foreach($definitions['module_info_Rating'] as $criteria)
                            <li>{!! $criteria !!}</li>
                        @endforeach
                    </ul>
                @else
                    <ul>
                        <li>{!! $definitions['module_info_Rating'] !!}</li>
                    </ul>
                @endif
            @endif
        </div>
    </div>
@endif


@if($definitions['ratingLegend']!==null)
    <div class="module-bar info-black-bar">
        <div class="icon blue">
            {!! \App\Library\Utils\Template::icon('star', '', '1.4em') !!}
        </div>
        <div class="message">
            @foreach($definitions['ratingLegend'] as $field_name => $ratingLegend)

                @foreach ($definitions['fields'] as $field)
                    @if($field_name === $field['name'])
                        <b class="blue">{{ $field['label'] }}</b>:
                    @endif
                @endforeach
                @foreach ($definitions['common_fields'] as $field)
                    @if($field_name === $field['name'])
                        <b class="blue">{{ $field['label'] }}</b>:
                    @endif
                @endforeach
                <ul>
                    @foreach($ratingLegend as $rating=>$label)
                        <li><i><b>{{ $rating }}</b></i>: {{ $label }}</li>
                    @endforeach
                </ul>
            @endforeach
        </div>
    </div>
@endif