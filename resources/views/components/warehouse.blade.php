<div class="col-12 col-md-6 col-lg-3 filtered-destination-option">
    <div class="frame-filtered-destination-option1">
        <div class="image-container">
            <a href="{{ route('warehouse.show', $warehouse->id) }}" class="card-link text-decoration-none">
                @if(!empty($warehouse->file))
                <img class="card-img-top" src="{{ url('storage/'. $warehouse->file->path) }}" alt="">
                @else
                <img class="card-img-top" src="{{ asset('theme/images/warehouse-placeholder.svg') }}" alt="">
                @endif

                <!-- <div class="rating-overlay">
                    <span class="div2">4.1</span>
                    <img src="./public/star-1.svg" alt="" class="rating-img">
                    <img src="./public/Line 4.svg" alt="" class="rating-img">
                    <span>272</span>
                </div> -->
            </a>
        </div>
        <div class="rectangle-section">
            <a href="{{ route('warehouse.show', $warehouse->id) }}" class="card-link text-decoration-none">
                <div class="km-away">{{$warehouse->distance ?? ''}} km away</div>
                <div class="warehouse-in-sharjah">{{ ($getLocale == 'ar') ? $warehouse->name_ar : $warehouse->name }}</div>
                <div class="night-wrapper">
                    <div class="night">
                        <b><span>AED {{ $warehouse->price ?? 0 }}</span></b>
                        <span class="night1">/night</span>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>