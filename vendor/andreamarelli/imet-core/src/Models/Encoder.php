<?php

namespace AndreaMarelli\ImetCore\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Encoder extends Model
{
    public const CREATED_AT = 'UpdateDate';
    public const UPDATED_AT = 'UpdateDate';
    public const UPDATED_BY = null;

    protected $guarded = [];

    protected $table = 'imet.imet_encoders';

    protected $appends = ['name'];

    public function getNameAttribute()
    {
        return $this->attributes['last_name'].' '.$this->attributes['first_name'];
    }

    public static function exportModule($form_id)
    {
        return Encoder::where('FormID', $form_id)
            ->get()
            ->makeHidden(['FormID', 'id'])
            ->map(function ($item){
                $item['UpdateDate'] = Carbon::parse($item['UpdateDate'])->setHour(0)->setMinute(0)->setSecond(0);
                return $item;
            })
            ->toArray();
    }

    public static function importModule($form_id, $encoders = null)
    {
        if($encoders!==null){
            foreach ($encoders as $encoder){
                 // Remove primary key
                unset($encoder['id']);
                // Create model and fill it with data
                $item = new Encoder();
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
    public static function getNames($form_id)
    {
        return array_values(
            Encoder::where('FormID', $form_id)
                ->orderBy('UpdateDate', 'desc')
                ->get()
                ->map->only(['name', 'organisation', 'function'])
                ->unique()
                ->toArray()
        );
    }

}
