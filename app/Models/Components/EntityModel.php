<?php

namespace App\Models\Components;

use App;
use Config;
use Carbon\Carbon;
use App\Models\Person\Person;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


define('UPPER_LOCALE', mb_strtoupper(App::getLocale() ?? Config::get('app.locale')));
define('LOWER_LOCALE', mb_strtolower(App::getLocale() ?? Config::get('app.locale')));

/**
 * @mixin \Eloquent
 */
class EntityModel extends Model
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
    public static function getShortClassName()
    {
        return (new \ReflectionClass(static::class))->getShortName();
    }

    /**
     * @param $id
     * @param null $key
     * @return mixed
     */
    public static function getLabel($id, $key = null) {
        $key = $key!=null ? $key : (new static())->primaryKey;
        $model = static::where($key, $id)->first();
        return $model->getAttribute( static::LABEL) ?? null;
    }

    public function update_by_user()
    {
        return $this->hasOne(Person::class, (new Person())->getKeyName(), $this::UPDATED_BY);
    }
    public function created_by_user()
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
    public static function selectionList($type = 'PAIRS', Collection $collection = null, $fields = [])
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
        $initials = self::select(DB::raw('distinct lower(substring("'.$field.'",1,1)) as initial'))->pluck('initial')->toArray();
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
            if(\Auth::user() && static::UPDATED_BY !== null){
                $this->{static::UPDATED_BY} =  \Auth::user()->getKey();
            }
            if(static::UPDATED_AT !== null){
                $this->{static::UPDATED_AT} =  Carbon::now()->format('Y-m-d H:i:s');
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
    public function getLastUpdate()
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

}