<?php
/** @var string $row_type */
/** @var string $values */
/** @var string $index */
/** @var bool $synthetic_indicator */

$synthetic_indicator = isset($synthetic_indicator) ? $synthetic_indicator : false;

if($synthetic_indicator){
    $code = '';
    $title = '<b class="text-uppercase">'.trans('form/imet/v2/common.synthetic_indicator').'</b>';
    $rating =  'synthetic_indicator';
} else {
    $code = isset($index) ? "{{ labels['".$index."'].code }}" : "{{ labels[index].code }}";
    $title = isset($index) ? "{{ labels['".$index."'].title }}" : "{{ labels[index].title }}";
    $rating =  isset($index) ? $values."['".$index."']" : $values."[index]";
}

$echo_rating = "{{ ".$rating." }}";

?>

<div class="histogram-row">

    <div class="histogram-row__code text-center"><b><?php echo $code; ?></b></div>
    <div class="histogram-row__title text-left"><?php echo $title; ?></div>
    <div class="histogram-row__value text-center"><b><?php echo $echo_rating; ?></b></div>
    <div class="histogram-row__progress-bar">

        @if($row_type==='0_to_100_full_width')
            <div class="histogram-row__progress-bar__limit-left">0%</div>
            <div class="histogram-row__progress-bar__bar">
                <div class="progress">
                    @include('admin.imet.v2.evaluation.management_effectiveness.components.progress_bar', ['rating' => $rating])
                </div>
            </div>
            <div class="histogram-row__progress-bar__limit-right">100%</div>

        @elseif($row_type==='0_to_100')
            <div class="histogram-row__progress-bar__spacer"></div>
            <div class="histogram-row__progress-bar__limit-left">0%</div>
            <div class="histogram-row__progress-bar__bar">
                <div class="progress">
                    @include('admin.imet.v2.evaluation.management_effectiveness.components.progress_bar', ['rating' => $rating])
                </div>
            </div>
            <div class="histogram-row__progress-bar__limit-right">100%</div>

        @elseif($row_type==='minus100_to_0')
            <div class="histogram-row__progress-bar__limit-left">-100%</div>
            <div class="histogram-row__progress-bar__bar">
                <div class="progress">
                    @include('admin.imet.v2.evaluation.management_effectiveness.components.progress_bar', ['rating' => $rating, 'is_negative' => true])
                </div>
            </div>
            <div class="col-lg-5 progress_bar_limits_right">0%</div>
            <div class="histogram-row__progress-bar__spacer"></div>

        @elseif($row_type==='minus100_to_100')
            <div class="histogram-row__progress-bar__limit-left">-100%</div>
            <div class="histogram-row__progress-bar__bar">
                <div class="progress" v-if="<?php echo $rating; ?><0">
                    @include('admin.imet.v2.evaluation.management_effectiveness.components.progress_bar', ['rating' => $rating, 'is_negative' => true])
                </div>
                <div class="progress" v-else></div>
            </div>
            <div class="histogram-row__progress-bar__bar">
                <div class="progress" v-if="<?php echo $rating; ?>>0">
                    @include('admin.imet.v2.evaluation.management_effectiveness.components.progress_bar', ['rating' => $rating])
                </div>
                <div class="progress" v-else></div>
            </div>
            <div class="histogram-row__progress-bar__limit-right">100%</div>

        @endif

    </div>

</div>



