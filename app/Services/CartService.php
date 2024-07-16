<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Order;
use App\Repositories\CartRepository;
use App\Repositories\OrderRepository;
use App\Repositories\WarehouseRepository;
use Carbon\Carbon;
use Exception;

class CartService
{
    protected $cartRepository;
    protected $orderRepository;
    protected $warehouseRepository;
    protected $_reqs;
    protected $_mOrder;
    protected $_mCheckout;
    protected bool $_isExist = false;
    public $_cartId;

    /**
     * Create a new class instance.
     */
    public function __construct($req)
    {
        $this->cartRepository = new CartRepository();
        $this->orderRepository = new OrderRepository;
        $this->warehouseRepository = new WarehouseRepository;
        $this->_reqs = $req;
        $this->_mOrder = new Order();
        $this->_mCheckout = new Cart();
    }

    // Main function (1)
    public function main()
    {
        // $this->checkOrderExistance();
        // $this->checkVariantExistance();                     // 1.1
        $this->insertIntoCheckout();                      // 1.2
    }

    // Check the order exist of not 
    protected function checkOrderExistance()
    {
        $orderExistance = $this->orderRepository->findOrderExistanceByCheckIn($this->_reqs->check_in_date, $this->_reqs->check_out_date, $this->_reqs->warehouse_variant_id);
        if (collect($orderExistance)->isNotEmpty()) {
            $this->_isExist = true;
            throw new Exception(__("Warehouse not available for this time slot."));
        }
    }

    // Check the existance of the warehouse variant withing the given time interval
    private function checkVariantExistance()
    {
        $checkout = $this->cartRepository->findCartByVariantId($this->_reqs->warehouse_variant_id);
        if (collect($checkout)->isNotEmpty()) {
            # Create anchor time and another date time to be compared
            $createdTime = Carbon::createFromFormat("Y-m-d H:i:s", $checkout->created_at);
            $currentTime = Carbon::createFromFormat("Y-m-d H:i:s", date("Y-m-d H:i:00"));
            # count difference in minutes
            $minuteDiff = $createdTime->diffInMinutes($currentTime);

            if ($minuteDiff < 15) {         // if the time difference is less than 15 minuts
                $this->_isExist = true;
                throw new Exception(__("Warehouse not available for this time slot."));
            }
            # if the time difference is more than 15 minutes
            if ($minuteDiff > 15) {
                $checkout->delete();
            }
        }
    }

    // insert into Checkouts
    private function insertIntoCheckout()
    {
        if ($this->_isExist == false) {
            $totalDays = calculate_days($this->_reqs->check_in_date, $this->_reqs->check_out_date);
            $warehousePrice = $totalDays * 100;
            $taxesAndFee = 0;           // this will be changed as per the requirement
            $totalPrice = $warehousePrice + $taxesAndFee;

            $reqCheckout = [
                "warehouse_id" => $this->_reqs->warehouse_id,
                "checkin" => $this->_reqs->check_in_date,
                "checkout" => $this->_reqs->check_out_date,
                "user_id" => auth()->user()->id,
                "notes" => $this->_reqs->notes,
                "warehouse_price" => 100,
                "warehouse_addons_price" => 0,
                "no_of_days" => $totalDays,
                "taxes_and_fee" => $taxesAndFee,
                "total_price" => $totalPrice
            ];

            $cart = $this->cartRepository->store($reqCheckout);
            $this->_cartId = $cart->id;
        }
    }
}
