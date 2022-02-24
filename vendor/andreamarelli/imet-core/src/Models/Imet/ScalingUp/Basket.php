<?php

namespace AndreaMarelli\ImetCore\Models\Imet\ScalingUp;

use AndreaMarelli\ModularForms\Helpers\File\File;
use AndreaMarelli\ImetCore\Models\Imet\ScalingUp\Basket as BasketModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class Basket extends Model
{
    public const BASKET_DISK = 'public_folder';
    public const BASKET_FOLDER = 'basket/';

    public $timestamps = false;
    protected $table = 'imet.scaling_up_basket';
    protected $fillable = ['item', 'order', 'comment', 'scaling_up_id'];

    public static function retrieve_by_scaling_id($id)
    {
        return static::where('scaling_up_id', $id)->orderBy('id','asc')->get();
    }

    public static function save_item($item)
    {

        $image = str_replace('data:image/png;base64,', '', $item['image_src']);
        $image = str_replace(' ', '+', $image);

        $record = BasketModel::create(["order" => 1, 'scaling_up_id' => $item['scaling_up_id']]);
        $imageName = $record->id . '.png';

        $disk = Storage::disk(self::BASKET_DISK);
        $image_path = self::BASKET_FOLDER . $imageName;
        if ($disk->put($image_path, base64_decode($image))) {
            $record->item = $image_path;// BasketModel::create(["item" => $imageName, "order" => 1]);
            $record->comment = $item['comment'];
            $record->save();
            return json_encode($record);
        }
        //$path = $disk->url($image_path);

        return null;
    }
}
