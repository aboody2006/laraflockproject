<?php

namespace App\Http\Controllers\Sms;

use App\Http\Controllers\BaseDashboardController;
use App\Models\Sms\Sms;
use Laracasts\Flash\Flash;

class SmsSentController extends BaseDashboardController
{
    public function index()
    {
        $sentSms = Sms::all();

        return view('dashboard.sms.sent.index', ['sentSms' => $sentSms]);
    }

    public function deleteSms($smsId)
    {
        if (!$sms = Sms::find($smsId))
        {
            Flash::error('SMS not found');

            return redirect()->route('sms.sent.index');
        }

        $sms->delete();

        Flash::success('SMS to#' . $sms->recipient_number . ' and "' . $sms->message . '" message was deleted');

        return redirect()->route('sms.sent.index');
    }

    public function showSms($smsId)
    {
        if (!$sms = Sms::find($smsId))
        {
            Flash::error('SMS not found');

            return redirect()->route('sms.sent.index');
        }

        return view('dashboard.sms.sent.show', ['sms' => $sms]);
    }
}