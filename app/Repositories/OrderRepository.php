<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderAddon;

class OrderRepository
{
    protected $order;

    protected $orderAddon;

    public function __construct()
    {
        $this->order = new Order();
        $this->orderAddon = new OrderAddon();
    }

    public function getAll($request, $user_id)
    {
        $status = $request->get('filter');
        $order = $this->order::with(['warehouse'])->where('user_id', $user_id);

        if (isset($status) && $status == 1) {                // Confirmed 
            $order = $order->where('status', $this->order::STATUS['completed']);
        }

        if (isset($status) && $status == 2) {                // Processing
            $order = $order->where('status', $this->order::STATUS['pending']);
        }

        if (isset($status) && $status == 3) {                // Cancelled
            $order = $order->where('status', $this->order::STATUS['cancelled']);
        }

        return $order
            ->latest()
            ->paginate(10);
    }

    public function getByUserId($order_id, $user_id)
    {
        return $this->order->with(['warehouse', 'orderAddons.warehouseAddon:id,service_name'])
            ->where('id', $order_id)
            ->where('user_id', $user_id)
            ->first();
    }

    public function store($data)
    {
        return $this->order->create($data);
    }

    public function storeOrderAddon($data)
    {
        return $this->orderAddon->create($data);
    }

    public function update($id, $data)
    {
        return $this->order->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->order->where('id', $id)->delete();
    }

    // Find order existance by date
    public function findOrderExistanceByCheckIn($checkIn, $checkOut, $variantId)
    {
        return $this->order->where('check_in_date', '<=', $checkOut)
            ->where('check_out_date', '>=', $checkIn)
            ->where('warehouse_variant_id', $variantId)
            ->where('is_checked_out', false)
            ->active()
            ->first();
    }
}
