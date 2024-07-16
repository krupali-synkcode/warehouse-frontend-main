<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emirate extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;

    protected $guarded = [];

    public function scopeActive($query)
    {
        $query->where('status', 1);
    }
}
