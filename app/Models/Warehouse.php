<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Warehouse extends Model
{
    use HasFactory, HasUuids;

    protected $keyType = 'string';

    public $incrementing = false;

    protected $guarded = [];

    public function scopeActive($query)
    {
        $query->where('status', 1);
    }

    // 
    public function orders(): hasMany
    {
        return $this->hasMany(Order::class);
    }

    public function files()
    {
        return $this->belongsToMany(File::class, 'warehouse_has_files', 'warehouse_id', 'file_id');
    }

    public function file(): HasOne
    {
        return $this->hasOne(WarehouseHasFile::class, 'file_id', 'warehouse_id');
    }

    public function info()
    {
        return $this->hasMany(WarehouseInfo::class, 'warehouse_id');
    }

    public function storageType(): BelongsTo
    {
        return $this->belongsTo(StorageType::class);
    }

    public function emirateType(): BelongsTo
    {
        return $this->belongsTo(Emirate::class, 'emirate_type_id', 'id');
    }
}
