@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container home-destination">
    <!-- warehouse filter -->
    <div class="row mb-5">
        <div class="col-10 mt-4 search-destination">
            <h1 class="secure-spacious-container mb-5 text-center">
                <span class="secure-spacious">{{ __('Secure, Spacious & Ready') }}</span>
                <span class="for-you">{{ __('for You!') }}</span>
            </h1>
            <div class="">
                <ul class="nav nav-pills mb-3 justify-content-center" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="filter-tab" data-bs-toggle="tab" data-bs-target="#filter-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Filter</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="map-tab" data-bs-toggle="tab" data-bs-target="#map-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Map</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="filter-tab-pane" role="tabpanel" aria-labelledby="filter-tab" tabindex="0">
                        <form method="GET" action="{{ route('home') }}" class="frame-section2">
                            <div class="row search-bar">
                                <div class="col-md-4 mt-2 px-4">
                                    <div class="">{{ __('Where') }}</div>
                                    <input type="text" class="input" value="{{ request()->get('search') }}" name="search" placeholder="Search your destination...">
                                </div>
                                <div class="col-md-3">
                                    <div class="check-in px-3">
                                        <img src="{{ asset('theme/images/Line 3.svg') }}" class="line-div px-4" alt="">{{ __('Check in') }}
                                        <input type="text" value="{{ request()->get('check_in_date') }}" name="check_in_date" id="check_in_date" class="check-in-input" placeholder="Add Dates">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="check-out px-3">
                                        <img src="{{ asset('theme/images/Line 3.svg') }}" class="line-div px-4" alt="">{{ __('Check out') }}
                                        <input type="text" value="{{ request()->get('check_out_date') }}" name="check_out_date" id="check_out_date" class="check-out-input" placeholder="Add Dates">
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button class="search-wrapper">
                                        <div class="search">{{ __('Search') }}</div>
                                    </button>
                                </div>
                            </div>
                            <div class="row w-100">
                                <div class="col-12">
                                    <div class="text-center">
                                        <button class="btn btn-link p-0 mb-2" type="button" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">More Filters</button>
                                        @if(request()->has('search') || request()->has('check_in_date') || request()->has('check_out_date') || request()->has('storage_type') || request()->has('emirate') || request()->has('no_dates'))
                                        <a class="btn  btn-outline-danger mb-2 btn-sm ms-2 border-0" href="{{ route('home') }}"><i class="fa fa-close me-1"></i> Clear Filters</a>
                                        @endif
                                    </div>
                                    <div class="collapse" id="collapseExample">
                                        <div class="card card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="storage_type" class="form-label">Storage Type</label>
                                                    <select name="storage_type" id="storage_type" class="form-select">
                                                        <option value="">Select Storage Type</option>
                                                        @foreach($storageTypes as $storageType)
                                                        <option value="{{$storageType->id}}">{{$storageType->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <label for="emirate" class="form-label">Emirate</label>
                                                    <select name="emirate" id="emirate" class="form-select">
                                                        <option value="">Select Emirate</option>
                                                        @foreach($emirateTypes as $emirateType)
                                                        <option value="{{$emirateType->id}}">{{$emirateType->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <div class="form-check mt-4 pt-3">
                                                        <input class="form-check-input" type="checkbox" id="no_dates" name="no_dates">
                                                        <label class="form-check-label" for="no_dates">
                                                            Not sure about my dates
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="map-tab-pane" role="tabpanel" aria-labelledby="map-tab" tabindex="0">
                        <div id="map" style="width: 100%; height: 300px;border-radius:10px;"></div>

                        <form method="GET" action="{{ route('home') }}" class="frame-section2">
                            <input type="hidden" id="latitude" name="latitude" readonly>
                            <input type="hidden" id="longitude" name="longitude" readonly>
                            <button class="btn btn-theme mt-3 px-4 py-2">{{ __('Confirm Location') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- warehouse category list -->
    <div class="row filter-option">
        <div class="col-12 d-flex justify-content-around flex-wrap">
            @if(!empty($categories))
            @foreach($categories as $category)
            <a href="{{ route('home') }}?category={{ $category->id }}" class="button-div {{ (request()->get('category') == $category->id) ? 'active' : '' }} mb-2 text-decoration-none ">
                {!! file_get_contents($category->categoryIcon['path']) !!}
                {{ ($getLocale == 'ar') ? $category->name_ar : $category->name }}
            </a>
            @endforeach
            @endif

            @if(!empty($dropdownCategories))
            <div class="dropdown">
                <button class="more-filter mb-2 text-decoration-none dropdown-toggle no-icon" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ __('More Filters') }}
                    <img src="{{ asset('theme/images/vector-3.svg') }}" alt="" class="mr-2 vector-container">
                </button>
                <ul class="dropdown-menu">
                    @foreach($dropdownCategories as $category)
                    <li><a class="dropdown-item" href="{{ route('home') }}?category={{ $category->id }}">{{ ($getLocale == 'ar') ? $category->name_ar : $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>

    <!-- warehouse list -->
    <div class="row mt-5 destination-option mb-5">
        @if($warehouses->count() > 0)
        @foreach($warehouses as $warehouse)
        @include('components.warehouse')
        @endforeach

        <div class="col-12 mt-5">
            {{ $warehouses->appends($_GET)->links() }}
        </div>
        @else
        <div class="text-center col-12">
            <p class="fs-4">{{ __('No warehouse found.') }}</p>
        </div>
        @endif
    </div>
</div>

@endsection

@section('script')
<script src="https://maps.googleapis.com/maps/api/js?sensor=false&callback=myMap"></script>
<script>
    var map;
    var marker;

    function initMap() {
        var initialLocation = {
            lat: 0,
            lng: 0
        }; // Initial map center
        map = new google.maps.Map(document.getElementById('map'), {
            center: initialLocation,
            zoom: 2
        });

        map.addListener('click', function(event) {
            placeMarker(event.latLng);
            updateFormInputs(event.latLng);
        });

        function placeMarker(location) {
            if (marker) {
                marker.setPosition(location);
            } else {
                marker = new google.maps.Marker({
                    position: location,
                    map: map
                });
            }
        }

        function updateFormInputs(location) {
            document.getElementById('latitude').value = location.lat();
            document.getElementById('longitude').value = location.lng();
        }
    }

    initMap();
</script>
@endsection