<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['code', 'title'];

    public function section()
    {
        return $this->belongsTo('App\Models\Section');
    }

    public function weight()
    {
        return $this->hasOne('App\Models\Weight');
    }

    public function characteristic()
    {
        return $this->hasOne('App\Models\Characteristic');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany('App\Models\Transactions\Order', 'products_code_id', 'id');
    }
}
