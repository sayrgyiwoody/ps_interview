@extends('admin.layout.master')

@section('title','Category Create Page')

@section('header')

<h3>Category Edit Page</h3>

@endsection

@section('content')
 <!-- MAIN CONTENT-->
 <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{route('admin.category.list')}}"><button class="btn bg-primary text-white my-3">List</button></a>
                </div>
            </div>
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Edit Category</h3>
                        </div>
                        <hr>
                        <form action="{{route('admin.category.edit',$category->id)}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="categoryName" class="control-label mb-1">Name*</label>
                                <input value="{{old('categoryName',$category->name)}}" id="cc-pament" name="categoryName" type="text" class="form-control mb-2 @error('categoryName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Category...">
                                @error('categoryName')
                                    <span class="invalid-feedback">{{$message}}</span>
                                @enderror
                                <label for="categoryImage" class="control-label mb-1">Photo*</label>
                                <input id="cc-pament" name="categoryImage" type="file" class="form-control mb-2 @error('categoryImage') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Category...">
                                @error('categoryImage')
                                    <span class="invalid-feedback">{{$message}}</span>
                                @enderror

                            </div>
                            <div>
                                <button type="submit" class="btn btn-lg w-100 mt-3 btn-info btn-block text-white" style="background-color: #002d72;">
                                    <span id="payment-button-amount">Update</span>
                                    <i class="fa-solid fa-circle-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection

@section('script')
<script>
     @if(session('updateAlert'))
        Swal.fire({
        title: 'Category edited',
        text: "{{ session('updateAlert') }}",
        icon: 'success',
        showCancelButton: false,
        confirmButtonColor: '#0d6efd',
        confirmButtonText: 'Go to List',
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href='/admin/category/';
        }
        })
    @endif
</script>
@endsection
