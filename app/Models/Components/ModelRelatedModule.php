<?php
namespace App\Models\Components;

use Illuminate\Http\Request;
use Validator;


class ModelRelatedModule extends Module
{
    /** Define the structure of all the relations models and nested sub models
     * Array(
     *      'relation_1' => 'related_relation_11',
     *      'relation_2' => [
     *          'related_relation_21' => 'related_relation_211',
     *          'related_relation_22' => ['related_relation_221']
     *      ]
     * )
     **/
    protected static $RelationsStructure = [];

    public static function getEmptyRecord($form_id = null) {
        $empty_record = parent::getEmptyRecord($form_id);
        foreach (ModelRelatedModule::$RelationsStructure as $relation) {
            if(!empty($relation)) $empty_record[$relation] = [];
        }
        return $empty_record;

    }

    public static function getModule($form_id = null) {
        $model = parent::getModule($form_id);
        foreach(static::buildRelationStrings(static::$RelationsStructure, '.') as $relation) {
            $model->load($relation);
        }
        return $model;
    }

    /**
     * Build a list of all related model relations based on $RelationsStructure
     * @param array $array
     * @param $joiner
     * @param null $prepend
     * @return array
     */
    private static function buildRelationStrings(array $array, $joiner, $prepend = NULL) {
        if (!isset($formatted_array)) { $formatted_array = array(); }
        foreach ($array as $key => $value) {
            if(is_array($value)) {
                $formatted_array = array_merge($formatted_array, ModelRelatedModule::buildRelationStrings($value, $joiner, $prepend . $joiner . $key));
            } elseif(is_int($key)) {
                $formatted_array[] = $prepend . $joiner . $value;
            } else{
                $formatted_array[] = $prepend . $joiner . $key . $joiner . $value;
            }

        }

        if (is_null($prepend)) {
            foreach ($formatted_array as $key => $value) {
                if(!(strpos($value, $joiner) === false)) {
                    $formatted_array[$key] = substr($value, 1);
                }
            }
        }
        return $formatted_array;
    }

    /**
     * Override: save also related models' data
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public static function updateModule(Request $request) {

        $records = json_decode($request->input('records_json'), true);
        $form_id = $request->input('form_id', null);

        $validation_errors = [];
        $records_ids_to_keep = [];

        \DB::beginTransaction();

        // ### Update each record ###
        foreach($records as $index=>$record){
            static::updateModuleData('\\'.static::class, $record, $validation_errors, $records_ids_to_keep, $form_id);
            if(!empty($validation_errors)){
                break;
            }
        }

        if(empty($validation_errors)){

            // ### Delete all records not in $records_ids_to_keep[] ###
            $module_records = static::getModuleRecords($form_id);
            static::cleanDeletedRelatedData($records_ids_to_keep, '\\'.static::class, $module_records['records'], $form_id);


            // Commit transaction & return response
            \DB::commit();
            return static::successResponse($form_id);
        }
        else {
            // RollBack transaction in case of errors  & return response
            \DB::rollBack();
            return static::validationErrorResponse($validation_errors);
        }
    }

    /**
     * Save module data (including related models)
     *
     * @param $model_class
     * @param $model_record
     * @param $validation_errors
     * @param $records_ids_to_keep
     * @param null $form_id
     */
    private static function updateModuleData($model_class, $model_record, &$validation_errors, &$records_ids_to_keep, $form_id = NULL){

        list($related_model_class, $related_model_records, $model_record) = static::extractRelatedModelData($model_class, $model_record);

        $model = new $model_class();

        // Validate model data
        if(!empty($messages = static::validate($model_record))){
            $validation_errors = array_merge($validation_errors,  $messages);
            return;
        } else {

            // Save model
            $model_id = $model::save_record($model_record);
            if(!is_null($model_id)){
                $records_ids_to_keep[$model_class][$form_id][] = $model_id;
            }

            // Update related model data
            foreach ($related_model_records as $related_model_record) {
                $related_model_record[$related_model_class::$foreign_key] = $model_id; // Update related model parent ids
                $related_model_class::updateModuleData($related_model_class, $related_model_record, $validation_errors, $records_ids_to_keep, $model_id);
            }
        }
    }

    /**
     * Separate related model's data from model's data
     * @param $model_class
     * @param $model_record
     * @return array
     */
    private static function extractRelatedModelData($model_class, $model_record){
        $model = new $model_class();
        // Separate model's data from related models' data
        $related_model_records = [];
        $related_model_class = NULL;
        foreach($model_record as $key => $value){
            if(is_array($value) && $model->hasRelation($key)) {
                $related_model_class = '\\'.get_class($model->$key()->getRelated());
                $related_model_records = $value;
                unset($model_record[$key]);
            }
        }
        return [$related_model_class, $related_model_records, $model_record];
    }

    /**
     * Ensure to remove all unnecessary records from related data
     * @param $records_ids_to_keep
     * @param $model_class
     * @param $db_records
     * @param $model_id
     */
    private static function cleanDeletedRelatedData($records_ids_to_keep, $model_class, $db_records, $model_id) {

        foreach ($db_records as $index => $record) {
            if(array_key_exists($model_class, $records_ids_to_keep)
                && array_key_exists($model_id, $records_ids_to_keep[$model_class])
                && in_array($record['id'], $records_ids_to_keep[$model_class][$model_id])
                    ){
                // nothing
            } else {
                $model_class::destroy([$record['id']]);
            }
            list($related_model_class, $related_model_db_records) = static::extractRelatedModelData($model_class, $record);
            static::cleanDeletedRelatedData($records_ids_to_keep, $related_model_class, $related_model_db_records, $record['id']);
        }
    }

    /**
     * Determine if the given relationship (method) exists.
     *
     * @param  string  $key
     * @return bool
     */
    public function hasRelation($key)
    {
        // If the key already exists in the relationships array, it just means the
        // relationship has already been loaded, so we'll just return it out of
        // here because there is no need to query within the relations twice.
        if ($this->relationLoaded($key)) {
            return true;
        }

        // If the "attribute" exists as a method on the model, we will just assume
        // it is a relationship and will load and return results from the query
        // and hydrate the relationship's value on the "relationships" array.
        if (method_exists($this, $key)) {
            return true;
        }

        return false;
    }
}
