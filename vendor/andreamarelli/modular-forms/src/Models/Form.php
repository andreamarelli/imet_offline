<?php

namespace AndreaMarelli\ModularForms\Models;

use AndreaMarelli\ModularForms\Helpers\ModuleKey;
use AndreaMarelli\ModularForms\Models\Traits\Payload;
use AndreaMarelli\ModularForms\Models\Traits\Sortable;
use Exception;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Form extends BaseModel
{
    use Sortable;

    public static $modules = null;

    public const ENCODE_PROGRESS = null;
    public const VALID = null;

    /**
     * Return the models' array
     */
    public static function modules(): array
    {
        return static::$modules;
    }

    public static function modulesByStep($step = null): array
    {
        $modules = static::modules();
        if(array_is_list($modules)){
            return $modules;    // there are no steps: ignore $step and return all modules
        } elseif(array_key_exists($step, $modules)){
            return $modules[$step];
        }
        return [];
    }

    /**
     * Flatten modules into a plain array
     * @return array
     */
    protected static function allModules(): array
    {
        $modules = static::modules();
        $all_modules = [];
        foreach ($modules as $step) {
            if (gettype($step) === 'string') { // no steps
                $all_modules[] = $step;
            } else {
                foreach ($step as $module) {
                    $all_modules[] = $module;
                }
            }
        }
        return array_unique($all_modules);
    }

    /**
     * Default method for getting form list
     *
     * @param Builder $query
     * @param Request $request
     * @return Builder
     */
    public function scopeFilterList(Builder $query, Request $request): Builder
    {
        return $query;
    }

    /**
     * @param $item
     * @param Request $request
     * @return array
     * @throws Exception
     */
    public static function updateModuleAndForm($item, Request $request): array
    {
        /** @var Module $module_class */

        // update Module
        $module_class = ModuleKey::KeyToClassName($request->input('module_key'));
        $return = $module_class::updateModule($request);

        // update Form
        $form = new static();
        $form = $form->find($item);
        $form->updateProgress();
        $form->touch(); // force timestamp update

        $return['form_errors'] = $form->validateFormRules();

        return $return;
    }

    /**
     * Administration: update form's module
     *
     * @param Request $request
     * @return array
     * @throws Exception
     */
    public function update_form(Request $request): array
    {
        /** @var Module $module_class */

        $module_key = $request->input('module_key');
        $module_class = ModuleKey::KeyToClassName($module_key);
        return $module_class::updateModule($request);
    }


    /**
     * Administration: create new form
     * @throws Exception
     */
    public function store(Request $request): array
    {
        /** @var Module $module_class */

        $records = Payload::decode($request->input('records_json'));
        $module_key = $request->input('module_key');
        $module_class = ModuleKey::KeyToClassName($module_key);

        // Validate data
        if(!empty($messages = $module_class::validate($records[0]))){
            return $module_class::validationErrorResponse($messages);
        }

        DB::beginTransaction();

        // Save new form
        if (static::CREATED_BY !== null) {
            $this->{static::CREATED_BY} = Auth::id();
        }
        $this->save();

        // Inject form_id into request
        $records[0][$this->getKeyName()] = $this->getKey();
        $request->replace(['records_json' => Payload::encode($records)]);

        // Update module
        $result = $module_class::updateModule($request);

        DB::commit();

        if ($result['status'] === 'success') {
            $result['entity_id'] = $this->getKey();
            $result['entity_label'] = null;
        }

        return $result;
    }

    /**
     * Administration: destroy (also delete the module's related records)
     * @throws Exception
     */
    public function delete(): void
    {
        foreach (static::allModules() as $module_class) {
            $module_class
                ::where($module_class::$foreign_key, $this->getKey())
                ->delete();
        }
        parent::delete();
    }

    /**
     * Export all modules data into array
     */
    public static function exportModules($form_id, $exclude_attachments = false): array
    {
        $array = [];
        foreach (static::allModules() as $module_class) {
            $array[$module_class::getShortClassName()] = $module_class::exportModule($form_id, $exclude_attachments);
        }
        return $array;
    }

    /**
     * Import all modules from records array
     * @throws FileNotFoundException
     */
    public static function importModules($records, $formID): array
    {
        $modules_imported = [];
        /** @var Module $module_class */
        foreach (static::allModules() as $module_class) {
            if (array_key_exists($module_class::getShortClassName(), $records)) {
                $modules_imported[] = $module_class::getShortClassName();
                foreach ($records[$module_class::getShortClassName()] as $record) {
                    $module_class::importModule($formID, $record);
                }
            }
        }
        return $modules_imported;
    }

    /**
     * ????
     */
    public function __call($method, $parameters)
    {
        $allModules = static::allModules();
        if (in_array($method, $allModules)) {
            $module_class = new $method();
            if ($module_class->getTable() === $this->getTable()) {
                return $this->hasOne($method, $this->primaryKey, $this->primaryKey);
            } else {
                return $this->hasMany($method, $this->primaryKey);
            }
        }
        return parent::__call($method, $parameters);
    }

    /**
     * Update the "ENCODE_PROGRESS" status
     */
    public function updateProgress(): void
    {
        if ($this::ENCODE_PROGRESS !== null) {
            $allModules = static::allModules();
            $num_modules = count($allModules);
            $num_encoded = 0;
            foreach ($allModules as $module_class) {
                $hasRecord = $module_class::hasRecord($this->getKey());
                $num_encoded = $hasRecord ? $num_encoded + 1 : $num_encoded;
            }
            $this->{$this::ENCODE_PROGRESS} = intval(100 / $num_modules * $num_encoded);
        }
    }

    /**
     * Pass through each form's module and validate records according to defined rules
     * @param null $modules
     * @return array, array of errors
     */
    public function validateFormRules($modules = null): array
    {
        $modules = $modules ?? static::allModules();
        $formID = $this->{$this->primaryKey};
        $errors = [];
        if ($formID != null) {
            foreach ($modules as $current_step => $moduleClass) {
                $tmp = $moduleClass::validateRules($formID, $current_step);
                if ($tmp) $errors[] = $tmp;
            }
        }
        return $errors;
    }

}
