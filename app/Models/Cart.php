<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cart extends Model
{
    use HasFactory, HasUuids;
    protected $keyType = 'string';

    public $incrementing = false;

    protected $guarded = [];

    // get formatted checkin attribute using accessor
    public function getCheckinFormattedAttribute()
    {
        return Carbon::parse($this->attributes['checkin'])->format('d-m-Y H:i');
    }

    // get formatted checkout attribute using accessor
    public function getCheckoutFormattedAttribute()
    {
        return Carbon::parse($this->attributes['checkout'])->format('d-m-Y H:i');
    }

    // 
    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    // 
    public function warehouseAddons(): HasMany
    {
        return $this->hasMany(WarehouseAddon::class, 'warehouse_id', 'warehouse_id');
    }

    //  
    public function warehouseVariant(): HasOne
    {
        return $this->hasOne(WarehouseVariant::class, 'id', 'warehouse_variant_id');
    }
}
