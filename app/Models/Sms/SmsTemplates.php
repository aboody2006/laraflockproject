<?php

namespace App\Models\Sms;

use Illuminate\Database\Eloquent\Model;

class SmsTemplates extends Model
{
    public $timestamps = false;

    protected $table = 'sms_templates';

    protected $fillable = ['message'];

    protected $guarded = ['id'];
}
