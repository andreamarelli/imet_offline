<?php
/** @var string $url */
/** @var array $steps */
/** @var string $current_step */
/** @var string $label_prefix */
/** @var array $classes */

$url = !\Illuminate\Support\Str::startsWith($url, url('/'))
    ? url('/').'/'.$url
    : $url;
$url = rtrim($url, '/').'/';

?>

<nav class="steps">
    @if(count($steps)>1)
        @foreach($steps as $step)
            <a href="{{ $url.$step }}"
               class="step
               @if(isset($classes[$step]))
                    {{$classes[$step]}}
               @endif
               @if($step==$current_step)
                       selected
               @endif"
            >@uclang($label_prefix.$step)</a>
        @endforeach
    @endif
</nav>
