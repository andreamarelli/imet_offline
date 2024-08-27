<?php

namespace AndreaMarelli\ImetCore\Models\Imet\Components\Modules;

use AndreaMarelli\ImetCore\Helpers\Database;
use AndreaMarelli\ImetCore\Models\Imet\Components\Dependencies;
use AndreaMarelli\ImetCore\Models\User\Role;
use AndreaMarelli\ModularForms\Models\Module;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\App;
use ReflectionException;


class ImetModule extends Module
{
    use InjectInView;
    use Dependencies;

    protected static $form_class;

    public const CREATED_AT = 'UpdateDate';
    public const UPDATED_AT = 'UpdateDate';
    public const UPDATED_BY = 'UpdateBy';

    public const TERRESTRIAL = 'terrestrial';
    public const TERRESTRIAL_AND_MARINE = 'terrestrial_and_marine';
    public const MARINE = 'marine';
    public const MODULE_SCOPE = self::TERRESTRIAL_AND_MARINE;

    public const REQUIRED_ACCESS_LEVEL = Role::ACCESS_LEVEL_FULL;

    protected string $schema;
    protected $primaryKey = 'id';
    public static $foreign_key = 'FormID';

    public $ratingLegend = null;
    public $module_subTitle = null;
    public $module_info_EvaluationQuestion = null;
    public $module_info_Rating = null;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        [$this->schema, $this->connection] = Database::getSchemaAndConnection($this->schema);
    }

    /**
     * Relation to IMET form
     * @return BelongsTo
     */
    public function imet(): BelongsTo
    {
        return $this->belongsTo(static::$form_class, 'FormID');
    }

    /**
     * Override: additional info labels
     *
     * @param null $form_id
     * @return array
     * @throws ReflectionException
     */
    public static function getDefinitions($form_id = null): array
    {
        $definitions = parent::getDefinitions($form_id);
        $model = new static();
        $definitions['ratingLegend'] = $model->ratingLegend;
        $definitions['module_subTitle'] = $model->module_subTitle;
        $definitions['module_info_EvaluationQuestion'] = $model->module_info_EvaluationQuestion;
        $definitions['module_info_Rating'] = $model->module_info_Rating;
        $definitions['module_scope'] = static::MODULE_SCOPE;
        return $definitions;
    }

    /**
     * Override: Get predefined_values according to form language
     */
    protected static function getPredefined($form_id = null): ?array
    {
        static::forceLanguage($form_id);
        return parent::getPredefined($form_id);
    }


    /**
     * Override: Check for "warning_on_save" labels
     */
    public static function getVueData($form_id, $records, $definitions): array
    {
        $vue_data = parent::getVueData($form_id, $records, $definitions);
        return static::warningOnSave($vue_data);
    }

    /**
     * Override: update dependent modules
     */
    public static function updateModuleRecords($records, $form_id): void
    {
        static::updateDependencies($records, $form_id);
        parent::updateModuleRecords($records, $form_id);
    }

    /**
     * Force locale to IMET language in order to retrieve correct label from lang
     */
    public static function forceLanguage($form_id = null): void
    {
        if($form_id!==null){
            $FormLang = (static::$form_class)::getLanguage($form_id);
            if($FormLang != App::getLocale()){
                App::setLocale($FormLang);
            }
        }
    }

}
