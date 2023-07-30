@extends('admin.layout.master')

@section('title', 'Item Edit Page')

@section('header')

    <h3>Item Edit Page</h3>

@endsection

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="p-3 rounded mb-3 bg-light d-flex align-items-center"><a href="{{route('admin.item.list')}}" class="text-decoration-none">List page</a><span><i class="fa-solid fa-chevron-right mx-2"></i>Edit Items</span></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-body bg-light">
                            <form action="{{route('admin.item.edit',$item->id)}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    @csrf
                                    <div class="form-group">
                                        <h5>Item Information</h5>
                                        <hr class="mt-2 mb-3">
                                        <label for="itemName" class="control-label fw-semibold mb-1">Item Name*</label>
                                        <input value="{{old('itemName',$item->item_name)}}" id="cc-pament" name="itemName" type="text"
                                            class="form-control mb-3 @error('itemName') is-invalid @enderror"
                                            aria-required="true" aria-invalid="false" placeholder="Enter Item Name...">
                                        @error('itemName')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                        <label for="categoryId" class="control-label fw-bold mt-3 mb-1">Category</label>
                                                <select name="categoryId" id="" class="form-select @error('categoryId') is-invalid @enderror">
                                                    <option value="" selected >Choose Category</option>
                                                    @foreach ($category as $c )
                                                        <option value="{{$c->id}}" @if($old_category_id == $c->id || old('categoryId') == $c->id) selected @endif>{{$c->name}}</option>
                                                    @endforeach
                                                </select>
                                            @error('categoryId')
                                                <span class="invalid-feedback">{{$message}}</span>
                                        @enderror
                                        <label for="itemPrice" class="control-label  fw-semibold my-2">Price*</label>
                                        <input id="cc-pament" name="itemPrice" value="{{ old('itemPrice',$item->price) }}" type="number"
                                            class="form-control mb-2 @error('itemPrice') is-invalid @enderror"
                                            aria-required="true" aria-invalid="false" placeholder="Enter Item price...">
                                        @error('itemPrice')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                        <label for="itemDesc" class="control-label fw-semibold my-2">Description*</label>
                                        <textarea name="itemDesc"  id="itemDesc" class="form-control mb-2 @error('itemDesc') is-invalid @enderror" placeholder="Enter Item Description...">{{old('itemDesc',$item->desc)}}</textarea>
                                        @error('itemDesc')
                                            <span class="invalid-feedback">{{$message}}</span>
                                        @enderror
                                        <label for="condition" class="form-label my-2 fw-semibold">Select Item Condition</label>
                                        <select name="condition" id="" class="form-select mb-2">
                                            <option value="">Select Item Condition</option>
                                            <option @if($item->condition == 'new' || old('condition') == 'new') selected @endif value="new">New</option>
                                            <option @if($item->condition == 'used' || old('condition') == 'used') selected @endif value="used">Used or Good Second Hand</option>
                                        </select>
                                        <label for="type" class="form-label my-2 fw-semibold">Select Item Type</label>
                                        <select name="type" id="" class="form-select mb-2">
                                            <option value="">Select Item Type</option>
                                            <option @if($item->type == 'sell' || old('type') == 'sell') selected @endif value="sell">For Sell</option>
                                            <option @if($item->type == 'buy' || old('type') == 'buy') selected @endif value="buy">For Buy</option>
                                            <option @if($item->type == 'exchange' || old('type') == 'exchange') selected @endif value="exchange">For Exchange</option>
                                        </select>
                                        <label for="itemImage" class="control-label  fw-semibold my-2">Item Photo*</label>
                                        <input type="file" name="itemImage" class="form-control mb-2 @error('itemImage') is-invalid @enderror">
                                        @error('itemImage')
                                            <span class="invalid-feedback">{{$message}}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <h5>Owner Information</h5>
                                    <hr class="mt-2 mb-3">
                                    <label for="ownerName" class="control-label fw-semibold mb-2">Owner Name*</label>
                                        <input value="{{old('ownerName',$item->owner_name)}}" id="cc-pament" name="ownerName" type="text"
                                            class="form-control mb-2 @error('ownerName') is-invalid @enderror"
                                            aria-required="true" aria-invalid="false" placeholder="Enter Owner Name...">
                                        @error('ownerName')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                        <label for="ownerNumber" class="control-label  fw-semibold my-2">Contact Number</label>
                                        <input id="cc-pament" name="ownerNumber" value="{{ old('ownerNumber',$item->number) }}" type="number"
                                            class="form-control mb-2 "
                                            aria-required="true" aria-invalid="false" placeholder="Enter Owner Phone Number...">
                                        <label for="ownerAddress" class="control-label fw-semibold my-2">Address</label>
                                        <textarea name="ownerAddress"  id="" cols="" rows="2" class="form-control mb-2 @error('ownerAddress') is-invalid @enderror" placeholder="Enter Owner Address...">{{old('ownerAddress',$item->address)}}</textarea>
                                        <div class="d-none">
                                           <input name="lat" value="{{old('lat',$item->lat)}}" type="text" id="latitude" />
                                            <input name="long" value="{{old('long',$item->long)}}" type="text" id="longitude" />
                                        </div>
                                        <label class="form-label">Select Location :</label>
                                        <div id="map" style="height: 400px;"></div>
                                        <div>
                                            <button type="submit" class="btn btn-lg w-100 mt-3 btn-info btn-block text-white"
                                                style="background-color: #0650bf;">
                                                <span id="payment-button-amount">Update</span>
                                                <i class="fa-solid fa-circle-right"></i>
                                            </button>
                                        </div>
                                    </div>
                            </div>


                            </form>

                    </div>
                </div>
            </div>
            <div class="col-lg-6 offset-3">

            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection

@section('script')
<script>
    @if (session('updateAlert'))
        Swal.fire({
            title: 'Item updated',
            text: "{{ session('updateAlert') }}",
            icon: 'success',
            showCancelButton: false,
            confirmButtonColor: '#0d6efd',
            cancelButtonColor: '#42b983',
            confirmButtonText: 'Go to List',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/admin/item/';
            }
        })
    @endif

    ClassicEditor
        .create( document.querySelector( '#itemDesc' ) )
        .catch( error => {
            console.error( error );
        } );

    //map picker

    $(document).ready(function () {
      // Default latitude and longitude
      var defaultLat = {{$lat}};
      var defaultLng = {{$long}};

      var map = L.map("map").setView([defaultLat, defaultLng], 13);

      L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 19,
      }).addTo(map);

      var marker = L.marker([defaultLat, defaultLng]).addTo(map);

      // Function to update the latitude and longitude inputs
      function updateLatLngInputs(latlng) {
        $("#latitude").val(latlng.lat);
        $("#longitude").val(latlng.lng);
      }

      // Event listener for when the user clicks on the map
      map.on("click", function (e) {
        var selectedLatLng = e.latlng;
        marker.setLatLng(selectedLatLng);
        updateLatLngInputs(selectedLatLng);
      });

      // Initialize inputs with default values
      updateLatLngInputs(marker.getLatLng());
    });
</script>
@endsection
