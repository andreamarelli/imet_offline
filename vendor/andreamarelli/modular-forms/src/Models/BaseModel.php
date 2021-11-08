<?php

namespace AndreaMarelli\ModularForms\Models;

use AndreaMarelli\ModularForms\Models\User\Person;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use ReflectionClass;


/**
 * Class BaseModel
 *
 * @mixin \Illuminate\Database\Eloquent\Model
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @package AndreaMarelli\ModularForms\Models
 */
class BaseModel extends Model
{

    public const CREATED_AT = 'last_update_date';
    public const UPDATED_AT = 'last_update_date';
    public const UPDATED_BY = 'last_update_by';
    public const CREATED_BY = null;

    public const EXPORT = [];
    public const LABEL = null;

    public static $rules = [];
    protected $guarded = [];

    /**
     * Return class short name (trim namespace)
     * @return string
      */
    public static function getShortClassName(): string
    {
        return (new ReflectionClass(static::class))->getShortName();
    }

    /**
     * Return LABEL attribute of the given model
     * @param $id
     * @param null $key
     * @return mixed
     */
    public static function getLabel($id, $key = null) {
        $key = $key!=null ? $key : (new static())->primaryKey;
        $model = static::where($key, $id)->first();
        return $model!==null ? $model->getAttribute( static::LABEL) : null;
    }

    /**
     * Relation
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function update_by_user(): HasOne
    {
        return $this->hasOne(Person::class, (new Person())->getKeyName(), $this::UPDATED_BY);
    }

    /**
     * Relation
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function created_by_user(): ?HasOne
    {
        if(static::CREATED_BY !== null){
            return $this->hasOne(Person::class, (new Person())->getKeyName(), $this::UPDATED_BY);
        }
        return null;
    }

    /**
     * Retrieve an array for selection lists
     *
     * @param String $type  'PAIRS' | 'ONLY_KEYS' | 'ONLY_LABELS' | 'KEYS'
     * @param Collection|null $collection
     * @param array $fields
     * @return array
     */
    public static function selectionList($type = 'PAIRS', Collection $collection = null, $fields = []): array
    {
        $label_attribute = static::LABEL;
        $key_attribute = (new static())->getKeyName();
        $collection = is_null($collection) ? static::all() : $collection;

        $collection = $collection->sortBy($label_attribute, SORT_NATURAL|SORT_FLAG_CASE); // case insensitive
        switch ($type){
            case "PAIRS":
                $collection = $collection->pluck($label_attribute, $key_attribute);
                break;
            case "ONLY_KEYS":
                $collection = $collection->pluck($key_attribute, $key_attribute);
                break;
            case "ONLY_LABELS":
                $collection = $collection->pluck($label_attribute, $label_attribute);
                break;
            case "FIELDS":
                $collection = $collection->pluck($fields[0], $fields[1]);
        }

        return $collection->toArray();
    }

    /**
     * Retrieve an array with the initial letter for the given field
     * @param $field
     * @return mixed
     */
    public static function getInitialLetters($field)
    {
        $initials = self::select(DB::raw('distinct lower(substring("'.$field.'",1,1)) as initial'))
            ->pluck('initial')
            ->toArray();
        sort($initials);
        return $initials;
    }

    /**
     * Scope a query to get by initial letter (on given field)
     *
     * @param $query
     * @param $field
     * @param string $initial_letter
     * @return mixed
     */
    public function scopeWhereStartWith($query, $field, $initial_letter='')
    {
        return $query->whereRaw('substring(lower('.$field.') from 1 for 1) = lower(?) ', [$initial_letter]);
    }

    /**
     * Set tracking info (UPDATED_BY and UPDATED_AT)
     * Override updateTimestamps();
     *
     * @return void
     */
    public function updateTimestamps()
    {
        if($this->isDirty()){
            if(Auth::user() && static::UPDATED_BY !== null){
                $this->{static::UPDATED_BY} = Auth::id();
            }
            if(static::UPDATED_AT !== null){
                $this->{static::UPDATED_AT} = Carbon::now()->format('Y-m-d H:i:s');
            }
        }
        if(static::UPDATED_AT !== null && static::CREATED_AT !== null){
            parent::updateTimestamps();
        }
    }

    /**
     * Retrieve the last update info
     * @return array
     */
    public function getLastUpdate(): array
    {
        $date = $this->{static::UPDATED_AT};
        $user = $this->{static::UPDATED_BY};
        return [
            'date' => $date!==null ? Carbon::parse($date)->toDateTimeString(): null,
            'id' => $user,
            'name' => $user!==null ? Person::find($this->{static::UPDATED_BY})->Name : null
        ];
    }

    /**
     * Return a Collection of arrays with the attributes to be exported
     * @param null $collection
     * @return \Illuminate\Support\Collection|static
     */
    public static function exportCollection($collection = null)
    {
        if($collection === null){
            $collection = static::all();
        }
        if(!$collection instanceof Collection){
            $collection = collect([$collection]);
        }
        $export_attributes = static::EXPORT;
        return $collection->map(function ($item) use ($export_attributes) {
            $item = $item->toArray();
            $item = array_map(function($attr){
                if(gettype($attr) === "array"){
                    $attr = implode(',', $attr);
                }
                return $attr;
            }, $item);
            return collect($item)
                ->only($export_attributes)
                ->all();
        });
    }

    /**
     * retrieve multiple records array by their id
     * @param array $ids
     * @param array $columns
     * @param string $whereId
     * @return array
     */
    public static function getRecordsArrayByFieldIds(array $ids, array $columns = ['*'], string $whereId = 'id') : array
    {
        return static::getRecordsByFieldIds($ids, $columns, $whereId)
            ->get()
            ->toArray();
    }

    /**
     * retrieve multiple records
     *
     * @param array $ids
     * @param array $columns
     * @param string $whereId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function getRecordsByFieldIds(array $ids, array $columns = ['*'], string $whereId = 'id') : \Illuminate\Database\Eloquent\Builder
    {
        return static::select($columns)
            ->distinct()
            ->whereIn($whereId, $ids);
    }

}
