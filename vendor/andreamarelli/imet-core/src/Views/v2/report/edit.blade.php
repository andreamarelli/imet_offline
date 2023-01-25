<?php
/** @var \AndreaMarelli\ImetCore\Models\Imet\v2\Imet $item */
/** @var array $assessment */
/** @var array $key_elements */
/** @var array $report */
/** @var array $wdpa_extent */
/** @var array $dopa_radar */
/** @var array $dopa_indicators */
/** @var array $general_info */
/** @var array $vision */
/** @var array $area */
/** @var bool  $connection */
/** @var bool  $show_api */
/** @var bool $show_non_wdpa */
/** @var Array $non_wdpa */
?>

@include('imet-core::v2.report.report', [
    'action' => 'edit',
    'assessment' => $assessment,
    'key_elements' => $key_elements,
    'report' => $report,
    'wdpa_extent' => $wdpa_extent,
    'dopa_radar' => $dopa_radar,
    'dopa_indicators' => $dopa_indicators,
    'general_info' => $general_info,
    'vision' => $vision,
    'area' => $area,
    'connection' => $connection,
    'show_api' => $show_api,
    'show_non_wdpa' => $show_non_wdpa,
    'non_wdpa' => $non_wdpa,
    'type' => 'edit'
])
