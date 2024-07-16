<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\CartAddon;
use Exception;
use Illuminate\Support\Facades\DB;

class CartRepository
{
    protected $cart;

    protected $cartAddon;

    public function __construct()
    {
        $this->cart = new Cart();
        $this->cartAddon = new CartAddon();
    }

    public function getByUserId($user_id)
    {
        return $this->cart->with(['warehouse', 'warehouseVariant'])
            ->where('user_id', $user_id)
            ->first();
    }

    public function getDetailsUserCartId($cartId, $userId)
    {
        return $this->cart->with([
            'warehouse',
            'warehouseAddons' => function ($query) use ($cartId) {
                $query->leftJoin('cart_addons', function ($join) use ($cartId) {
                    $join->on('cart_addons.addon_id', '=', 'warehouse_addons.id')
                        ->where('cart_addons.cart_id', '=', $cartId);
                })
                    ->select(
                        'warehouse_addons.*',
                        'cart_addons.id as cart_added_addon_id',
                        DB::raw("CASE WHEN cart_addons.id IS NULL THEN 'No' ELSE 'Yes' END as is_addon_added")
                    );
            }
        ])
            ->where('id', $cartId)
            ->where('user_id', $userId)
            ->first();
    }

    public function getByUserAndCartId($user_id, $cart_id)
    {
        return $this->cart->where('user_id', $user_id)->where('id', $cart_id)->first();
    }

    public function store($data)
    {
        return $this->cart->create($data);
    }

    public function update($id, $data)
    {
        return $this->cart->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->cart->where('user_id', $id)->delete();
    }

    public function getCartAddonsTotal($cart_id)
    {
        return $this->cartAddon->where('cart_id', $cart_id)->sum('addon_price');
    }

    public function storeAddon($data)
    {
        return $this->cartAddon->create($data);
    }

    public function deleteAddon($cartId, $cartAddonid)
    {
        return $this->cartAddon->where('cart_id', $cartId)->where('addon_id', $cartAddonid)->delete();
    }

    public function deleteAddonById($cartAddonId)
    {
        $this->cartAddon->where('id', $cartAddonId)->delete();
    }


    // Find by warehouse Variant id
    public function findCartByVariantId($variantId)
    {
        return $this->cart->where('warehouse_variant_id', $variantId)
            ->orderByDesc('created_at')
            ->first();
    }

    public function findCartAddonByCheckoutId($checkoutId)
    {
        return $this->cartAddon->where('cart_id', $checkoutId)
            ->get();
    }

    public function updateCartById($cartId, $attribute): void
    {
        $cart = $this->cart->find($cartId);
        if (collect($cart)->isEmpty()) {
            throw new Exception("Cart not available for this cart id");
        }
        $cart->update($attribute);
    }

    /**
     * | Check the cart addon by cart id
     */
    public function getCartAddonByAddonCartId($cartId, $addonId)
    {
        return $this->cartAddon->where('cart_id', $cartId)
            ->where('addon_id', $addonId)
            ->first();
    }
}
