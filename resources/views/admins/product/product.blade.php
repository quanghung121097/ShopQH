@extends('admins.layouts.master')
@section('css')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
@endsection
@section('content')
<div class="content container ">
    <h2 class="page-title">Thông tin sản phẩm</h2>
    <div class="row">
        <div class="col-md-12">
            <section class="widget">
                <header>
                    <h4>
                        Thêm <span class="fw-semi-bold">Sản phẩm</span>
                        <button type="button" class="btn btn-success " id="modaladdproduct">
                            <i class="fa fa-user"></i>
                        </button>

                    </h4>

                </header>
                <div class="body listproduct">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Id sản phẩm</th>
                                <th>Name</th>
                                <th>Giá bán</th>
                                <th>Số lượng</th>
                                <th>Đã bán</th>
                                <th>Trạng thái</th>
                                <th>Ngày tạo</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody class="list_product">

                            @foreach($products as $key => $product)
                            <tr>
                                <td>
                                    {{$product->id}}
                                </td>
                                <td>
                                    {{$product->name}}
                                </td>
                                <td>
                                    {{$product->sale_price}}
                                </td>
                                <td>
                                    {{$product->quantity}}
                                </td>
                                <td>
                                    {{$product->sold}}
                                </td>
                                <td>
                                    @if($product->status==1)
                                    <i>Còn hàng</i>
                                    @else
                                    <i>Hết hàng</i>
                                    @endif
                                </td>
                                <td>
                                    {{$product->created_at}}
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success btnEditProduct" name="{{$product->id}}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-warning editImg" name="{{$product->slug}}">
                                        <i class="fa fa-camera"></i>
                                    </button>

                                    <button type="button" data-toggle="modal" data-target="#exampleModalCenter-{{$product->id}}" class="btn btn-danger  ">
                                        <i class="fa fa-ban"></i>
                                    </button>
                                    <div class="modal fade" id="exampleModalCenter-{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle" style="display: inline-block;">Bạn có chắc chắn xóa ko?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <h4>Bạn chắc chắn muốn xóa?</h4>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <form style="display: inline-block;" action="" method="post" accept-charset="utf-8">
                                                        @csrf

                                                        <button type="button" name="{{$product->id}}" class="btn btn-danger btnBanProduct">Đồng ý</button>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                    <div class="clearfix">

                        {!! $products->links() !!}
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<div class="modal-product-add">

</div>
<div class="modal-product-edit">

</div>
@include('admins.product.include.imageProduct')
@endsection
@section('js')
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<script>
    $(document).ready(function() {
        // add new product
        $('#modaladdproduct').on("click", function() {
            $.ajax({
                type: "GET",
                url: "{{route('admin.product.create')}}",
                success: function(data) {

                    $('.modal-product-add').html(data);
                    CKEDITOR.replace('content');
                    $('.saveproduct').on("click", function() {
                        var formData = new FormData();
                        var dataContent = CKEDITOR.instances.content.getData();
                        formData.append('_token', $('input[name="_token"]').val());
                        formData.append('name', $('input[name="name"]').val());
                        formData.append('quantity', $('input[name="quantity"]').val());
                        formData.append('origin_price', $('input[name="origin_price"]').val());
                        formData.append('sale_price', $('input[name="sale_price"]').val());
                        formData.append('content', dataContent);
                        formData.append('category_id', $('select[name="category_id"]').val());
                        formData.append('status', $('select[name="status"]').val());
                        var imageAdd = document.getElementById('multiFiles').files.length;
                        for (var x = 0; x < imageAdd; x++) {
                            formData.append("images[]", document.getElementById('multiFiles').files[x]);
                        }
                        $.ajax({
                            type: "POST",
                            url: "{{route('admin.product.store')}}",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                if ($.isEmptyObject(data.error)) {
                                    alert('ok');
                                } else {
                                    printErrorMsg(data.error);
                                }

                            },
                            error: function(error) {
                                alert('lỗi')
                            }
                        });
                    });


                    $('#addproduct').modal('show');

                }
            });

        });

        function printErrorMsg(msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display', 'block');
            $.each(msg, function(key, value) {
                $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
            });
        }
        // edit product
        $('.btnEditProduct').on("click", function() {

            var id = $(this).attr('name');
            $.ajax({
                type: "GET",
                url: "http://127.0.0.1:8000/admin/products/edit/" + id + "",
                success: function(data) {

                    $('.modal-product-edit').html(data)
                    CKEDITOR.replace('contentEdit');
                    $('#editProductModal').modal('show')
                    $('.updateProduct').on('click', function() {
                        var dataContentEdit = CKEDITOR.instances.contentEdit.getData();
                        var formData = new FormData();
                        formData.append('_token', $('input[name="_token"]').val());
                        formData.append('id', $('input[name="id"]').val());
                        formData.append('name', $('input[name="nameEdit"]').val());
                        formData.append('sale_price', $('input[name="sale_priceEdit"]').val());
                        formData.append('origin_price', $('input[name="origin_priceEdit"]').val());
                        formData.append('status', $('select[name="statusEdit"]').val());
                        formData.append('category_id', $('select[name="category_idEdit"]').val());
                        formData.append('content', dataContentEdit);
                        formData.append('sold', $('input[name="sold"]').val());
                        formData.append('quantity', $('input[name="quantityNew"]').val());
                        $.ajax({
                            type: "POST",
                            url: "{{route('admin.product.update')}}",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                if ($.isEmptyObject(data.error)) {
                                    location.reload();

                                } else {
                                    printErrorMsg(data.error);
                                }


                            },
                            error: function(error) {
                                alert('lỗi')
                            }
                        });
                    })
                }
            });
        });


        // del product
        $('.btnBanProduct').on('click', function() {
            var id = $(this).attr('name');
            var formData = new FormData();
            formData.append('_token', $('input[name="_token"]').val());
            formData.append('id', id);
            $.ajax({
                type: "POST",
                url: "{{route('admin.product.del')}}",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    location.reload();

                },
                error: function(error) {
                    alert('lỗi')
                }
            });
        })
        // edit img product
        $('.editImg').on('click', function() {

            var slugProduct = $(this).attr('name');
            $.ajax({
                type: "GET",
                url: "http://127.0.0.1:8000/admin/images/" + slugProduct + "",
                success: function(datatheme) {
                    $('.listTheme').html(datatheme);
                    $('.addNewImg').click(function() {

                        var formData = new FormData();
                        var imageAddNew = document.getElementById('AddmultiFiles').files.length;
                        formData.append('_token', $('input[name="_token"]').val());
                        formData.append('id', $('input[name="idproduct"]').val());
                        for (var i = 0; i < imageAddNew; i++) {
                            formData.append("images[]", document.getElementById('AddmultiFiles').files[i]);
                        }
                        $.ajax({
                            type: "POST",
                            url: "{{route('admin.image.uploadImgProduct')}}",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                if ($.isEmptyObject(data.error)) {
                                    $.ajax({
                                        type: "GET",
                                        url: "http://127.0.0.1:8000/admin/images/" + slugProduct + "",
                                        success: function(datatheme) {
                                            $('.listTheme').html(datatheme);
                                        }
                                    });
                                } else {
                                    printErrorMsg(data.error);
                                }

                            },
                            error: function(error) {
                                alert('lỗi')
                            }
                        });
                    });
                }
            });
            $('#imgEditModal').modal('show');

        })
    });
</script>
@endsection