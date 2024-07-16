<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class WarehouseInfo extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'warehouse_info';

    protected $primaryKey = 'id';

    protected $guarded = ['id'];
}
