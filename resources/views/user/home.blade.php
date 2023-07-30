@extends('user.layout.master')

@section('content')
<!-- Shop Sidebar Start -->
<div class="col-lg-3 col-md-4">
    <!-- Price Start -->
    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by</span></h5>
    <div class="bg-light p-4 mb-30">
        <form action="{{route('user.filter')}}" method="post">
            @csrf
            <label for="priceRange" class="form-label mb-2">Price Range :</label>
            <div class="form-row mb-3">
                <div class="col">
                    <input value="{{request('min_price')}}" name="min_price"  type="number" min="0" class="form-control" placeholder="min">
                </div>
                <div class="col">
                    <input value="{{request('max_price')}}" name="max_price"  type="number" min="0" class="form-control" placeholder="max">
                </div>
            </div>

            <label for="condition" class="form-label mb-2">Item Condition :</label>
            <select name="condition" id="" class="form-select mb-3">
                <option value="">Select Item Condition</option>
                <option value="new">New</option>
                <option value="used">Used or Good Second Hand</option>
            </select>
            <label for="type" class="form-label mb-2">Item Type</label>
            <select name="type" id="" class="form-select mb-3">
                <option value="">Select Item Type</option>
                <option value="sell">For Sell</option>
                <option value="buy">For Buy</option>
                <option value="exchange">For Exchange</option>
            </select>
            <button class="btn btn-primary w-100 rounded mt-1" type="submit"><i class="fa-solid fa-sliders me-2"></i>Apply Filter</button>
        </form>
    </div>
    <!-- Price End -->



    <!-- Size End -->
</div>
<!-- Shop Sidebar End -->

<div class="col-lg-9 col-md-8">
    <div class="row pb-3">
        <div class="col-12 pb-1">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                    <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                </div>
                <div class="ml-2">
                    <form action="{{route('user.home')}}" class="d-flex">
                    <input type="text" value="{{request('searchKey')}}" name="searchKey" class="form-control" placeholder="Search Item name ...">
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
            </div>
        </div>

        @if ($item->total()!==0)
        @foreach ($item as $i)
        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
            <div class="product-item bg-light mb-4">
                <div class="product-img position-relative overflow-hidden">
                    <img class="img-fluid w-100" src="{{asset('storage/itemImages/'.$i->image)}}" alt="">
                    <div class="product-action">
                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                        <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                        <a class="btn btn-outline-dark btn-square" href="{{route('user.detail',$i->id)}}"><i class="fa-solid fa-circle-info"></i></a>
                    </div>
                </div>
                <div class="py-4 px-3">
                    <a class="h6 text-decoration-none text-truncate" href="{{route('user.detail',$i->id)}}">{{$i->name}}</a>
                    <p class="text-success my-1">$ {{$i->price}}</p>
                    <div class="d-flex mt-2 align-items-center">
                        <img class="rounded-circle me-2" width="40" src="https://ui-avatars.com/api/?name={{$i->owner_name}}" alt="">
                        <p class="my-0" class="mt-4 ms-2">{{$i->owner_name}}</p><br>
                    </div>
                </div>
            </div>
        </div>

        @endforeach

        @else

        <div class="card card-body">
            <span class="text-info"><i class="fa-solid fa-circle-info me-2 "></i>There's no item to show.</span>
        </div>

        @endif
        <div class="mt-2">
            {{$item->appends(request()->query())->links()}}
        </div>
    </div>
</div>
@endsection
