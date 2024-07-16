<?php

namespace App\Repositories;

use App\Models\Warehouse;
use App\Models\WarehouseAddon;
use App\Models\WarehouseVariant;
use Illuminate\Support\Facades\DB;

class WarehouseRepository
{
    protected $warehouse;
    protected $warehouseAddon;
    protected $warehouseVariant;
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->warehouse = new Warehouse();
        $this->warehouseAddon = new WarehouseAddon();
        $this->warehouseVariant = new WarehouseVariant();
    }

    // Find by id
    public function findWarehouseAddonById($id)
    {
        return $this->warehouseAddon->where('id', $id)
            ->where('deleted_at', null)
            ->first();
    }

    // Find by warehouse variant id
    public function findWarehouseVariantByVariantId($variantId)
    {
        return $this->warehouseVariant->where('id', $variantId)
            ->where('status', 1)
            ->first();
    }

    // Get Warehouse with minVariant price
    public function getAll($request, $pagination = 15)
    {
        $search = $request->get('search', '');
        $category_id = $request->get('category', '');
        $check_in_date = $request->get('check_in_date', '');
        $check_out_date = $request->get('check_out_date', '');
        $latitude = $request->get('latitude', '');
        $longitude = $request->get('longitude', '');
        $storage_type = $request->get('storage_type', '');
        $emirate = $request->get('emirate', '');


        $warehouses = $this->warehouse->with(['file'])
            ->active();

        if ($search) {
            $warehouses = $warehouses->where('name', 'LIKE', "%{$search}%");
        }

        if ($category_id) {
            $warehouses = $warehouses->where('category_id', $category_id);
        }

        if ($storage_type) {
            $warehouses = $warehouses->where('storage_type_id', $storage_type);
        }

        if ($emirate) {
            $warehouses = $warehouses->where('emirate_type_id', $emirate);
        }

        if ($latitude && $longitude) {
            $earthRadius = 6371;
            $distanceRange = 50;        // km
            $haversine = "ROUND($earthRadius * acos(cos(radians(" . $latitude . ")) 
            * cos(radians(warehouses.latitude::numeric)) 
            * cos(radians(warehouses.longitude::numeric) - radians(" . $longitude . ")) 
            + sin(radians(" . $latitude . ")) 
            * sin(radians(warehouses.latitude::numeric))))";

            $warehouses = $warehouses
                ->select(
                    "*",
                    DB::raw("$haversine AS distance")
                )

                ->havingRaw("$haversine <= ?", [$distanceRange])
                ->groupBy('warehouses.id');
        }

        return $warehouses
            ->latest()
            ->paginate($pagination);
    }

    public function getById($warehouse_id)
    {
        $lon = request()->session()->get('user_longitude');
        $lat = request()->session()->get('user_latitude');
        $warehouse = $this->warehouse;
        if ($lon && $lat) {
            $earthRadius = 6371;
            $haversine = "ROUND($earthRadius * acos(cos(radians(" . $lat . ")) 
                * cos(radians(warehouses.latitude::numeric)) 
                * cos(radians(warehouses.longitude::numeric) - radians(" . $lon . ")) 
                + sin(radians(" . $lat . ")) 
                * sin(radians(warehouses.latitude::numeric))))";
            $warehouse = $warehouse->select(
                "*",
                DB::raw("$haversine AS distance")
            );
        }
        return $warehouse->with(['files', 'info'])
            ->where('id', $warehouse_id)
            ->active()
            ->first();
    }

    // Get warehouse details with available space
    public function getWarehouseWithSpace($warehouseId, $check_in_date, $check_out_date)
    {
        $warehouse = $this->warehouse->with(['orders' => function ($query) use ($check_in_date, $check_out_date) {
            $query->whereRaw('? BETWEEN check_in_date AND check_out_date', [$check_in_date])
                ->whereRaw('? BETWEEN check_in_date AND check_out_date', [$check_out_date])
                ->whereBetween('status', [0, 1]);
        }])
            ->where('id', $warehouseId)
            ->withSum(['orders as space_occupied' => function ($query) use ($check_in_date, $check_out_date) {
                $query->whereRaw('? BETWEEN check_in_date AND check_out_date', [$check_in_date])
                    ->whereRaw('? BETWEEN check_in_date AND check_out_date', [$check_out_date])
                    ->whereBetween('status', [0, 1]);
            }], 'cargo_total_space_required')
            ->first();

        if ($warehouse) {
            $warehouse->warehouse_space_available = $warehouse->total_space - $warehouse->space_occupied;
        }

        return $warehouse;
    }
}
