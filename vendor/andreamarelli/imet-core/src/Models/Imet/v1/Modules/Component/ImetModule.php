<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v1\Modules\Component;

use AndreaMarelli\ImetCore\Models\Imet\Components\Upgrade;
use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ModularForms\Models\Module;
use AndreaMarelli\ImetCore\Models\Imet\v1\Imet;
use Illuminate\Support\Facades\App;


class ImetModule extends Module
{
    use Upgrade;
    use ConvertSQLite;

    public const CREATED_AT = 'UpdateDate';
    public const UPDATED_AT = 'UpdateDate';
    public const UPDATED_BY = 'UpdateBy';

    protected $primaryKey = 'id';
    public static $foreign_key = 'FormID';

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    public $ratingLegend = null;
    public $module_subTitle = null;
    public $module_info_EvaluationQuestion = null;
    public $module_info_Rating = null;

    /**
     * Relation to IMET form
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function imet()
    {
        return $this->belongsTo(Imet::class, 'FormID');
    }

    public static function getDefinitions($form_id = null): array
    {
        $definitions = parent::getDefinitions($form_id);
        $model = new static();
        $definitions['ratingLegend'] = $model->ratingLegend;
        $definitions['module_subTitle'] = $model->module_subTitle;
        $definitions['module_info_EvaluationQuestion'] = $model->module_info_EvaluationQuestion;
        $definitions['module_info_Rating'] = $model->module_info_Rating;
        return $definitions;
    }

    /**
     * Get predefined_values according to form language
     * @param null $form_id
     * @return null
     */
    protected static function getPredefined($form_id = null)
    {
        // Force Language
        if($form_id!==null){
            $FormLang = Imet::getLanguage($form_id);
            if($FormLang != App::getLocale()){
                App::setLocale($FormLang);
            }
        }
        return parent::getPredefined($form_id);
    }

}
