@extends('layouts.app')

@section('title', 'Additional Services')

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
<div class="header-stepper mb-5 py-2">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div id="stepper1" class=" bs-stepper">
                    <div class="bs-stepper-header" role="tablist">
                        <div class="step" data-target="#test-l-1">
                            <button type="button" class="step-trigger active" role="tab" id="stepper1trigger1" aria-controls="test-l-1">
                                <span class="bs-stepper-circle">1</span>
                                <span class="bs-stepper-label">Additional Services</span>
                            </button>
                        </div>
                        <div class="bs-stepper-line"></div>
                        <div class="step" data-target="#test-l-2">
                            <button type="button" class="step-trigger" role="tab" id="stepper1trigger2" aria-controls="test-l-2">
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
</div>

<section class="container pricing">
    <div class="row pricing-details">
        <!-- Left Column: Additional Services and Additional Remarks -->
        <div class="col-md-12 mb-3 additional-service">
            <div class="table-responsive">
                <div class="text-danger mb-3 fst-italic"><strong>Note</strong> : Cargo Details must be provided for warehouse booking. No. of Pieces means quantity inside each pacakge.</div>
                <table class="table table-bordered cargo-details rounded-2 overflow-hidden">
                    <tr>
                        <th scope="col">Package Type<span class="text-danger">*</span></th>
                        <th scope="col">Storage Type<span class="text-danger">*</span></th>
                        <th scope="col">Stacked</th>
                        <th scope="col">Commodity Description<span class="text-danger">*</span></th>
                        <th scope="col">HS Code<span class="text-danger">*</span></th>
                        <th scope="col">Pacakge Quantity<span class="text-danger">*</span></th>
                        <th scope="col">Length (M)</th>
                        <th scope="col">Width (M)</th>
                        <th scope="col">Height (M)</th>
                        <th scope="col">Package Volume<span class="text-danger">*</span></th>
                        <th scope="col">Max Weight<span class="text-danger">*</span></th>
                        <th scope="col">No Of Pieces<span class="text-danger">*</span></th>
                        <th scope="col"></th>
                    </tr>
                    @include('cart.partials.cargo-details')
                </table>
            </div>
        </div>

        <div class="col-md-8 mb-3 additional-service">
            @if($cart->warehouseAddons->count() > 0)
                <div class="additional-services">Additional services</div>

                @foreach($cart->warehouseAddons as $warehouseAddon)
                    <form action="{{ route('cart.addons') }}" class="mt-4" method="post">
                        @csrf
                        <input type="hidden" name="cart_id" id="cart_id" value="{{ $cart->id }}">
                        <input type="hidden" name="addon_id" id="addon_id" value="{{ $warehouseAddon->id }}">

                        <div class="card service-div mb-4">
                            <div class="card-body service-info">
                                <h5 class="card-title mt-3 services-container">
                                    <span class="forklift-services">{{ ($getLocale == 'ar') ? $warehouseAddon->service_name_ar : $warehouseAddon->service_name }} </span>
                                    <b>(AED {{ $warehouseAddon->price }})</b>
                                </h5>
                                <p class="card-text mt-3 service-text">{{ ($getLocale == 'ar') ? $warehouseAddon->description : $warehouseAddon->description_ar }}</p>

                                @if($warehouseAddon->is_addon_added=='Yes')
                                <input type="hidden" name="action" id="action" value="remove">
                                <input type="hidden" name="added_cart_addon_id" id="added_cart_addon_id" value="{{$warehouseAddon->cart_added_addon_id}}">
                                <div class="add-button">
                                    <button type="submit" class="add remove">Remove</button>
                                </div>
                                @else
                                <input type="hidden" name="action" id="action" value="add">
                                <div class="add-button">
                                    <button type="submit" class="add">Add</button>
                                </div>
                                @endif
                            </div>
                        </div>
                    </form>
                @endforeach
            @endif

            <!-- Additional Remarks -->
            <form action="{{ route('cart.finalReview', ['id' => $cart->id]) }}">
                @csrf
                <div class="remark-box ">
                    <strong class="additional-remarks">Additional remarks</strong>
                    <textarea id="remarks" name="remarks" class="form-control textarea mt-4" placeholder="Write all the additional remarks you want us to remember..." rows="5" {{ $cart->notes }}></textarea>
                </div>
                <div class="mt-4 mb-5 text-end">
                    <a class="back-button btn" href="{{ route('warehouse.show', $cart->warehouse->id) }}">
                        <i class="fa-solid fa-angle-left me-2"></i>
                        <span>Back</span>
                    </a>
                    <button type="submit" class="next-button">Next</button>
                </div>
            </form>
        </div>
        <div class="col-md-4 mb-3 price-detail">
            <div class="price-details mb-4">Price details</div>
            <div class="card review-detail">
                <div class="card-body review-detail-div">
                    <div class="row mb-2">
                        <div class="col review-detail-left">
                            <b class="farenight">Fare/night</b>
                        </div>
                        <div class="col review-detail-right">
                            <b class="farenight">AED {{ $cart->price }}</b>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col review-detail-left">
                            <div class="review-detail-text">Total days</div>
                        </div>
                        <div class="col text-right review-detail-right">
                            <div class="review-detail-text">{{ $totalDays }}</div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col review-detail-left">
                            <div class="review-detail-text">Fare for {{ $totalDays }} days</div>
                        </div>
                        <div class="col text-right review-detail-right">
                            <div class="review-detail-text">AED {{ $warehousePrice }}</div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col review-detail-left">
                            <div class="review-detail-text">Additional Services</div>
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
                            <div class="review-detail-text">AED {{ $taxesAndFee }}</div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col review-detail-left">
                            <h2 class="total-fare">Total Fare</h2>
                        </div>
                        <div class="col text-right review-detail-right">
                            <b class="total-fare">AED {{ $totalFare }}</b>
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
@endsection

@section('script')
<script>
    jQuery(document).ready( function($) { 
        var cargo_html = `@include("cart.partials.cargo-details")`;
        var cargoObj = $('.cargo-details');

        $(document).on('click', '.add-cargo', function() {
            cargoObj.find('.add-cargo').remove();
            cargoObj.find('.action-btns').html('<button class="btn btn-danger btn-sm rounded-5 remove-cargo"><i class="fa fa-close"></i></button>');
            cargoObj.append(cargo_html);
        });

        $(document).on('click', '.remove-cargo', function() {
            var thisObj = $(this);

            thisObj.parents('tr').remove();
            // cargoObj.find('.action-btns').html('<button class="btn btn-danger btn-sm rounded-5"><i class="fa fa-close"></i></button>');
            // cargoObj.append(cargo_html);
        });
    });
</script>
@endsection