<?php
/** @var \AndreaMarelli\ImetCore\Models\Imet\oecm\Imet $item */
/** @var array $assessment */
/** @var array $key_elements */
/** @var array $report */
/** @var array $general_info */
/** @var array $vision */
/** @var array $area */
/** @var bool $show_non_wdpa */
/** @var Array $non_wdpa */
?>

@include('imet-core::oecm.report.report', [
    'action' => 'show',
    'assessment' => $assessment,
    'key_elements' => $key_elements,
    'report' => $report,
    'general_info' => $general_info,
    'vision' => $vision,
    'area' => $area,
    'show_non_wdpa' => $show_non_wdpa,
    'non_wdpa' => $non_wdpa,
    'type' => 'show'
])
