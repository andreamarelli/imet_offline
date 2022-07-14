<?php
/** @var bool $is_negative */
/** @var string $rating */
/** @var string $color */

$is_negative = $is_negative ?? false;
$echo_rating = "{{ ".$rating." }}";
$color = $color ?? 'step_color';

?>

<div class="progress-bar progress-bar-striped {{ $is_negative ? ' progress-bar-negative' : '' }}"
     role="progressbar"
     :style="{ width: Math.abs(<?php echo $rating; ?>) + '%', backgroundColor: <?php echo $color; ?> + ' !important'}">
    <span v-if="<?php echo $rating; ?>!==null"><?php echo $echo_rating; ?> %</span>
</div>
