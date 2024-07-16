@extends('layouts.app')

@section('title', 'Warehouse')

@section('style')
<link rel="stylesheet" href="{{ asset('theme/css/swiper-bundle.min.css') }}" />
@endsection

@section('content')
<div class="container warehouse-details mb-5">
    <div class="row">
        <div class="col-md-6 warehouse-image ">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#" class="card-link">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Warehouse details</li>
                </ol>
            </nav>
            <div class="sld-wrp">
                <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="https://swiperjs.com/demos/images/nature-1.jpg" loading="lazy" />
                            <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
                        </div>
                        <div class="swiper-slide">
                            <img src="https://swiperjs.com/demos/images/nature-2.jpg" loading="lazy" />
                            <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
                        </div>
                        <div class="swiper-slide">
                            <img src="https://swiperjs.com/demos/images/nature-3.jpg" loading="lazy" />
                            <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
                        </div>
                        <div class="swiper-slide">
                            <img src="https://swiperjs.com/demos/images/nature-4.jpg" loading="lazy" />
                            <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
                        </div>
                        <div class="swiper-slide">
                            <img src="https://swiperjs.com/demos/images/nature-5.jpg" loading="lazy" />
                            <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
                        </div>
                        <div class="swiper-slide">
                            <img src="https://swiperjs.com/demos/images/nature-6.jpg" loading="lazy" />
                            <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
                        </div>
                        <div class="swiper-slide">
                            <img src="https://swiperjs.com/demos/images/nature-7.jpg" loading="lazy" />
                            <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
                        </div>
                        <div class="swiper-slide">
                            <img src="https://swiperjs.com/demos/images/nature-8.jpg" loading="lazy" />
                            <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
                        </div>
                        <div class="swiper-slide">
                            <img src="https://swiperjs.com/demos/images/nature-9.jpg" loading="lazy" />
                            <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
                        </div>
                        <div class="swiper-slide">
                            <img src="https://swiperjs.com/demos/images/nature-10.jpg" loading="lazy" />
                            <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
                        </div>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
                <div thumbsSlider="" class="swiper mySwiper mt-2">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="https://swiperjs.com/demos/images/nature-1.jpg" loading="lazy" />
                        </div>
                        <div class="swiper-slide">
                            <img src="https://swiperjs.com/demos/images/nature-2.jpg" loading="lazy" />
                        </div>
                        <div class="swiper-slide">
                            <img src="https://swiperjs.com/demos/images/nature-3.jpg" loading="lazy" />
                        </div>
                        <div class="swiper-slide">
                            <img src="https://swiperjs.com/demos/images/nature-4.jpg" loading="lazy" />
                        </div>
                        <div class="swiper-slide">
                            <img src="https://swiperjs.com/demos/images/nature-5.jpg" loading="lazy" />
                        </div>
                        <div class="swiper-slide">
                            <img src="https://swiperjs.com/demos/images/nature-6.jpg" loading="lazy" />
                        </div>
                        <div class="swiper-slide">
                            <img src="https://swiperjs.com/demos/images/nature-7.jpg" loading="lazy" />
                        </div>
                        <div class="swiper-slide">
                            <img src="https://swiperjs.com/demos/images/nature-8.jpg" loading="lazy" />
                        </div>
                        <div class="swiper-slide">
                            <img src="https://swiperjs.com/demos/images/nature-9.jpg" loading="lazy" />
                        </div>
                        <div class="swiper-slide">
                            <img src="https://swiperjs.com/demos/images/nature-10.jpg" loading="lazy" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="card warehouse-info border-0">
                <div class="card-body mt-2">
                    <h1 class="card-title Warehouse-name mb-4">{{ ($getLocale == 'ar') ? $warehouse->name_ar : $warehouse->name }}</h1>
                </div>

                <img class="" alt="" src="{{ asset('theme/images/Line 7.svg') }}" />
                <div class="row">
                    <div class="col-md-4">
                        <div class="card border-0">
                            <img src="./public/group.svg" class="card-img-top" alt="Image 1">
                            <div class="card-body card-Location text-center">
                                <h5 class="card-icon-name">Location & accessibility</h5>
                                <p class="card-icon-desc">Exact address</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0">
                            <img src="./public/vector 4.svg" class="card-img-top" alt="Image 2">
                            <div class="card-body card-layout text-center">
                                <h5 class="card-icon-name">Size & layout</h5>
                                <p class="card-icon-desc">Total square footage</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0">
                            <img src="./public/Group 1000004490.svg" class="card-img-top" alt="Image 3">
                            <div class="card-body card-Storage text-center">
                                <h5 class="card-icon-name">Storage capacity</h5>
                                <p class="card-icon-desc">Shelving & rack availability</p>
                            </div>
                        </div>
                    </div>
                </div>
                <img class="mt-2" alt="" src="{{ asset('theme/images/Line 7.svg') }}" />

                @if(!empty($warehouse->distance))
                <div class="fst-italic">{{$warehouse->distance}} {{ __('km away from your selected location') }}</div>
                @endif

                <form action="{{route('cart.add')}}" method="post" id="addCart">
                    @csrf
                    <input type="hidden" name="warehouse_id" value="{{ $warehouse->id }}">


                    <!-- <div class="w-100 mb-4">
                        <label for="warehouse-sizes" class="form-label">{{ __('Warehous Size') }}</label>
                        <select class="@error('warehouse_variant_id') is-invalid @enderror form-select form-select-lg" name="warehouse_variant_id" id="warehouse-sizes" onchange="appendPrice()">
                            <option value="">{{ __('Select Warehouse Size') }}</option>
                            <option value="" data-price="0"></option>
                        </select>

                        @error('warehouse_variant_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div> -->


                    <div class="input-group booking-dates border">
                        <h5 for="input1" class="date-label mt-3 px-4">{{ __('Enter check in date') }}
                            <input type="text" name="check_in_date" id="check_in_date" placeholder="dd/mm/yyyy" class="form-control border-0 p-0 mt-1 date-input" @if(!empty($formData)) value="{{ $formData['check_in_date']??'' }}" @endif>
                            @error('check_in_date')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </h5>
                        <img src="{{ asset('theme/images/Line 3.svg') }}" class="line-div px-5" alt="">
                        <h5 for="input2" class="date-label mt-3 px-5">{{ __('Enter check out date') }}
                            <input type="text" name="check_out_date" id="check_out_date" placeholder="dd/mm/yyyy" class="form-control border-0 p-0 mt-1 date-input" @if(!empty($formData)) value="{{ $formData['check_out_date']??'' }}" @endif>
                            @error('check_out_date')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </h5>
                    </div>
                    <div class="mt-5 w-100">
                        <div class="btn-group booking-action-buttons w-100" role="group">
                            <button type="button" class="btn wishlist-actions-button py-3"><b>Add to wishlist</b></button>
                            <button type="submit" class="btn btn-primary book-actions-button py-3"><span class="book-now">Book now
                                    (</span>
                                <b>AED </b> <b id="price-display"> </b>
                                <span> / night</span>
                                <span class="span">)</span></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row warehouse-description mt-5">
        <div class="card border-0">
            <div class="card-body">
                <h1 class="warehouse-description-name mt-5">{{ __('Warehouse description') }}</h1>
                <p class="warehouse-desc mt-5">
                    {{ ($getLocale == 'ar') ? $warehouse->description_ar : $warehouse->description }}
                </p>
            </div>
        </div>
    </div>
    <div class="row what-it-offers">
        <div class="col-12">
            <h1 class="warehouse-description-name mt-5">What it offers</h1>
        </div>
        <div class="col-md-4">
            <ul class="mt-3 list-group border-0">
                <li class="list-group-item list-name border-0"><img class="px-4" loading="lazy" alt="" src="./public/truck.svg" />Accessibility for large trucks</li>
                <li class="list-group-item list-name border-0"><img class="px-4" loading="lazy" alt="" src="./public/camera.svg" />Surveillance cameras</li>
                <li class="list-group-item list-name border-0"> <img class="px-4" loading="lazy" alt="" src="./public/temp.svg" />Temperature control features</li>
                <li class="list-group-item list-name border-0"><img class="px-4" loading="lazy" alt="" src="./public/car.svg" />On-site parking</li>
            </ul>
        </div>
        <div class="col-md-4">
            <ul class="mt-3 list-group border-0">
                <li class="list-group-item list-name border-0"><img class="px-4" loading="lazy" alt="" src="./public/internet.svg" />High-speed internet</li>
                <li class="list-group-item list-name border-0"><img class="px-4" loading="lazy" alt="" src="./public/backup.svg" />Backup generators included</li>
                <li class="list-group-item list-name border-0"><img class="px-4" loading="lazy" alt="" src="./public/office.svg" />Office area(s)</li>
                <li class="list-group-item list-name border-0"><img class="px-4" loading="lazy" alt="" src="./public/fire.svg" /> Fire alarms and extinguishers</li>
            </ul>
        </div>
    </div>
</div>


@endsection

@section('script')
<script src="{{ asset('theme/js/swiper-bundle.min.js') }}"></script>

<script>
    var swiper = new Swiper(".mySwiper", {
        loop: true,
        lazy: true,
        spaceBetween: 10,
        slidesPerView: 6,
        freeMode: true,
        watchSlidesProgress: true,
    });
    var swiper2 = new Swiper(".mySwiper2", {
        loop: true,
        lazy: true,
        spaceBetween: 10,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        thumbs: {
            swiper: swiper,
        },
    });

    $(function() {
        appendPrice();
    });

    function appendPrice() {
        const selectElement = document.getElementById('warehouse-sizes');
        const priceDisplay = document.getElementById('price-display');
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const price = selectedOption.getAttribute('data-price');
        priceDisplay.textContent = price ? price : '0.00';
    }

    // $('#addCart').submit(function(e) {
    //     e.preventDefault();
    //     addToCart(e);
    // });

    // function addToCart(e) {
    //     var targetform = $('#addCart');
    //     var murl = targetform.attr('action');
    //     var mdata = $("#addCart").serialize();
    //     e.preventDefault();

    //     $.ajax({
    //         url: murl,
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
    //         },
    //         type: "post",
    //         data: mdata,
    //         datatype: "json",
    //         success: function(mdata) {
    //             console.log(mdata)
    //             alert(mdata)
    //         },

    //         error: function(xhr, status, error) {
    //             if (xhr.status === 401) {
    //                 window.location.href = xhr.responseJSON.redirect ?? '/login';
    //             } else {
    //                 console.error('Error:', error);
    //                 var mError = JSON.stringify(error.responseJSON.errors);
    //                 alert(mError)
    //             }
    //         },
    //     });
    // }
</script>

@endsection