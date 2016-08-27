<?php

namespace App\Models\Sms;

use Illuminate\Database\Eloquent\Model;

class SmsSettings extends Model
{
    public $timestamps = false;

    protected $table = 'sms_settings';

    protected $fillable = ['username', 'password', 'sender', 'user_id', 'api_url'];

    protected $guarded = ['id'];

    const KARTPAY_API_URL = 'http://www.sms.kartpay.com/ComposeSMS.aspx?username=%s&password=%s&sender=%s&to=%s&message=%s&priority=1&dnd=1&unicode=0';
}
