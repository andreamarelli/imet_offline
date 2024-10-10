<?php

namespace App\Http\Controllers;

use AndreaMarelli\ImetCore\Controllers\Imet\Controller;
use AndreaMarelli\ModularForms\Controllers\FormController;
use App\Models\User;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class UserController extends FormController
{

    /**
     *
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function confirm_offline_user()
    {
        return view('offline.confirm_user', [
            'item' => Auth::user()
        ]);
    }

    /**
     * Manage "update" OFFLINE user
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update_offline_user(Request $request): RedirectResponse
    {
        $item = (new User)->find(0);
        $item->fill($request->all());
        if ($item->isDirty()) {
            $item->save();
        }
        return redirect()->route('welcome');
    }

}
