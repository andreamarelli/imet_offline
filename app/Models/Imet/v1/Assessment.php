<?php

namespace App\Models\Imet\v1;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $table = 'imet_assessment.v_imet_eval_stat_step_summary';
    protected $primaryKey = 'formid';


    public function radar()
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
