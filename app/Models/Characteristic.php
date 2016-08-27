<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Characteristic extends Model
{
    public $timestamps = false;

    protected $fillable = ['length'];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
