<?php

namespace App\Models\Sms;

use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    public $timestamps = false;

    protected $table = 'sms';

    protected $fillable = ['message', 'recipient_number', 'user_id', 'sent_date'];

    protected $guarded = ['id'];
}
