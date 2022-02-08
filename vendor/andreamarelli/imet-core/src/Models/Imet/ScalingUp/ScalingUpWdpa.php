<?php

namespace AndreaMarelli\ImetCore\Models\Imet\ScalingUp;

use Illuminate\Database\Eloquent\Model;


class ScalingUpWdpa extends Model
{
    public $timestamps = false;
    protected $table = 'imet.scaling_up_wdpas';
    protected $fillable = ['scaling_id', 'FormID', 'name', 'Country', 'wdpa_id', 'color'];

    public static function retrieve_by_scaling_id($id)
    {
        return static::where('scaling_id', $id)->orderBy('name', 'asc')->get();
    }

    public static function getByFormID($scaling_id, $id)
    {
        return static::where(['scaling_id' => $scaling_id, 'FormID' => $id])->first();
    }

    public static function save_item($item)
    {
        $record = static::create(['scaling_id' => $item['scaling_id']]);
        $record->FormID = $item['wdpa_id'];
        $record->name = $item['name'];
        $record->save();
        return json_encode($record);
    }

    public static function save_pas($scaling_id, $areas)
    {
        $saved_pas = [];
        foreach ($areas as $k => $area) {
            $rand = str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
            $rand_color = '#' . $rand;
            $saved_pas[] = static::create(['scaling_id' => $scaling_id, 'FormID' => $area->FormID, 'name' => $area->name, 'Country' => $area->Country, 'wdpa_id' => $area->wdpa_id, 'color' => $rand_color]);
        }
        return $saved_pas;
    }

    public static function update_item($scaling_id, $form_id, $value)
    {
        $record = static::where(['scaling_id' => $scaling_id, 'FormID' => (int)$form_id])->first();
        $record->name = $value;
        $record->save();
        return json_encode($record);
    }
}
