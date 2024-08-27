<?php

namespace AndreaMarelli\ModularForms\Models;

use AndreaMarelli\ModularForms\Exceptions\ValidationException;
use AndreaMarelli\ModularForms\Helpers\ModuleKey;
use AndreaMarelli\ModularForms\Helpers\PhpClass;
use AndreaMarelli\ModularForms\Models\Traits\Payload;
use AndreaMarelli\ModularForms\Models\Traits\PredefinedValues;
use AndreaMarelli\ModularForms\Models\Traits\Upload;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class Module extends BaseModel
{
    use PredefinedValues;
    use Upload;

    public $module_type = 'SIMPLE';
    public $module_title = '';
    public $module_code = null;
    public $module_fields = [];
    public $module_common_fields = [];
    public $module_groups = [];
    public static $group_key_field = 'group_key';
    public $module_info = null;
    public $label_width = 3;
    public static $foreign_key = null;
    protected $fixed_rows = false;
    protected $enable_not_applicable = false;
    protected $max_rows = null;

    /**
     * Module constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        // In case foreign_key is null use primary_key
        $this::$foreign_key = $this::$foreign_key === null ? $this->primaryKey : $this::$foreign_key;

        // Copy field rules in this->module_fields
        $new_fields_def = array();
        if (!empty($this->module_fields)) {
            if (isset($this::$rules)) {
                foreach ($this->module_fields as $field) {
                    if (array_key_exists($field['name'], $this::$rules)) {
                        $field['rules'] = $this::$rules[$field['name']];
                    }
                    $new_fields_def[] = $field;
                }
            }
            $this->module_fields = $new_fields_def;
        }

        // Add hidden field for group (only for GROUP_TABLE and GROUP_ACCORDION)
        if (Str::contains($this->module_type, 'GROUP_')) {
            $this->module_fields[] = ['name' => static::$group_key_field, 'type' => 'hidden'];
        }

        parent::__construct($attributes);
    }

    /**
     * Mutator: HashAttribute
     *
     * @return string
     */
    public function getHashAttribute(): string
    {
        return static::getFileModelHash(
            static::class,
            static::getUploadFields()[0],
            $this->{$this->getKeyName()}
        );
    }

    /**
     * Mutator: Hash
     *
     * @param $id
     * @return string
     */
    public static function getHash($id): string
    {
        return static::getFileModelHash(
            static::class,
            static::getUploadFields()[0],
            $id
        );
    }

    /**
     * Return fields names as plain array
     *
     * @param string|array|null $additional_fields
     * @return array
     */
    public static function getModuleFieldsNames($additional_fields = null): array
    {
        $additional_fields = Arr::wrap($additional_fields);

        $model        = new static();
        $model_fields = collect(
            array_merge($model->module_fields, $model->module_common_fields)
        );

        /* Include always "module_fields" & "module_common_fields" */
        $names = $model_fields->pluck('name')->toArray();

        /* IF requested: include primaryKey & foreign_key  */
        if (in_array('KEYS', $additional_fields)) {
            $names[] = $model->primaryKey;
            $names[] = $model::$foreign_key ?? $model->primaryKey;
        }
        /* IF requested: include UPDATED_AT & UPDATED_BY  */
        if (in_array('TIMESTAMPS', $additional_fields)) {
            $names[] = $model::UPDATED_AT;
            $names[] = $model::UPDATED_BY;
        }
        /* IF requested: include FILE_BINARY */
        if (in_array('FILE_BINARY', $additional_fields)) {
            $names = array_merge($names, $model::getUploadFields(true));
        }

        /* not applicable and not available */
        if ($model->enable_not_applicable === true) {
            $names[] = 'not_applicable';
            $names[] = 'not_available';
        }

        // remove duplicates and empty values
        $names = array_unique($names);
        $names = array_filter($names);

        return $names;
    }

    /**
     * Return field type by name
     *
     * @param $name
     * @return String
     */
    public function fieldTypeByName($name): ?string
    {
        foreach ($this->module_fields as $f) {
            if ($f['name'] == $name && isset($f['type'])) {
                return $f['type'];
            }
        }
        foreach ($this->module_common_fields as $f) {
            if ($f['name'] == $name && isset($f['type'])) {
                return $f['type'];
            }
        }
        return null;
    }

    /**
     * Return all labels
     *
     * @param array $only_fields
     * @return array
     */
    public function fieldLabels($only_fields = []): array
    {
        $labels = collect(array_merge($this->module_fields, $this->module_common_fields))
            ->pluck('label','name' );
        $labels = empty($only_fields) ? $labels : $labels->only($only_fields);
        return $labels->toArray();
    }

    /**
     * Return an array of Module's properties' definitions
     *
     * @param null $form_id
     * @return array
     * @throws \ReflectionException
     */
    public static function getDefinitions($form_id = null): array
    {
        $model      = new static();
        $module_key = ModuleKey::ClassNameToKey(get_called_class());
        return [
            'module_key' => $module_key,
            'module_type' => $model->module_type,
            'module_title' => $model->module_title,
            'module_code' => $model->module_code,
            'module_info' => $model->module_info,
            'module_class' => PhpClass::ClassWithoutNamespace(get_called_class()),
            'fields' => $model->module_fields,
            'common_fields' => $model->module_common_fields,
            'groups' => $model->module_groups,
            'group_key_field' => static::$group_key_field,
            'predefined_values' => static::getPredefined($form_id), // From Predefined trait
            'enable_not_applicable' => $model->enable_not_applicable,
            'fixed_rows' => $model->fixed_rows,
            'max_rows' => $model->max_rows,
            'accordion_title_field' => Str::contains($model->module_type, 'ACCORDION')
                ? $model->module_fields[0]['name'] : null,
            'label_width' => $model->label_width,
            'primary_key' => $model->getKeyName(),
        ];
    }

    /**
     * Get module Model/Collection
     *
     * @param int|null $form_id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public static function getModule(int $form_id = null)
    {
        $model               = new static();
        $model::$foreign_key = $model::$foreign_key ?? $model->primaryKey;
        $fields              = $model::getModuleFieldsNames(['KEYS', 'TIMESTAMPS']);
        if ($form_id !== null) {
            return $model->select($fields)
                ->where($model::$foreign_key, $form_id)
                ->orderBy($model->primaryKey)
                ->get();
        } else {
            return Collection::make();
        }
    }

    /**
     * Retrieve Module records
     *
     * @param $form_id
     * @param null $collection
     * @return array
     */
    public static function getModuleRecords($form_id, $collection = null): array
    {
        $collection = is_null($collection) ? static::getModule($form_id) : $collection;
        $collection = static::parse_uploads_from_model($collection);

        $isEmpty      = $collection->isEmpty();
        $empty_record = static::getEmptyRecord($form_id);

        $records = $isEmpty
            ? [0 => $empty_record]
            : $collection->toArray();

        if((!array_key_exists('not_available', $records[0]) || $records[0]['not_available'] !== true) &&
            (!array_key_exists('not_applicable', $records[0]) || $records[0]['not_applicable'] !== true)) {
            $records = static::arrange_records_with_predefined($form_id, $records, $empty_record);
        }

        return [
            'id' => $form_id,
            'empty_record' => $empty_record,
            'records' => $records,
            'last_update' => $isEmpty ? null : $collection->sortByDesc(static::UPDATED_AT)->first()->getLastUpdate()
        ];
    }

    /**
     * Generate the array of data needed by the Vue.JS module's controller
     */
    public static function getVueData($form_id, $records, $definitions): array
    {
        return [
            'module_key' => $definitions['module_key'],
            'module_type' => $definitions['module_type'],
            'common_fields' => $definitions['common_fields'],
            'groups' => $definitions['groups'],
            'group_key_field' => $definitions['group_key_field'],
            'predefined_values' => $definitions['predefined_values'],
            'max_rows' => $definitions['max_rows'],
            'accordion_title_field' => $definitions['accordion_title_field'],
            'empty_record' => $records['empty_record'],
            'records' => $records['records'],
            'last_update' => $records['last_update'],
            'action' => $form_id !== null ? 'update' : 'store',
            'form_id' => $form_id,
            'enable_not_applicable' => $definitions['enable_not_applicable'],
            'warning_on_save' => null
        ];
    }

    /**
     * Export Module record: for export/import
     */
    public static function exportModule($form_id, $exclude_attachments = false): array
    {
        $model               = new static();
        $model::$foreign_key = $model::$foreign_key ?? $model->primaryKey;
        $fields              = $exclude_attachments
            ? $model::getModuleFieldsNames(['KEYS', 'TIMESTAMPS'])
            : $model::getModuleFieldsNames(['KEYS', 'TIMESTAMPS', 'FILE_BINARY']);
        $collection = $model->select($fields)
            ->where($model::$foreign_key, $form_id)
            ->get()
            ->makeHidden([$model->getKeyName(), $model::$foreign_key/*, $model::UPDATED_BY*/])
            ->map(
                function ($item) {
                    // Serialize file stream (from DB) to base64
                    foreach ($item->getAttributes() as $field => $attribute) {
                        if (gettype($attribute) === 'resource') {
                            $item[$field] = base64_encode(stream_get_contents($attribute));
                        }
                    }
                    return $item;
                }
            );
        return $collection->toArray();
    }

    /**
     * Verify if the two given modules are identical
     * @param $module1
     * @param $module2
     * @return bool
     */
    public static function areIdentical($module1, $module2): bool
    {
        $fields_to_hide = [
            (new static())->getKeyName(),
            static::$foreign_key,
            static::UPDATED_AT,
            static::UPDATED_BY
        ];

        $module1 = unserialize(serialize($module1));

        return $module1
                ->makeHidden($fields_to_hide)
                ->toArray()
            == $module2
                ->makeHidden($fields_to_hide)
                ->toArray();
    }

    /**
     * Import record to a Module: from export
     *
     * @param $form_id
     * @param $data
     * @throws FileNotFoundException
     */
    public static function importModule($form_id, $data)
    {
        if($data!==null && $data!==[]){
            $model = new static();
            // Inject Form id
            $data[$model::$foreign_key] = $form_id;
            // Remove primary key
            unset($data[$model->getKeyName()]);
            // Fill model with data
            $model->fill($data);
            $model->save();
            unset($model);
        }
    }

    /**
     * Check if the Module has records
     *
     * @param null $form_id
     * @return bool
     */
    public static function hasRecord($form_id = null): bool
    {
        if ($form_id !== null) {
            $model = new static();
            $count = $model::where($model::$foreign_key, $form_id)->count();
            if ($count > 0) {
                return true;
            }
        }
        return false;
    }

    /**
     * Save module data in a transaction
     *
     * @param Request $request
     * @return array
     * @throws Exception
     */
    public static function updateModule(Request $request): array
    {
        // ### Get records form request ###
        $records = Payload::decode($request->input('records_json'));
        $form_id = $request->input('form_id');

        try {
            // ### Save all records in a transaction ###
            DB::beginTransaction();
            static::updateModuleRecords($records, $form_id);
            DB::commit();

        } catch (ValidationException $e) {
            DB::rollback();
            return static::validationErrorResponse($e->getValidationErrors());
        }
         catch (Exception $e) {
            DB::rollback();
            throw $e;
        }

        // ### Return updated records ###
        return static::successResponse($form_id);
    }

    /**
     * Save module records
     *
     * @param $records
     * @param $form_id
     * @return void
     * @throws FileNotFoundException|ValidationException
     */
    public static function updateModuleRecords($records, $form_id)
    {
        $records_ids = [];

        // ### Update records ###
        foreach ($records as $i => $record) {

            // Ensure empty strings are converted to null
            foreach ($record as $key => $field) {
                if ($field === "") {
                    $record[$key] = null;
                }
            }

            // Validate data
            if(!empty($messages = (new static())::validate($record))){
                throw new ValidationException($messages);
            }

            // Save model
            $record_id = static::save_record($record);

            if ($record_id !== null) {
                $records_ids[] = $record_id;
            }
        }


        // ### Delete all records not in $records_ids[] ###
        $records_ids_to_delete = static::get_records_to_delete($records_ids, $form_id);
        if (!empty($records_ids_to_delete)) {
            static::destroy($records_ids_to_delete);
        }
    }

    /**
     * Save module records data
     *
     * @param $record
     * @return mixed|null
     * @throws FileNotFoundException
     */
    public static function save_record($record)
    {
        // ### get model ###
        $model            = new static();
        $model_primaryKey = $model->primaryKey;
        $form_primary_key = $model::$foreign_key;

        $record_id = $record[$model_primaryKey];
        $isEmpty   = $model->isEmptyRecord($record, $form_primary_key);
        $return    = null;

        // ## Always update for module applied on the main table ##
        if ($model_primaryKey == $form_primary_key && !is_null($record_id)) {
            $item = static::find($record_id);
            $item->update($record);
            $return = $record_id;
        } // ## Delete emptied record ##
        elseif (!is_null($record_id) && $isEmpty) {           //Todo: is_null() or empty() ??
            static::destroy($record_id);
        } // ## Update modified record ##
        elseif (!is_null($record_id) && !$isEmpty) {
            $item = static::find($record_id);
            $item->update($record);
            $return = $record_id;
        } // ## Add new record ##
        elseif (is_null($record_id) && !$isEmpty) {
            unset($record[$model_primaryKey]);
            $item = new static();
            $item->fill($record);
            $item->save();
            $return = $item->getKey();
        }
        return $return;
    }

    /**
     * save() override
     *
     * @param array $options
     * @return bool
     * @throws FileNotFoundException
     */
    public function save(array $options = []): bool
    {
        // Check if any file had been uploaded
        $uploads = $this->parse_uploads();

        // Save all modifications except uploads
        $saved = parent::save($options);

        // Save uploads with dedicated RAW statement
        if ($saved) {
            $this->save_uploads($uploads);
        }

        return $saved;
    }

    /**
     * Delete all records not in $records_ids[]
     *
     * @param $records_ids
     * @param $form_id
     * @param null $additional_condition
     * @return mixed
     */
    protected static function get_records_to_delete($records_ids, $form_id, $additional_condition = null)
    {
        $model            = new static();
        $model_primaryKey = $model->primaryKey;
        $form_primary_key = $model::$foreign_key;

        $query = static::select($model_primaryKey)
            ->where($form_primary_key, $form_id);

        if (!empty($records_ids)) {
            $query = $query->whereNotIn($model_primaryKey, $records_ids);
        }
        if ($additional_condition !== null) {
            if ($additional_condition[1] === 'IN') {
                $query = $query->whereIn($additional_condition[0], $additional_condition[2]);
            } else {
                $query = $query->where($additional_condition[0], $additional_condition[1], $additional_condition[2]);
            }
        }

        return $query->pluck($model_primaryKey)->toArray();
    }

    /**
     * Return successful response after Module update
     *
     * @param $form_id
     * @return array
     */
    protected static function successResponse($form_id): array
    {
        $return_records           = static::getModuleRecords($form_id);
        $return_records['status'] = 'success';
        return $return_records;
    }

    /**
     * Return validation errors response after Module update
     *
     * @param $errors
     * @return array
     */
    public static function validationErrorResponse($errors): array
    {
        return [
            'status' => 'validation_error',
            'errors' => $errors
        ];
    }

    /**
     * Get an empty record
     *
     * @param null $form_id
     * @return array
     */
    public static function getEmptyRecord($form_id = null): array
    {
        $model                              = new static();
        $empty_record                       = array_fill_keys(
            static::getModuleFieldsNames(['KEYS', 'TIMESTAMPS']),
            null
        );
        $empty_record[$model::$foreign_key] = $form_id;

        // Set empty array for checkboxes
        foreach ($empty_record as $key => $field) {
            $type = $model->fieldTypeByName($key);
            if (Str::startsWith($type, 'checkbox-')
                && !Str::contains($type, 'checkbox-boolean')) {
                $empty_record[$key] = [];
            } elseif ($type == 'upload') {
                $empty_record[$key] = static::$upload_object;
            }
        }

        return $empty_record;
    }

    /**
     * Check if the given record is empty (and needs to be deleted)
     *
     * @param $record
     * @param null $foreign_key
     * @return bool
     */
    public function isEmptyRecord($record, $foreign_key = null): bool
    {
        $isEmpty = true;

        foreach (static::getModuleFieldsNames() as $field) {
            if ($field !== $this->primaryKey                                                      // ignore primary_key
                && (($field !== $foreign_key && $foreign_key !== null) || $foreign_key === null)  // ignore foreign_key (form id) if exist
                && $field !== static::$group_key_field                                            // ignore group_key
                && isset($record[$field]) && $record[$field] !== null                             // exist in record & is not null
                && (static::getPredefined($record[$foreign_key])===null ||
                    $field != static::getPredefined($record[$foreign_key])['field'])      // ignore predefined values
                && !(static::fieldTypeByName(
                        $field
                    ) === 'checkbox-boolean' && $record[$field] === false) // ignore false values for checkbox-boolean
            ) {
                $isEmpty = false;
            }
        }

        return $isEmpty;
    }


    /**
     *  Execute module input validation
     *
     * @param $formID
     * @param $step
     * @return array|null
     */
    public static function validateRules($formID, $step = null): ?array
    {
        $errors = null;

        if (!empty($rules = static::$rules)) {

            $collection = static::getModule($formID);
            $record = $collection->isNotEmpty()
                ? $collection->first()->toArray() : [];

            if(!empty($messages = static::validate($record))){
                $errors = [
                    'key' => ModuleKey::ClassNameToKey(static::class),
                    'step' => $step ?? '',
                    'title' => (new static())->module_code!==null
                        ? (new static())->module_code . ' - ' . (new static())->module_title
                        : (new static())->module_title,
                    'messages' => $messages
                ];
            }
        }

        return $errors;
    }

    /**
     * Execute record validation
     *
     * @param $record
     * @return array
     */
    public static function validate($record): array
    {
        $validator = Validator::make($record, static::$rules)
            ->setAttributeNames(
                (new static())->fieldLabels(array_keys(static::$rules))
            );
        return $validator->fails() ? $validator->errors()->messages() : [];
    }
}
