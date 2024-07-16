@extends('layouts.app')

@section('title', 'Order Detail')

@section('content')
<div class="container mb-5">
    <div class="row">
        <div class="col-md-3">
            @include('components.user-sidebar')
        </div>
        <div class="col-lg-9 ps-lg-4 ps-xl-6">
            <div class="d-flex justify-content-between align-items-center mb-5 mb-sm-6">
                <h1 class="h3 mb-0 d-flex align-items-center gap-2">
                    {{ __('Order') }} <span class="fw-bold">#{{ $order->order_no }}</span>
                    @if($order->status==1)
                    <span class="badge text-bg-success fs-8 fw-normal">Completed</span>
                    @elseif($order->status==0)
                    <span class="badge text-bg-warning fs-8 fw-normal">Pending</span>
                    @else
                    <span class="badge text-bg-danger fs-8 fw-normal">Cancelled</span>
                    @endif
                </h1>
                @if($order->is_checked_out==false)
                <form action="{{ route('order.cancel', $order->id) }}" method="post">
                    @csrf
                    <button class="btn btn-danger">Cancel Order</button>
                </form>
                @endif
            </div>

            <div class="row mb-4">
                <div class="col-lg-6">
                    <div class="card card-flush py-4 ">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h4 class="header-title mb-3">Order Details</h4>
                            </div>
                        </div>
                        <!--end::Card header-->

                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                    <tbody class="fw-semibold text-gray-600">
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="fa-regular fa-calendar me-2"></i> Date Created
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">{{$order->created_at_dmy}}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="fa-regular fa-calendar-check me-2"></i> Check In
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">{{$order->check_in_dmy}}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="fa-regular fa-calendar-check me-2"></i> Check Out
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">{{$order->check_out_dmy}}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="fa-regular fa-credit-card me-2"></i> Payment Method
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">Card</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!--end::Table-->
                            </div>
                        </div>
                        <!--end::Card body-->
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card card-flush py-4 ">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h4 class="header-title mb-3">Customer Details</h4>
                            </div>
                        </div>
                        <!--end::Card header-->

                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                    <tbody class="fw-semibold text-gray-600">
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="fa-regular fa-user me-2"></i> Customer
                                                </div>
                                            </td>

                                            <td class="fw-bold text-end">
                                                <div class="d-flex align-items-center justify-content-end">
                                                    {{auth()->user()->name}}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="fa-regular fa-envelope me-2"></i> Email
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">
                                                {{auth()->user()->email}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="fa-solid fa-mobile-screen me-2"></i> Phone
                                                </div>
                                            </td>
                                            <td class="fw-bold text-end">
                                                {{auth()->user()->phone_number}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!--end::Table-->
                            </div>
                        </div>
                        <!--end::Card body-->
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-8">
                    <div class="card card-flush py-4 ">
                        <div class="card-header">
                            <div class="card-title">
                                <h4 class="header-title mb-3">Warehouse Details</h4>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Warehouse</th>
                                            <th>Price</th>
                                            <th>Total Days</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$order->warehouse->name}}</td>
                                            <td>AED {{$order->warehouse->price}}</td>
                                            <td>{{$noOfDays}}</td>
                                            <td>AED {{$order->total_amount}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- if service added then show this html else hide -->
                    @if(collect($order->orderAddons)->isNotEmpty())
                    <div class="card card-flush py-4 mt-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h4 class="header-title mb-3">Service Details</h4>
                            </div>
                        </div>
                        <div class="card-body pt-0">

                            <div class="table-responsive">

                                <table class="table mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Service</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->orderAddons as $orderAddon)
                                        <tr>
                                            <td>{{$orderAddon->warehouseAddon->service_name}}</td>
                                            <td>AED {{$orderAddon->addon_price}}</td>
                                            <td>AED {{$orderAddon->addon_price}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="col-lg-4">
                    <div class="card card-flush py-4 ">
                        <div class="card-header">
                            <div class="card-title">
                                <h4 class="header-title mb-3">Order Summary</h4>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Description</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Grand Total :</td>
                                            <td>AED {{number_format($order->total_amount+$order->addon_charges,2)}}</td>
                                        </tr>
                                        <tr>
                                            <td>Shipping Charge :</td>
                                            <td>AED 0.00</td>
                                        </tr>
                                        <tr>
                                            <td>Estimated Tax : </td>
                                            <td>AED 0.00</td>
                                        </tr>
                                        <tr>
                                            <th>Total :</th>
                                            <th>AED {{$order->paid_amount}}</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection