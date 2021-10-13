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
            {!! \AndreaMarelli\ModularForms\Helpers\Template::icon('info-circle', '', '1.4em') !!}
        </div>
        <div class="message">
            {!! $definitions['module_info'] !!}
        </div>
    </div>
@endif

@if($definitions['module_info_EvaluationQuestion']!==null || $definitions['module_info_Rating']!==null)
    <div class="module-bar info-black-bar">
        <div class="icon blue">
            {!! \AndreaMarelli\ModularForms\Helpers\Template::icon('file-alt', '', '1.4em') !!}
        </div>
        <div class="message">
            <b class="blue">@lang('imet-core::v1_common.indicator')</b>: @lang('imet-core::v1_evaluation.'.$definitions['module_class'].'.title')
            @if($definitions['module_info_EvaluationQuestion']!==null)
                <br /><b class="blue">@lang('imet-core::v1_common.methodology')</b>:
                {!! $definitions['module_info_EvaluationQuestion'] !!}
            @endif
            @if($definitions['module_info_Rating']!==null)
                <br /><b class="blue">@lang('imet-core::v1_common.criteria')</b>:
                {!! $definitions['module_info_Rating'] !!}
            @endif
        </div>
    </div>
@endif


@if($definitions['ratingLegend']!==null)
    <div class="module-bar info-black-bar">
        <div class="icon blue">
            {!! \AndreaMarelli\ModularForms\Helpers\Template::icon('star', '', '1.4em') !!}
        </div>
        <div class="message">
            <b><i>Evaluez le champ sur la base du barême suivant:</i></b><br />
            @foreach($definitions['ratingLegend'] as $field_name => $ratingLegend)
                <?php
                    $field_label = null;
                    foreach ($definitions['fields'] as $field){
                        if($field_name===$field['name']){
                            $field_label = $field['label'];
                        }
                    }
                ?>
                @if($field_label!==null)
                    <b class="blue">{{ $field_label }}</b>:
                @endif
                <ul>
                    @foreach($ratingLegend as $rating=>$label)
                        <li><i><b>{{ $rating }}</b></i>: {{ $label }}</li>
                    @endforeach
                </ul>
            @endforeach
        </div>
    </div>
@endif
