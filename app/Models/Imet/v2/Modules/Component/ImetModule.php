<?php

namespace App\Models\Imet\v2\Modules\Component;

use App;
use App\Models\Components\Module;
use App\Models\Imet\v2\Imet;


class ImetModule extends Module
{

    use Upgrade;

    public const CREATED_AT = 'UpdateDate';
    public const UPDATED_AT = 'UpdateDate';
    public const UPDATED_BY = 'UpdateBy';

    protected $primaryKey = 'id';
    public static $foreign_key = 'FormID';

    public $ratingLegend = null;
    public $module_subTitle = null;
    public $module_info_EvaluationQuestion = null;
    public $module_info_Rating = null;

    /**
     * Override: upgrade module before importing
     *
     * @param $form_id
     * @param $data
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public static function importModule($form_id, $data)
    {
        parent::importModule($form_id, $data);
    }

    /**
     * Relation to IMET form
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function imet()
    {
        return $this->belongsTo(Imet::class, 'FormID');
    }

    /**
     * Override: additional info labels
     *
     * @param null $form_id
     * @return array
     * @throws \ReflectionException
     */
    public static function getDefinitions($form_id = null)
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
     * Override: Get predefined_values according to form language
     * @param null $form_id
     * @return null
     */
    protected static function getPredefined($form_id = null)
    {
        static::forceLanguage($form_id);
        return parent::getPredefined($form_id);
    }

    /**
     * Force locale to IMET language in order to retrieve correct label from lang
     * @param null $form_id
     */
    public static function forceLanguage($form_id = null)
    {
        if($form_id!==null){
            $FormLang = Imet::getLanguage($form_id);
            if($FormLang != App::getLocale()){
                App::setLocale($FormLang);
            }
        }
    }

    /**
     * Compare updated records with existing (in DB) and drop from dependant modules
     * @param $form_id
     * @param $updatedRecords
     * @param $dependencyClasses
     */
    public static function dropFromDependencies($form_id, $updatedRecords, $dependencyClasses)
    {
        $reference_field = (new static())->module_fields[0]['name'];
        $toBeDropped = static::getModule($form_id)->pluck($reference_field)->diff(
            collect($updatedRecords)->pluck($reference_field)
        )->all();
        $toBeDropped = array_values($toBeDropped);

        foreach ($dependencyClasses as $class){
            /** @var \App\Models\Imet\v2\Modules\Component\ImetModule $class */
            $class::dropListed($form_id, $toBeDropped);
        }
    }


    /**
     * Drop all records where first field is listed in the given reference list (use for dependent modules, ex: CTX -> Evaluation)
     * @param $form_id
     * @param $reference_list
     */
    public static function dropListed($form_id, $reference_list)
    {
        $reference_field = (new static())->module_fields[0]['name'];
        foreach (static::getModuleRecords($form_id)['records'] as $record) {
            if(in_array($record[$reference_field], $reference_list)){
                static::destroy($record[(new static())->primaryKey]);
            }
        }
    }

}
