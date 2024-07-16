<?php

namespace App\Services;

use App\Repositories\CartRepository;
use App\Repositories\WarehouseRepository;
use Exception;

class AddRemoveCartAddons
{
    private $checkoutRepository;
    private $warehouseRepository;
    private $request;
    private $cart;
    private $warehouseAddon;
    /**
     * Create a new class instance.
     */
    public function __construct($request)
    {
        $this->checkoutRepository = new CartRepository;
        $this->warehouseRepository = new WarehouseRepository;
        $this->request = $request;
    }

    // 
    public function main()
    {
        // Read parameters
        $this->readParameters();

        // Add Addons if action is for add addon
        $this->addAddons();

        // Delete Addons if action is for remove addon
        $this->deleteAddon();

        // Re calculate cart total
        $this->calculateCartTotal($this->cart);
    }

    // Read all the varibles and related table parameters
    private function readParameters()
    {
        $user = auth()->user();
        $this->cart = $this->checkoutRepository->getByUserAndCartId($user->id, $this->request->cart_id);

        if (empty($this->cart)) {
            throw new Exception(__('Cart data not found. Please try again.'));
        }
        // Insert into checkout addon
        $this->warehouseAddon = $this->warehouseRepository->findWarehouseAddonById($this->request->addon_id);

        if (collect($this->warehouseAddon)->isEmpty()) {
            throw new Exception(__('Addon not available.'));
        }
    }

    /**
     * | Add addons to cart
     */
    private function addAddons()
    {
        if ($this->request->action == 'add') {
            // Check if already existing or not 
            $isExisting = $this->checkoutRepository->getCartAddonByAddonCartId($this->request->cart_id, $this->warehouseAddon->id);
            if (collect($isExisting)->isNotEmpty()) {
                throw new Exception(__('The service is already existing in your cart, Please select another.'));
            }

            $checkoutAddonData = [
                "cart_id" => $this->request->cart_id,
                "addon_id" => $this->warehouseAddon->id,
                "addon_price" => $this->warehouseAddon->price
            ];

            $this->checkoutRepository->storeAddon($checkoutAddonData);
        }
    }

    /**
     * | remove addon from cart
     */
    private function deleteAddon()
    {
        if ($this->request->action == 'remove') {
            $this->checkoutRepository->deleteAddonById($this->request->added_cart_addon_id);
        }
    }

    /**
     * | Recalculation after the successful adjutment of the cart
     */
    public function calculateCartTotal()
    {
        if (!empty($this->cart)) {
            $cartAddonTotal = $this->checkoutRepository->getCartAddonsTotal($this->cart->id);

            $cartData = [
                'warehouse_addons_price' => $cartAddonTotal,
                'total_price' => ($this->cart->warehouse_price + $cartAddonTotal)
            ];

            $this->checkoutRepository->update($this->request->cart_id, $cartData);
        }
    }
}
