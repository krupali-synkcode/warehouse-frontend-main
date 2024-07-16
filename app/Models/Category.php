<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];

    // 
    public function categoryIcon(): BelongsTo
    {
        return $this->belongsTo(File::class, 'icon_id');
    }
}
