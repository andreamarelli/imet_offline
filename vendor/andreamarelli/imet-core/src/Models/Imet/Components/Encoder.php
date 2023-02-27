<?php

namespace AndreaMarelli\ImetCore\Models\Imet\Components;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

abstract class Encoder extends Model
{
    public const CREATED_AT = 'UpdateDate';
    public const UPDATED_AT = 'UpdateDate';
    public const UPDATED_BY = null;

    protected $guarded = [];

    protected $table = null;

    protected $appends = ['name'];

    /**
     * Accessor to full name
     * @return string
     */
    public function getNameAttribute(): string {
        return $this->attributes['last_name'].' '.$this->attributes['first_name'];
    }

    public static function touchOnFormUpdate($formId, $user_info)
    {
        // Insert encoder (if not present in the day)
        $encoder = static::where('first_name', $user_info['first_name'])
            ->where('last_name', $user_info['last_name'])
            ->where('FormID', $formId)
            ->whereDate(static::UPDATED_AT, Carbon::today())
            ->first();
        if($encoder){
            $encoder->touch();
        } else {
            static::create(array_merge(
                $user_info,
                [
                    'FormID' => $formId
                ]
            ));
        }
    }

    /**
     * Export model
     *
     * @param $form_id
     * @return mixed
     */
    public static function exportModule($form_id)
    {
        return static::where('FormID', $form_id)
            ->get()
            ->makeHidden(['FormID', 'id'])
            ->map(function ($item){
                $item['UpdateDate'] = Carbon::parse($item['UpdateDate'])->setHour(0)->setMinute(0)->setSecond(0);
                return $item;
            })
            ->toArray();
    }

    /**
     * Import model
     *
     * @param $form_id
     * @param $encoders
     * @return void
     */
    public static function importModule($form_id, $encoders = null)
    {
        if($encoders!==null){
            foreach ($encoders as $encoder){
                // Remove primary key
                unset($encoder['id']);
                // Create model and fill it with data
                $item = new static();
                $item->fill($encoder);
                $item['FormID'] = $form_id;
                unset($item['name']);
                $item->save();
            }
        }
    }

    /**
     * Retrieve the form encoders' list
     *
     * @param $form_id
     * @return array
     */
    public static function getNames($form_id): array {
        return array_values(
            static::where('FormID', $form_id)
                ->orderBy('UpdateDate', 'desc')
                ->get()
                ->map->only(['name', 'organisation', 'function'])
                ->unique()
                ->toArray()
        );
    }

}
