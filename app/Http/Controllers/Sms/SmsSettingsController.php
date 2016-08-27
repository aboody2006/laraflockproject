<?php

namespace App\Http\Controllers\Sms;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Models\Sms\SmsSettings;
use App\Http\Controllers\BaseDashboardController;

class SmsSettingsController extends BaseDashboardController
{
    public function index(Request $request)
    {
        $user = $request->user()->id;
        $settings = SmsSettings::where(['user_id' => $user])->get();

        if (count($settings) < 1)
        {
            Flash::warning('Settings not found. Please, add new setting');

            return redirect()->route('sms.settings.create');
        }

        return view('dashboard.sms.settings.index', ['settings' => $settings]);
    }

    public function createSetting()
    {
        return view('dashboard.sms.settings.create');
    }

    public function saveSetting(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
            'sender' => 'required'
        ]);

        $request['username'] = trim($request['username']);
        $request['password'] = trim($request['password']);
        $request['sender'] = trim($request['sender']);

        $setting = new SmsSettings();
        $setting->fill($request->all());
        $setting->user_id = $request->user()->id;
        $setting->api_url = SmsSettings::KARTPAY_API_URL;
        $setting->save();

        Flash::success('New SMS setting with username "' . $setting->username . '" was added');

        return redirect()->route('sms.settings.index');
    }

    public function deleteSetting($settingId)
    {
        if (!$setting = SmsSettings::find($settingId))
        {
            Flash::error('SMS Setting not found');

            return redirect()->route('sms.settings.index');
        }

        $setting->delete();

        Flash::success('SMS Setting with username "' . $setting->username . '" was deleted');

        return redirect()->route('sms.settings.index');
    }

    public function showSetting($settingId)
    {
        if (!$setting = SmsSettings::find($settingId))
        {
            Flash::error('SMS Setting not found');

            return redirect()->route('sms.settings.index');
        }

        return view('dashboard.sms.settings.show', ['setting' => $setting]);
    }

    public function editSetting($settingId)
    {
        if (!$setting = SmsSettings::find($settingId))
        {
            Flash::error('SMS Setting not found');

            return redirect()->route('sms.settings.index');
        }

        return view('dashboard.sms.settings.edit', ['setting' => $setting]);
    }

    public function updateSetting(Request $request, $settingId)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
            'sender'   => 'required'
        ]);

        if (!$setting = SmsSettings::find($settingId))
        {
            Flash::error('SMS Setting not found');

            return redirect()->route('sms.settings.index');
        }

        $request['username'] = trim($request['username']);
        $request['password'] = trim($request['password']);
        $request['sender']   = trim($request['sender']);

        $setting->fill($request->all());
        $setting->save();

        Flash::success('SMS Setting "' . $setting->username . '" was updated');

        return redirect()->route('sms.settings.index');
    }
}
