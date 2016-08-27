<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $timestamps = false;

    protected $table = 'customers';

    protected $fillable = ['company'];

    protected $guarded = ['id'];

    public function order()
    {
        return $this->hasMany('App\Models\Transactions\Order', 'customer_id', 'id');
    }
}
