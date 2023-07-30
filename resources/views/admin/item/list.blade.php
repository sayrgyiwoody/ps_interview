@extends('admin.layout.master')

@section('title', 'Item List Page')


@section('header')
<form class="form-header" action="{{route('admin.item.list')}}" method="get">
    <input class="au-input au-input--xl" type="text" name="searchKey" value="{{request('searchKey')}}" placeholder="Search for item name..." />
    <button class="au-btn--submit" type="submit" >
        <i class="zmdi zmdi-search"></i>
    </button>
</form>
@endsection

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h5 class="title-1"><i class="fa-solid fa-border-all me-2"></i>Total : <span class="text-primary">{{$item->total()}}</span></h5>
                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('admin.item.createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add Items
                                </button>
                            </a>
                        </div>
                    </div>
                    @if ($item->total() !== 0)
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>No</th>
                                    <th>Item</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Owner</th>
                                    <th>Publish</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($item as $i)
                               <tr class="tr-shadow">
                                <td class="d-flex align-items-center">
                                    <div class="table-data-feature">

                                        <a href="{{route('admin.item.editPage',$i->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </a>
                                        <a href="{{route('admin.item.delete',$i->id)}}" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </a>

                                    </div>
                                </td>
                                <td class="item_id">{{$i->id}}</td>
                                <td>
                                    <span class="">{{$i->name}}</span>
                                </td>
                                <td class="desc">{{$i->category_name}}</td>
                                <td>{!!Str::words($i->desc,20,"....")!!}</td>
                                <td>
                                    <span class="status--process">$ {{$i->price}}</span>
                                </td>
                                <td>{{$i->owner_name}}</td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input status_switch" type="checkbox" role="switch"
                                            id="flexSwitchCheckDefault"
                                            @if ($i->publish_status) checked @endif>
                                    </div>
                                </td>
                            </tr>
                            <tr class="spacer"></tr>
                               @endforeach

                            </tbody>
                        </table>
                    </div>
                    @else
                        <div class="card card-body text-primary fw-semibold"><span><i class="fa-solid fa-circle-exclamation me-2"></i>There's no item to show.</span></div>
                    @endif
                    <!-- END DATA TABLE -->
                    <div class="mt-2">
                        {{$item->appends(request()->query())->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

@section('script')
    <script>
        @if (session('deleteAlert'))
            Swal.fire({
                title: 'Item deleted',
                text: "{{ session('deleteAlert') }}",
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#0d6efd',
                cancelButtonColor: '#42b983',
                confirmButtonText: 'Ok',
            })
        @endif

        $(document).ready(function() {
            $('.status_switch').change(function() {
                $parentNode = $(this).parents('.tr-shadow');
                $item_id = Number($parentNode.find('.item_id').text());
                $item_status = $(this).prop('checked') ? 1 : 0;


                $.ajax({
                    type: 'post',
                    url: '{{route('admin.item.changeStatus')}}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        item_id: $item_id,
                        item_status : $item_status
                    },
                    dataType: 'json',
                    success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title : 'Changed',
                                text: 'Publish status changed successfully.',
                                showConfirmButton: true,
                            })
                    }
                });


            })
        })
    </script>
@endsection



