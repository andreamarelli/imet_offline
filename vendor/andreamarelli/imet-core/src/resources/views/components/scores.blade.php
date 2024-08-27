<?php
use AndreaMarelli\ImetCore\Controllers\Imet\ApiController;
use AndreaMarelli\ImetCore\Models\Imet;
use AndreaMarelli\ImetCore\Services\Assessment\ImetAssessment;
use AndreaMarelli\ImetCore\Services\Scores\Functions\_Scores;

/** @var String $step */
/** @var Imet\v1\Imet|Imet\v2\Imet|Imet\oecm\Imet $item */

$scores = $version === Imet\Imet::IMET_OECM
    ? ApiController::scores_oecm($item->getKey())->getData()
    : ApiController::scores($item->getKey())->getData();


$labels = ImetAssessment::get_scores_labels($item->version, $item->language);

//dd($scores, $labels);
?>

<div id="assessment_scores">
    <imet_scores
        current_step="{{ $step }}"
        :labels='@json($labels)'
        :store=store
        version="{{ $version }}"
    ></imet_scores>
</div>

@push('scripts')
    <script type="module">
        window.AssessmentScores = (new window.ImetCore.Apps.AssessmentScores({
            api_data: @json($scores),
        }))
            .mount('#assessment_scores');
    </script>
@endpush