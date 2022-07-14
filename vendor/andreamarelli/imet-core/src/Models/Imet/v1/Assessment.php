<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Assessment
 *
 * @property mixed $context
 * @property mixed $plans
 * @property mixed $inputs
 * @property mixed $process
 * @property mixed $outputs
 * @property mixed $outcomes
 *
 */
class Assessment extends Model
{
    protected $table = 'imet_assessment_v1_to_v2.v_imet_eval_stat_step_summary';
    protected $primaryKey = 'formid';

    public function radar(): array
    {
        return [
            'C' => $this->context,
            'P' => $this->plans,
            'I' => $this->inputs,
            'PR' => $this->process,
            'R' => $this->outputs,
            'EI' => $this->outcomes
        ];
    }

}
