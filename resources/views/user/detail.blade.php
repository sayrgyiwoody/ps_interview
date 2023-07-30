@extends('user.layout.master')

@section('content')
    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5  justify-content-center">
            <div class="col-4 mb-30 d-flex align-items-center">
                <div class="mx-auto">
                    <img class="img-fluid w-100 h-100"
                        src="{{ asset('storage/itemImages/' . $item->image) }}">
                </div>
            </div>


        </div>
        <div class="row">
            <div class="col-sm-12 h-auto">
                <div class="row">
                    <div class="col-8">
                        <div class="h-100 bg-light p-30">
                            <h3>{{ $item->name }}</h3>
                            <input type="hidden" value="{{ Auth::user()->id }}" id="userId">
                            <input type="hidden" value="{{ $item->id }}" id="itemId">

                            <h3 class="font-weight-semi-bold mb-4 text-success">{{ $item->price }} Ks</h3>
                            <div class="row mb-3">
                                <div class="col-2">
                                    <p>Type</p>
                                    @if ($item->type)
                                        <button class="btn btn-outline-primary border rounded">{{ $item->type }}</button>
                                    @else
                                        <span class="text-danger">not set</span>
                                    @endif
                                </div>
                                <div class="col-2">
                                    <p>Condition</p>
                                    @if ($item->condition)
                                        <button
                                            class="btn btn-outline-success border rounded">{{ $item->condition }}</button>
                                    @else
                                        <span class="text-danger">not set</span>
                                    @endif
                                </div>
                                <div class="col-2">
                                    <p>Status</p>
                                    @if ($item->publish_status)
                                        <button class="btn btn-outline-info border rounded">
                                            available
                                        </button>
                                    @else
                                        <button class="btn btn-outline-danger border rounded">
                                            pending
                                        </button>
                                    @endif

                                </div>
                            </div>
                            <p class="fs-5 text-info mb-2">Product Description</p>
                            <p>{!! $item->desc !!}</p>
                            <p class="mb-2 fs-5 text-info">Owner Information</p>
                            @if ($item->owner_number !== null)
                                <div class="card p-3 mb-3">
                                    <p class="my-0 mb-1"><i class="fa-solid fa-phone me-2"></i> Contact Information</p>
                                    <p class="my-0 fw-semibold">{{ $item->owner_number }}</p>
                                </div>
                            @endif
                            <div class="mb-2"><img class="rounded-circle" src="https://ui-avatars.com/api/?name={{ $item->owner_name }}"
                                    width="50">
                                <span>{{ $item->owner_name }}</span>
                            </div>

                            <div class="d-flex pt-2 align-items-center justify-content-between">
                                <div class="">
                                    <strong class="text-dark mr-2">Share on:</strong>
                                    <div class="d-inline-flex">
                                        <a class="text-dark px-2" href="">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                        <a class="text-dark px-2" href="">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                        <a class="text-dark px-2" href="">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                        <a class="text-dark px-2" href="">
                                            <i class="fab fa-pinterest"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="">
                                    <a href="{{ route('user.home') }}" class="btn btn-dark rounded shadow"><i
                                            class="fa-solid fa-arrow-left me-2"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <label class="form-label"><i class="fa-solid fa-location-dot me-2"></i>Location</label>
                        <div id="map" style="height: 500px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->


    <!-- items Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also
                Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <!-- Swiper -->
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        @foreach ($items as $i)
                            <div class="swiper-slide">
                                <div class="col pb-1">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden" style="height: 300px;">
                                            <img class="img-fluid w-100 h-100"
                                                src="{{ asset('storage/itemImages/' . $i->image) }}" alt=""
                                                style="object-fit:cover;object-position:center;">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i
                                                        class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i
                                                        class="far fa-heart"></i></a>
                                                <a class="btn btn-outline-dark btn-square"
                                                    href="{{ route('user.detail', $i->id) }}"><i
                                                        class="fa-solid fa-circle-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="py-4 px-3">
                                            <a class="h6 text-decoration-none text-truncate"
                                                href="{{ route('user.detail', $i->id) }}">{{ $i->name }}</a>
                                            <p class="text-success my-1">$ {{ $i->price }}</p>
                                            <div class="d-flex mt-2 align-items-center">
                                                <img class="rounded-circle me-2" width="40"
                                                    src="https://ui-avatars.com/api/?name={{ $i->owner_name }}"
                                                    alt="">
                                                <p class="my-0" class="mt-4 ms-2">{{ $i->owner_name }}</p><br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- items End -->
@endsection

@section('scriptSource')
<script>
    <!-- map picker -->
$(document).ready(function () {
  // Default latitude and longitude
  var defaultLat = {{$lat}};
  var defaultLng = {{$long}};

  var map = L.map("map").setView([defaultLat, defaultLng], 13);

  L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    maxZoom: 19,
  }).addTo(map);

  var marker = L.marker([defaultLat, defaultLng], { draggable: false }).addTo(map);

  // Initialize inputs with default values
  updateLatLngInputs(marker.getLatLng());
});

// Function to update the latitude and longitude inputs
function updateLatLngInputs(latlng) {
  $("#latitude").val(latlng.lat);
  $("#longitude").val(latlng.lng);
}

</script>

@endsection
