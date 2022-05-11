<?php

namespace AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Component;

use AndreaMarelli\ImetCore\Helpers\Template;
use AndreaMarelli\ImetCore\Models\Imet\Components\Upgrade;
use AndreaMarelli\ImetCore\Models\Imet\v2\Imet;
use AndreaMarelli\ModularForms\Models\Module;
use Illuminate\Support\Facades\App;
use Wa72\HtmlPageDom\Helpers;
use Wa72\HtmlPageDom\HtmlPageCrawler;


class ImetModule extends Module
{
    use Upgrade;

    public const CREATED_AT = 'UpdateDate';
    public const UPDATED_AT = 'UpdateDate';
    public const UPDATED_BY = 'UpdateBy';

    public const TERRESTRIAL = 'terrestrial';
    public const TERRESTRIAL_AND_MARINE = 'terrestrial_and_marine';
    public const MARINE = 'marine';
    public const MODULE_SCOPE = self::TERRESTRIAL_AND_MARINE;

    protected $primaryKey = 'id';
    public static $foreign_key = 'FormID';

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

    /**
     * Override: additional info labels
     *
     * @param null $form_id
     * @return array
     * @throws \ReflectionException
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
            /** @var \AndreaMarelli\ImetCore\Models\Imet\v2\Modules\Component\ImetModule $class */
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

    /**
     * Inject marine/terrestre icon to predefined criteria (EDIT mode with Vue)
     *
     * @param $icon_type
     * @param $view
     * @param $vue_if
     * @return string
     */
    public static function injectIconToPredefinedCriteriaWithVue($icon_type, $view, $vue_if): string
    {
        $dom = HtmlPageCrawler::create(Helpers::trimNewlines($view));
        foreach ($dom->filter('tbody') as $tbody){
            $body_dom = HtmlPageCrawler::create($tbody);
            $td = $body_dom->filter('tr.module-table-item td')->eq(0);
            $td->setStyle('display', 'flex');
            $td->setStyle('align-items', 'center');
            $td->setInnerHtml(
                '<div v-if='.$vue_if.'>
                        ' . Template::module_scope($icon_type) .
                        '</div>&nbsp;&nbsp;'
                . $td->getInnerHtml());
            $td->children()->last()->setStyle('flex-grow', '1');
        }
        return $dom->saveHTML();
    }

    /**
     * Inject marine/terrestre icon to predefined criteria (SHOW mode)
     *
     * @param $icon_type
     * @param $view
     * @param $predefined_with_icon
     * @return string
     */
    public static function injectIconToPredefinedCriteria($icon_type, $view, $predefined_with_icon): string
    {
        $dom = HtmlPageCrawler::create(Helpers::trimNewlines($view));
        foreach ($dom->filter('tbody') as $tbody){
            $tr_dom = HtmlPageCrawler::create($tbody)->filter('tr.module-table-item');
            foreach ($tr_dom as $tr){
                $td = HtmlPageCrawler::create($tr)->filter('td')->first();
                $div = HtmlPageCrawler::create($td)->filter('div.field-preview');
                $td->setStyle('display', 'flex');
                $td->setStyle('align-items', 'center');
                if(in_array(trim($div->getInnerHtml()), $predefined_with_icon)){
                    $td->setInnerHtml(
                        '<div>' . Template::module_scope($icon_type) .'</div>&nbsp;&nbsp;'
                        . $td->getInnerHtml());
                }
                $td->children()->last()->setStyle('flex-grow', '1');
            }
        }
        return $dom->saveHTML();
    }

    public static function injectIconToGroups($view, $marine_groups, $terrestrial_groups): string
    {
        $dom = HtmlPageCrawler::create(Helpers::trimNewlines($view));
        $titles = $dom->filter('h5');
        foreach ($titles as $title){
            $title_dom = HtmlPageCrawler::create($title);
            $title_dom->setStyle('display', 'flex');
            $title_dom->setStyle('align-items', 'center');
            if(in_array($title_dom->text(), $marine_groups)){
                $title_dom->setInnerHtml(
                    '<div>' . Template::module_scope(ImetModule::MARINE) .'&nbsp;&nbsp;</div>'
                    . $title_dom->getInnerHtml());
            } elseif(in_array($title_dom->text(), $terrestrial_groups)){
                $title_dom->setInnerHtml(
                    '<div>' . Template::module_scope(ImetModule::TERRESTRIAL) .'&nbsp;&nbsp;</div>'
                    . $title_dom->getInnerHtml());
            } else {
                $title_dom->setInnerHtml(
                    '<div>' . Template::module_scope(ImetModule::MARINE) . Template::module_scope(ImetModule::TERRESTRIAL) .'&nbsp;&nbsp;</div>'
                    . $title_dom->getInnerHtml());
            }
        }
        return $dom->saveHTML();
    }

}
