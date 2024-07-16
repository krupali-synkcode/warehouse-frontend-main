<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class File extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];

    // 
    public function icon(): HasOne
    {
        return $this->hasOne(Category::class, 'icon_id');
    }
}
