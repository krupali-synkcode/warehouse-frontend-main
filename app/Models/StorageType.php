<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StorageType extends Model
{
    use HasFactory, HasUuids;
    protected $keyType = 'string';

    public $incrementing = false;

    protected $guarded = [];

    public function scopeActive($query)
    {
        $query->where('status', 1);
    }
}
