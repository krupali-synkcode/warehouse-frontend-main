<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Repositories\OrderRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * | Created At - 30/05/2024 
     * | Created by - Anshu Kumar
     * | Created for the order confirmation and initiation
     */
    protected $orderRepository;
    public function __construct()
    {
        $this->orderRepository = new OrderRepository;
    }

    public function index(Request $request)
    {
        $user = auth()->user();
        $orders = $this->orderRepository->getAll($request, $user->id);

        return view('order.index', compact('orders'));
    }

    public function show($id)
    {
        $user = auth()->user();
        $order = $this->orderRepository->getByUserId($id, $user->id);

        if (empty($order)) {
            $notification = response_array('danger', __('Order not found.'));
            return redirect()->back()->with('notification', $notification);
        }
        // No of days calculation
        $totalDays = calculate_days($order->check_in_date, $order->check_out_date);
        $compacts = [
            'order' => $order,
            'noOfDays' => $totalDays
        ];

        return view('order.show', $compacts);
    }

    public function cancelOrder(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $user = auth()->user();
            $order = $this->orderRepository->getByUserId($id, $user->id);

            if (collect($order)->isEmpty()) {
                throw new Exception(__('Order not found'));
            }

            if ($order->status == 3) {
                throw new Exception(__('This order has been cancelled already'));
            }

            if ($order->is_checked_out) {
                throw new Exception(__('This order date range has been used up or it has been checked out.'));
            }

            $orderData = [
                'status' => Order::STATUS['cancelled'],
                'is_checked_out' => true
            ];
            $this->orderRepository->update($order->id, $orderData);

            DB::commit();

            $notification = response_array('success', __('Your order has been cancelled successfully.'));
            return redirect()
                ->back()
                ->with('notification', $notification);
        } catch (Exception $e) {
            $notification = response_array('danger', $e->getMessage());
            DB::rollBack();

            return redirect()
                ->back()
                ->with('notification', $notification);
        }
    }
}
