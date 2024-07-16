<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Http\Requests\AddTocartAddonRequest;
use App\Repositories\CartRepository;
use App\Repositories\WarehouseRepository;
use App\Services\AddRemoveCartAddons;
use Illuminate\Support\Facades\DB;
use App\Services\CartService;
use App\Services\OrderService;
use Exception;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $checkoutRepository;
    protected $warehouseRepository;

    public function __construct()
    {
        $this->checkoutRepository = new CartRepository();
        $this->warehouseRepository = new WarehouseRepository();
    }

    // Review cart at step 1
    public function reviewCart($cartId)
    {
        $isValidUuid = is_valid_uuid($cartId);

        if (!$isValidUuid) {
            $notification = response_array('danger', __('Invalid Cart Id.'));
            return redirect()->route('home')->with('notification', $notification);
        }

        $userId = auth()->user()->id;
        $cart = $this->checkoutRepository->getDetailsUserCartId($cartId, $userId);
        if (empty($cart)) {
            $notification = response_array('danger', __('Cart data not found. Please try again.'));
            return redirect()->route('home')->with('notification', $notification);
        }

        // Price Calculation
        $totalDays = $cart->no_of_days;
        $warehousePrice = number_format($cart->warehouse_price * $totalDays, 2);
        $taxesAndFee = number_format(0.00, 2);           // this will be changed as per the requirement
        $totalFare = $cart->total_price;

        $compacts = [
            'cart' => $cart,
            'totalDays' => $totalDays,
            'taxesAndFee' => $taxesAndFee,
            'warehousePrice' => $warehousePrice,
            'totalFare' => $totalFare
        ];

        return view('cart.review', $compacts);
    }

    // Review cart at step 2
    public function finalReviewCart(Request $request, $cartId)
    {
        try {
            $isValidUuid = is_valid_uuid($cartId);
            if (!$isValidUuid) {
                throw new Exception(__('Cart id is invalid'));
            }

            $userId = auth()->user()->id;
            $cart = $this->checkoutRepository->getDetailsUserCartId($cartId, $userId);
            if (empty($cart)) {
                throw new Exception(__('Cart data not found. Please try again.'));
            }

            // Update the remarks
            if (!empty($request->remarks)) {
                $updateAttribute = [
                    'notes' => $request->get('remarks')
                ];
                $this->checkoutRepository->updateCartById($cart->id, $updateAttribute);
            }

            $warehousePrice = number_format($cart->warehouse_price * $cart->no_of_days, 2);
            $compacts = [
                'cart' => $cart,
                'warehousePrice' => $warehousePrice,
            ];

            return view('cart.final-review', $compacts);
        } catch (Exception $e) {
            $notification = response_array('danger', $e->getMessage());
            return redirect()->route('home')->with('notification', $notification);
        }
    }

    // Review cart at final step and make payment 
    public function checkoutView($cartId)
    {
        $user = auth()->user();
        $cart = $this->checkoutRepository->getByUserId($user->id);

        if (empty($cart)) {
            $notification = response_array('danger', __('Cart data not found. Please try again.'));
            return redirect()->route('home')->with('notification', $notification);
        }

        return view('cart.checkout', compact('cart'));
    }

    // Add to cart warehouse
    public function addToCart(AddToCartRequest $request)
    {
        DB::beginTransaction();
        try {
            if (!auth()->check()) {
                $request->session()->put('form_data', $request->all());
                return redirect()->route('login');
            }
            return $this->processAddToCart($request);
        } catch (\Exception $e) {
            $notification = response_array('danger', $e->getMessage());
            DB::rollBack();
            // return $notification; // for ajax implemenations
            return redirect()
                ->back()
                ->with('notification', $notification);
        }
    }

    // 
    public function processAddToCart($request)
    {
        $request->session()->forget('form_data');
        $user = auth()->user();
        // Clear previous user cart if any have
        $this->checkoutRepository->delete($user->id);
        $cartService = new CartService($request);
        $cartService->main();

        DB::commit();

        $notification = response_array('success', __('Warehouse added to the cart.'));
        // return $notification;        // for ajax implemenation

        $cartId = $cartService->_cartId;
        $redirectUrl = route('cart.review', ['id' => $cartId]);
        return redirect($redirectUrl)
            ->with('notification', $notification);
    }

    // Add to cart warehouse addons
    public function addToCartAddons(AddTocartAddonRequest $request)
    {
        DB::beginTransaction();
        $addRemoveAddon = new AddRemoveCartAddons($request);
        try {
            $addRemoveAddon->main();

            DB::commit();
            $notification = response_array('success', __('Cart updated successfully.'));

            return redirect()
                ->back()
                ->with('notification', $notification);
        } catch (\Exception $e) {
            $notification = response_array('danger', $e->getMessage());
            DB::rollBack();

            return redirect()
                ->back()
                ->with('notification', $notification);
        }
    }

    // Remove addon from cart
    public function removeCartAddons($cartId, $cartAddonId)
    {
        DB::beginTransaction();

        try {
            $user = auth()->user();
            $cart = $this->checkoutRepository->getByUserAndCartId($user->id, $cartId);

            if (empty($cart)) {
                $notification = response_array('danger', __('Cart data not found. Please try again.'));
                return redirect()->route('home')->with('notification', $notification);
            }

            // Remove addon from cart
            $this->checkoutRepository->deleteAddon($cartId, $cartAddonId);

            // Re calculate cart total
            $this->calculateCartTotal($cart);

            DB::commit();

            $notification = response_array('success', __('Cart updated successfully.'));

            return redirect()
                ->back()
                ->with('notification', $notification);
        } catch (\Exception $e) {
            $notification = response_array('danger', $e->getMessage());
            DB::rollBack();

            return redirect()
                ->back()
                ->with('notification', $notification);
        }
    }

    // Place order with payment
    public function placeOrder(Request $req, $cartId)
    {
        $req->validate([
            'notes' => 'nullable|string'
        ]);

        DB::beginTransaction();
        try {
            $user = auth()->user();
            $cart = $this->checkoutRepository->getByUserAndCartId($user->id, $cartId);

            if (empty($cart)) {
                $notification = response_array('danger', __('Cart data not found. Please try again.'));
                return redirect()->route('home')->with('notification', $notification);
            }

            // CREATE CODE TO PLACE AND ORDER WITH PAYMENT DETAILS

            // CODE IS PENDING

            $orderService = new OrderService($req);
            $orderService->main();

            DB::commit();

            $notification = response_array('success', __('Cart updated successfully.'));

            return redirect()
                ->back()
                ->with('notification', $notification);
        } catch (\Exception $e) {
            $notification = response_array('danger', $e->getMessage());
            DB::rollBack();

            return redirect()
                ->back()
                ->with('notification', $notification);
        }
    }
}
