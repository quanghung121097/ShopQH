@extends('admins.layouts.master')
@section('content')
<div class="content container ">
    <h2 class="page-title">Danh mục sản phẩm</h2>
    <div class="row">
        <div class="col-md-12">
            <section class="widget">
                <header>
                    <h4>
                        Thêm <span class="fw-semi-bold">Danh mục</span>
                        <button type="button" class="btn btn-success addcategory" data-toggle="modal" data-target="#addcategory">
                            <i class="fa fa-user"></i>
                        </button>
                    </h4>

                </header>
                <div class="body listcategory">
                    <table class="table table-striped">
                        <thead>
                            <tr>


                                <th>Name</th>
                                <th>Danh mục cha</th>
                                <th>Ngày tạo</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody class="list_category">

                            @foreach($categories as $key => $category)
                            <tr>

                                <td>
                                    {{$category->name}}
                                </td>
                                <td>
                                    @if($category->parent_id==NULL)
                                    <i>Danh mục cha</i>
                                    @else
                                    @foreach($categories as $cate)
                                    @if($category->parent_id == $cate->id)
                                    <i>{{$cate->name}}</i>
                                    @endif
                                    @endforeach
                                    @endif
                                </td>
                                <td>
                                    {{$category->created_at}}
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success btnEditCategory" name="{{$category->id}}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-warning">
                                        <i class="fa fa-info"></i>
                                    </button>
                                    <button type="button" data-toggle="modal" data-target="#exampleModalCenter-{{$category->id}}" class="btn btn-danger  ">
                                        <i class="fa fa-ban"></i>
                                    </button>
                                    <div class="modal fade" id="exampleModalCenter-{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle" style="display: inline-block;">Xóa danh mục này</h5>
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

                                                        <button type="button" name="{{$category->id}}" class="btn btn-danger btnBanCategory">Đồng ý</button>
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

                        {!! $categories->links() !!}
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@include('admins.category.include.addCategory')
<div class="modal-category-edit">

</div>

@endsection
@section('js')
<script>
    $(document).ready(function() {
        $('.savecategory').on("click", function() {
            var formData = new FormData();
            formData.append('_token', $('input[name="_token"]').val());
            formData.append('name', $('input[name="name"]').val());
            formData.append('depth', $('input[name="depth"]').val());
            formData.append('parent_id', $('select[name="parent_id"]').val());
            formData.append('logo', $('input[type=file]')[0].files[0]);
            // var name = $('input[name="name"]').val();
            // var email = $('input[name="email"]').val();
            // var avatar = $('input[type=file]').val().split('\\').pop();
            $.ajax({
                type: "POST",
                url: "{{route('admin.category.store')}}",
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
        });

        function printErrorMsg(msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display', 'block');
            $.each(msg, function(key, value) {
                $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
            });
        }
        $('.btnEditCategory').on("click", function() {

            var id = $(this).attr('name');
            $.ajax({
                type: "GET",
                url: "http://127.0.0.1:8000/admin/categories/edit/" + id + "",
                success: function(data) {

                    $('.modal-category-edit').html(data)
                    $('#editCategoryModal').modal('show')
                    $('.updateCategory').on('click', function() {
                        var formData = new FormData();
                        formData.append('_token', $('input[name="_token"]').val());
                        formData.append('id', $('input[name="id"]').val());
                        formData.append('name', $('input[name="nameEdit"]').val());
                        formData.append('depth', $('input[name="depthEdit"]').val());
                        formData.append('parent_id', $('select[name="parent_idEdit"]').val());
                        formData.append('logo', $('input[type=file]')[1].files[0]);
                        $.ajax({
                            type: "POST",
                            url: "{{route('admin.category.update')}}",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                if ($.isEmptyObject(data.error)) {
                                    location.reload()

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
        // del
        $('.btnBanCategory').on('click', function() {
            var id = $(this).attr('name');
            var formData = new FormData();
            formData.append('_token', $('input[name="_token"]').val());
            formData.append('id', id);
            $.ajax({
                type: "POST",
                url: "{{route('admin.category.del')}}",
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
    });
</script>
@endsection