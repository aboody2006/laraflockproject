<?php

namespace App\Http\Controllers\Sms;

use AdamWathan\Form\Elements\Date;
use App\Models\Sms\SmsTemplates;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Http\Controllers\BaseDashboardController;
use App\Models\Sms\Sms;
use App\Models\Sms\SmsSettings;

class SmsController extends BaseDashboardController
{
    public function index()
    {
        $sentSms = Sms::all();

        return view('dashboard.sms.sent.index', ['sentSms' => $sentSms]);
    }

    public function createSms()
    {
        $templates = SmsTemplates::all();

        return view('dashboard.sms.send.index', ['templates' => $templates]);
    }

    public function sendSms(Request $request)
    {
        $this->validate($request, [
            'message' => 'required',
            'recipient_number' => 'required|max:10',
        ]);

        $request['message'] = trim($request['message']);
        $request['recipient_number'] = trim($request['recipient_number']);

        $sms = new Sms();
        $sms->fill($request->all());
        $sms->user_id = $request->user()->id;
        $sms->sent_date = date('d/m/Y g.i A');

        if ($this->sendRequestToCartpayApi($sms, $request->user()->id))
        {
            $sms->save();

            Flash::success('SMS to#' . $sms->recipient_number . ' with "' . $sms->message . '" message was sent');

            return redirect()->route('sms.sent.index');
        }
        else
        {
            Flash::warning('Service is not available');

            return redirect()->route('sms.send.index');
        }
    }

    private function sendRequestToCartpayApi($sms, $userId)
    {
        $setting = SmsSettings::where(['user_id' => $userId])->first();
        $message = str_replace(' ', '%20', $sms->message);
        $apiUrl = sprintf($setting->api_url, $setting->username, $setting->password, $setting->sender, $sms->recipient_number, $message);

        $result = $this->curlRequestToApi($apiUrl);

        if ($result == 'Sent.')
        {
            return true;
        }

        return false;
    }

    private function curlRequestToApi($apiUrl)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}