<?php

namespace AndreaMarelli\ImetCore\Controllers\Imet;

use AndreaMarelli\ImetCore\Controllers\__Controller;
use AndreaMarelli\ImetCore\Models\Imet\ScalingUp\Basket as BasketModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ScalingUpBasketController extends __Controller
{
    public function save(Request $request)
    {
        return BasketModel::save_item($request->value);
    }

    public function delete($id)
    {
        $item = BasketModel::find($id);
        if ($item) {
            $disk = Storage::disk(BasketModel::$UPLOAD_DISK);
            $disk->delete($item->item);
            return BasketModel::destroy($item->id);
        }

        return false;
    }

    public function retrieve(Request $request)
    {
        $item = BasketModel::find($request->id);
        return json_encode($item);
    }

    public function all(Request $request)
    {
        $id = $request->input('id');

        $items = BasketModel::retrieve_by_scaling_id($id);
        return json_encode($items);
    }

    public function clear(Request $request)
    {
        $id = $request->input('id');

        $records = BasketModel::where('scaling_up_id', $id)->get();

        foreach ($records as $e) {

            if (!static::delete($e->id)) {
                return false;
            }
        }

        return true;
    }

}
