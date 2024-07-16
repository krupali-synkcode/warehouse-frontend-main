@extends('layouts.app')

@section('title', 'Review Cart')

@section('style')
<style>
    .navbar {
        margin-bottom: 0px !important;
    }

    main.py-4 {
        padding-top: 0px !important;
    }
</style>
@endsection

@section('content')
<div class="checkout-1-additional-service">
    <div class="mb-5 py-2 header-stepper">
        <div id="stepper1" class="container bs-stepper">
            <div class="row">
                <div class="col-12">
                    <div class="bs-stepper-header" role="tablist">
                        <div class="step" data-target="#test-l-1">
                            <button type="button" class="step-trigger" role="tab" id="stepper1trigger1" aria-controls="test-l-1">
                                <span class="bs-stepper-circle">1</span>
                                <span class="bs-stepper-label">Additional Services</span>
                            </button>
                        </div>
                        <div class="bs-stepper-line"></div>
                        <div class="step" data-target="#test-l-2">
                            <button type="button" class="step-trigger active" role="tab" id="stepper1trigger2" aria-controls="test-l-2">
                                <span class="bs-stepper-circle">2</span>
                                <span class="bs-stepper-label">Review</span>
                            </button>
                        </div>
                        <div class="bs-stepper-line"></div>
                        <div class="step" data-target="#test-l-3">
                            <button type="button" class="step-trigger" role="tab" id="stepper1trigger3" aria-controls="test-l-3">
                                <span class="bs-stepper-circle">3</span>
                                <span class="bs-stepper-label">Payment</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="container pricing">
        <div class="row pricing-details">
            <!-- Left Column: Additional Services and Additional Remarks -->
            <div class="col-md-8 mb-3 additional-service">
                <div class="row">
                    <div class="additional-services mb-5">Warehouse details</div>
                    <!-- Warehouse details -->
                    <div class="mb-4">
                        <div class="card warehouse-detail-div">
                            <div class="card-body warehouse-detail-info">
                                <div class="img-div mx-2 mt-2">
                                    @if(!empty($cart->warehouse->file))
                                    <img class="img-div-backgroud img-fluid" src="{{ url('storage/'. $cart->warehouse->file->path) }}" alt="">
                                    @else
                                    <img class="img-div-backgroud img-fluid" src="{{ asset('theme/images/warehouse-placeholder.svg') }}" alt="">
                                    @endif
                                </div>
                                <div class="name-div">
                                    <h5 class="card-title mt-3 warehouse-detail-container">
                                        <span class="forklift-services">{{ $cart->warehouse->name }}</span>
                                    </h5>
                                    <p class="card-text mt-3 service-text1">{{ ($getLocale == 'ar') ? $cart->warehouse->description_ar : $cart->warehouse->description}}</p>
                                    <p class="card-text price-night"><b class="price">AED {{$cart->warehouse->price}}</b>/night</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rented period -->
                <div class="row">
                    <div class="additional-services mt-5 mb-4">Rented period</div>
                    <div class="mb-4">
                        <div class="card rented-div">
                            <div class="card-body rented-info">
                                <div class="date-labels mt-4 mx-4">
                                    <div class="check-in mb-2">Check in</div>
                                    <b class="th-may-2024">{{ $cart->checkin_formatted }}</b>
                                </div>
                                <img class="calendar-icon-child" loading="lazy" alt="" src="./public/arrow-bold.svg" />
                                <div class="date-labels1">
                                    <div class="check-out mb-2">Check out</div>
                                    <b class="th-june-2024">{{ $cart->checkout_formatted }}</b>
                                </div>
                                <div class="edit-button">
                                    <button class="edit">Edit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4 mb-5 text-end">
                    <a class="back-button btn" href="{{ route('cart.review', $cart->id) }}">
                        <i class="fa-solid fa-angle-left me-2"></i>
                        <span>Back</span>
                    </a>
                    <button class="next-button">Confirm</button>
                </div>
            </div>

            <!-- Right Column: Price Details -->
            <div class="col-md-4 price-detail">
                <div class="price-details mb-5">Price details</div>
                <div class="card review-detail">
                    <div class="card-body review-detail-div">
                        <div class="row mb-2">
                            <div class="col review-detail-left">
                                <b class="farenight">Fare/night</b>
                            </div>
                            <div class="col review-detail-right">
                                <b class="farenight">AED {{ $cart->warehouse->price }}</b>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col review-detail-left">
                                <div class="review-detail-text">Total days</div>
                            </div>
                            <div class="col text-right review-detail-right">
                                <div class="review-detail-text">{{ $cart->no_of_days }}</div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col review-detail-left">
                                <div class="review-detail-text">Fare for {{ $cart->no_of_days }} days</div>
                            </div>
                            <div class="col text-right review-detail-right">
                                <div class="review-detail-text">AED {{ $warehousePrice }}</div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col review-detail-left">
                                <div class="review-detail-text">Additional</div>
                            </div>
                            <div class="col text-right review-detail-right">
                                <div class="review-detail-text">AED {{ $cart->warehouse_addons_price }}</div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col review-detail-left">
                                <div class="review-detail-text">Taxes and fee</div>
                            </div>
                            <div class="col text-right review-detail-right">
                                <div class="review-detail-text">AED {{ $cart->taxes_and_fee }}</div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col review-detail-left">
                                <h2 class="total-fare">Total Fare</h2>
                            </div>
                            <div class="col text-right review-detail-right">
                                <b class="total-fare">AED {{ $cart->total_price }}</b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col review-detail-left">
                                <div class="includes-taxes-and">
                                    Includes taxes and charges
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection