<?php

namespace AndreaMarelli\ImetCore\Models\Imet\ScalingUp;

use AndreaMarelli\ImetCore\Helpers\Database;
use AndreaMarelli\ImetCore\Models\Imet\Components\BaseModel;


class ScalingUpWdpa extends BaseModel
{

    protected string $schema = Database::IMET_SCHEMA;
    protected $connection = Database::IMET_CONNECTION;
    protected $table = 'scaling_up_wdpas';

    protected $fillable = ['scaling_id', 'FormID', 'name', 'Country', 'wdpa_id', 'color'];
    public $timestamps = false;

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
            $rand_color = "#".substr(md5(rand()), 0, 6);//'rgb(' . rand(30, 220) . ',' . rand(40, 220) . ',' . rand(35, 220) . ')';//str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
            $saved_pas[] = static::create(['scaling_id' => $scaling_id, 'FormID' => $area->FormID, 'name' => $area->name, 'Country' => $area->Country, 'wdpa_id' => $area->wdpa_id, 'color' => $rand_color]);
        }
        return $saved_pas;
    }

    public static function update_item($scaling_id, $form_id, $value, $color)
    {
        $record = static::where(['scaling_id' => $scaling_id, 'FormID' => $form_id])->first();
        if ($record) {
            $record->name = $value;
            $record->color = $color;
            $record->save();
            return json_encode($record);
        }
        return null;
    }

    /**
     * @param int $form_id
     * @param $scaling_id
     * @return array
     */
    public static function getCustomNames(int $form_id, $scaling_id)
    {
        $protected_area = static::getByFormID($scaling_id, $form_id);
        if (($protected_area)) {
            return $protected_area;
        }

        return null;
    }

}
