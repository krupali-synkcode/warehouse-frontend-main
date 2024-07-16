<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory, HasUuids;

    const STATUS = [
        'pending' => 0,
        'completed' => 1,
        'failed' => 2,
        'cancelled' => 3,
    ];

    protected $keyType = 'string';

    public $incrementing = false;

    protected $guarded = [];

    public function getCreatedAtDmyAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('d/m/Y');
    }

    // get formatted checkin attribute using accessor
    public function getCheckinFormattedAttribute()
    {
        return Carbon::parse($this->attributes['check_in_date'])->format('d M, Y');
    }

    // get formatted checkin attribute using accessor
    public function getCheckinDmyAttribute()
    {
        return Carbon::parse($this->attributes['check_in_date'])->format('d/m/Y');
    }

    // get formatted checkout attribute using accessor
    public function getCheckoutFormattedAttribute()
    {
        return Carbon::parse($this->attributes['check_out_date'])->format('d M, Y');
    }

    public function getCheckoutDmyAttribute()
    {
        return Carbon::parse($this->attributes['check_out_date'])->format('d/m/Y');
    }

    public function scopeActive($query)
    {
        $query->where('status', 1);
    }

    public function variant(): BelongsTo
    {
        return $this->belongsTo(WarehouseVariant::class, 'warehouse_variant_id', 'id');
    }

    // 
    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    // Geneate Order No
    public static function generateOrderNo(): String
    {
        // Create Order Id
        $mSetting = new Setting();
        $setting = $mSetting::orderBy('created_at')->first();
        $orderNo = $setting->order_prefix . str_pad($setting->order_counter, 7, "0", STR_PAD_LEFT);;
        $setting->order_counter = $setting->order_counter + 1;
        $setting->save();

        return $orderNo;
    }

    public function orderAddons()
    {
        return $this->hasMany(OrderAddon::class, 'order_id');
    }
}
