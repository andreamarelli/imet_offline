<?php

namespace AndreaMarelli\ImetCore\Models\Imet\API\ScalingUp;

use AndreaMarelli\ImetCore\Models\Imet\API\ScalingUp\Analysis\Average;
use AndreaMarelli\ImetCore\Models\Imet\API\ScalingUp\Analysis\Data;
use AndreaMarelli\ImetCore\Models\Imet\API\ScalingUp\Analysis\DataUpperLowerAverage;
use AndreaMarelli\ImetCore\Models\Imet\API\ScalingUp\Analysis\Ranking;

trait Analysis
{
    use Ranking;
    use Data;
    use Average;
    use DataUpperLowerAverage;
}
