<?php

namespace App\Http\Controllers;

use AndreaMarelli\ModularForms\Models\Traits\Payload;
use App\Models\Settings;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;


class SettingsController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index(): View
    {
        return view('offline.settings', [
            'vueData' => [
                'records' => Settings::get(),
                'save_url' => route('settings_update'),
            ]
        ]);
    }

    public function update(Request $request): array
    {
        $records = Payload::decode($request->input('records_json'));
        $module_key = $request->input('module_key');

        if($module_key === 'proxy'){
            Settings::updateSettings($records);
        }

        return [
            'records' => $records,
            'status' => 'success',
        ];
    }

}
