@extends('layouts.app')

@section('title', 'Orders')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('components.user-sidebar')
        </div>
        <div class="col-lg-9 ps-lg-4 ps-xl-6">
            <!-- Title and offcanvas button -->
            <div class="d-flex justify-content-between align-items-center mb-5 mb-sm-6">
                <!-- Title -->
                <h1 class="h3 mb-0">{{ __('Order History') }}</h1>

                <!-- Advanced filter responsive toggler START -->
                <button class="btn btn-primary d-lg-none flex-shrink-0 ms-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
                    <i class="fas fa-sliders-h"></i> Menu
                </button>
                <!-- Advanced filter responsive toggler END -->
            </div>

            <div class="card bg-transparent border-0">
                <div class="card-header bg-transparent border-bottom d-flex justify-content-between align-items-center p-0 pb-3">
                    <h5 class="card-title mb-0">{{ __('Your order') }}</h5>
                    <div class="col-md-3 ms-auto">
                        <!-- Short by filter -->
                        <form method="get" id="order-filter" action="{{ route('order.index') }}" onChange="event.preventDefault(); document.getElementById('order-filter').submit();">
                            <select name="filter" class="form-select js-choice" aria-label=".form-select-sm">
                                <option value="" selected="">All</option>
                                <option value="1" {{ (request()->get('filter') == 1) ? 'selected' : '' }}>Completed</option>
                                <option value="2" {{ (request()->get('filter') == 2) ? 'selected' : '' }}>Processing</option>
                                <option value="3" {{ (request()->get('filter') == 3) ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </form>
                    </div>
                </div>

                <!-- Card body -->
                <div class="card-body p-0 pt-5">
                    @if($orders->count() > 0)
                    @foreach($orders as $order)
                    <div class="row align-items-md-center">
                        <!-- Image -->
                        <div class="col-5 col-md-2">
                            <div class="bg-light p-2 rounded-2">
                                @if(!empty($warehouse->file))
                                <img class="w-100" src="{{ asset('theme/images/warehouse-placeholder.svg') }}" alt="">
                                @else
                                <img class="w-100" src="{{ asset('theme/images/warehouse-placeholder.svg') }}" alt="">
                                @endif
                            </div>
                        </div>

                        <div class="col-7 col-md-10">
                            <div class="row g-2 align-items-center">
                                <!-- Content -->
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <p class="heading-color fw-normal small mb-2">Order no: <span class="text-primary fw-bold">#{{$order->order_no}}</span></p>
                                    <h5 class="mb-2"><a class="text-decoration-none text-dark fw-bold" href="{{ route('order.show', $order->id) }}">{{$order->warehouse->name }}</a></h5>
                                    <!-- List -->
                                    <ul class="nav nav-divider small align-items-center">
                                        <li class="nav-item">Size: <b></b></li>
                                        <li class="nav-item">Check In: <b>{{ $order->check_in_formatted }}</b></li>
                                        <li class="nav-item">Check Out: <b>{{ $order->check_out_formatted }}</b></li>
                                    </ul>
                                </div>

                                <!-- Price and button -->
                                <div class="col-md-4 text-md-end ms-auto">
                                    <p class="text-success fw-semibold mb-1 mb-md-3"><i class="bi bi-check-circle-fill me-1"></i>
                                        @if($order->status == 1)
                                        {{ __('Completed') }}
                                        @elseif($order->status == 0)
                                        {{ __('Processing') }}
                                        @elseif($order->status == 3)
                                        {{ __('Cancelled') }}
                                        @endif
                                    </p>
                                    <small>Total amount</small>
                                    <h5 class="mt-1 mb-0">AED {{ $order->paid_amount }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-5"> <!-- Divider -->
                    @endforeach

                    <div class="row">
                        <div class="col-12 mt-5">
                            {{ $orders->appends($_GET)->links() }}
                        </div>
                    </div>
                    @else
                    <div class="text-center col-12">
                        <p class="fs-4">{{ __('No order found.') }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection