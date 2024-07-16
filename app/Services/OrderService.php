<?php

namespace App\Services;

use App\Repositories\CartRepository;
use App\Repositories\OrderRepository;
use App\Repositories\WarehouseRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderService extends CartService
{
    protected $orderRepository;
    protected $cartRepostory;
    protected $warehouseRepository;
    private $_createdOrder;
    private $_checkout;
    private $_reqs;
    private $_checkoutAddons;

    /**
     * Create a new class instance.
     */
    public function __construct($req)
    {
        $this->_reqs = $req;
        $this->orderRepository = new OrderRepository();
        $this->cartRepository = new CartRepository;
        $this->warehouseRepository = new WarehouseRepository;
        $this->readCheckout();
        parent::__construct($req);
    }

    private function readCheckout()
    {
        $this->_checkout = $this->cartRepository->findCartByVariantId($this->_reqs->warehouse_variant_id);
        if (collect($this->_checkout)->isEmpty()) {
            throw new Exception(__("Cart not found."));
        }

        $this->_checkoutAddons = $this->cartRepository->findCartAddonByCheckoutId($this->_checkout->id);

        $this->_reqs->merge([
            "warehouse_variant_id" => $this->_checkout->warehouse_variant_id,
            "check_in" => $this->_checkout->checkin,
            "check_out" => $this->_checkout->checkout,
        ]);
    }

    // Main function (1)
    public function main()
    {
        $this->checkOrderExistance();
        $this->processInsertOrder();
        $this->insertOrderAddons();
        $this->checkCheckoutExistance();
    }

    // Insert into orders
    private function processInsertOrder()
    {
        $warehouseVariant = $this->warehouseRepository->findWarehouseVariantByVariantId($this->_reqs->warehouse_variant_id);
        if (collect($warehouseVariant)->isEmpty()) {
            throw new Exception(__("Warehouse not available the selected variant."));
        }

        $startDate = Carbon::createFromFormat("Y-m-d", $this->_reqs->check_in);
        $endDate = Carbon::createFromFormat("Y-m-d", $this->_reqs->check_out);
        $diffInDays = $startDate->diffInDays($endDate);
        $totalAmount = $warehouseVariant->price * $diffInDays;

        $orderReqs = [
            "user_id" => auth()->user()->id ?? '9c263016-a4f6-4f38-a788-c1383b566bb4',
            "warehouse_variant_id" => $this->_reqs->warehouse_variant_id,
            "start_date" => $this->_reqs->check_in,
            "end_date" => $this->_reqs->check_out,
            "per_day_charge" => $warehouseVariant->price,
            "total_amount" => $totalAmount,
            "paid_amount" => $totalAmount,
            "notes" => $this->_reqs->notes
        ];

        $this->_createdOrder = $this->_mOrder->create($orderReqs);
    }

    // Insert into order addons
    private function insertOrderAddons()
    {
        $addonsPrice = collect();
        foreach ($this->_checkoutAddons as $addon) {
            $warehouseAddon = $this->warehouseRepository->findWarehouseAddonById($addon->id);
            if (collect($warehouseAddon)->isEmpty()) {
                throw new Exception(__("Warehouse service not available."));
            }

            $addonsPrice->push($warehouseAddon->price);

            $checkoutAddonReqs = [
                "order_id" => $this->_createdOrder->id,
                "addon_id" => $warehouseAddon->id,
                "addon_price" => $warehouseAddon->price
            ];

            $this->orderRepository->storeOrderAddon($checkoutAddonReqs);
        }
        $totalAddonsPrice = $addonsPrice->sum();
        // Update total on orders
        $this->_createdOrder->update([
            'addon_charges' => $totalAddonsPrice,
            'paid_amount' => $this->_createdOrder->paid_amount + $totalAddonsPrice
        ]);
    }

    // Check checkout existance
    private function checkCheckoutExistance()
    {
        if (collect($this->_checkout)->isNotEmpty()) {
            $this->_checkout->delete();
            foreach ($this->_checkoutAddons as $checkoutAddon) {
                $checkoutAddon->delete();
            }
        }
    }
}
