<?php

namespace App\Http\Controllers\Components;

use Carbon\Carbon;

trait Publish
{
    /**
     * Set the "published" attributes
     * @param $item
     * @return \Illuminate\Http\RedirectResponse
     */
    public function set_publish($item)
    {
        $form = new static::$form_class();
        $form = $form->find($item);
        $form->timestamps = false;
        // Publish
        if($form->published === null || !$form->published ){
            $form->published = true;
            $form->published_by = \Auth::user()->getKey();
            $form->publication_date = Carbon::now()->format('Y-m-d H:i:s');
        }
        // Un-publish
        else {
            $form->published = false;
            $form->published_by = null;
            $form->publication_date = null;
        }
        $form->save();
        return redirect()->action([static::class, 'index']);
    }
}