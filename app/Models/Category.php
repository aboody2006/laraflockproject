<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;

    protected $fillable = ['title'];

    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}
