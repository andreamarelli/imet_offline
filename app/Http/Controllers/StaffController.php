<?php

namespace App\Http\Controllers;

use AndreaMarelli\ImetCore\Controllers\Imet\Controller;
use AndreaMarelli\ImetCore\Models\UserGeneralInfo;
use AndreaMarelli\ModularForms\Controllers\StaffController as BaseStaffController;
use AndreaMarelli\ImetCore\Models\Person;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class StaffController extends BaseStaffController
{

    public function confirm_offline_user()
    {
        return view('offline.confirm_user', [
            'item' => Person::find(0),
            'fields' => UserGeneralInfo::getDefinitions()['fields']
        ]);
    }

    /**
     * Manage "update" OFFLINE user
     *
     * @param Person $item
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update_offline(Person $item, Request $request): RedirectResponse
    {
        $item->fill($request->all());
        if ($item->isDirty()) {
            $item->save();
        }
        return redirect()->action([Controller::class, 'index']);
    }

}
