<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Model;

class PackingSlip extends Model
{
    public $timestamps = false;

    protected $table = 'packing_slips';

    protected $fillable = [''];

    protected $guarded = ['id'];
}
