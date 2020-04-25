@extends('admins.layouts.master')
@section('content')
<div class="content container ">
    <h2 class="page-title">Dashboard <small>Statistics and more</small></h2>
    <div class="row">
        <div class="col-md-12">
            <section class="widget">
                <header>
                    <h4>
                        Bảng <span class="fw-semi-bold">Khách Hàng</span>
                        <button type="button" class="btn btn-success adduser" data-toggle="modal" data-target="#adduser">
                            <i class="fa fa-user"></i>
                        </button>
                    </h4>

                </header>
                <div class="body listuser">
                    <table class="table table-striped">
                        <thead>
                            <tr>


                                <th>Name</th>
                                <th>Email</th>
                                <th>Ngày tạo</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody class="list_user">

                            @foreach($users as $key => $user)
                            <tr>

                                <td>
                                    {{$user->name}}
                                </td>
                                <td>
                                    {{$user->email}}
                                </td>
                                <td>
                                    {{$user->created_at}}
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success btnEditUser" name="{{$user->id}}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-warning">
                                        <i class="fa fa-info"></i>
                                    </button>
                                    <button type="button" data-toggle="modal" data-target="#exampleModalCenter-{{$user->id}}" class="btn btn-danger  ">
                                        <i class="fa fa-ban"></i>
                                    </button>
                                    <div class="modal fade" id="exampleModalCenter-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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

                                                        <button type="button" name="{{$user->id}}" class="btn btn-danger btnBanUser">Đồng ý</button>
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

                        {!! $users->links() !!}
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@include('admins.user.include.addUser')
<div class="modal-user-edit">

</div>

@endsection
@section('js')
<script>
    $(document).ready(function() {
        $('.saveuser').on("click", function() {
            var formData = new FormData();
            formData.append('_token', $('input[name="_token"]').val());
            formData.append('name', $('input[name="name"]').val());
            formData.append('phone', $('input[name="phone"]').val());
            formData.append('email', $('input[name="email"]').val());
            formData.append('password', $('input[name="password"]').val());
            formData.append('avatar', $('input[type=file]')[0].files[0]);
            var name = $('input[name="name"]').val();
            var email = $('input[name="email"]').val();
            var avatar = $('input[type=file]').val().split('\\').pop();
            $.ajax({
                type: "POST",
                url: "{{route('admin.user.store')}}",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        $.ajax({
                            type: "GET",
                            url: "{{route('admin.user.index')}}",
                            success: function(data) {
                                $('.list_user').prepend('<tr><td>' + name + '</td><td>' + email + '</td><td>Vừa xong</td><td><button type="button" class="btn btn-success"><i class="fa fa-edit"></i> </button><button type="button" class="btn btn-warning"><i class="fa fa-info"></i> </button><button type="button" class="btn btn-danger"><i class="fa fa-ban"></i></button></td></tr>')
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

        function printErrorMsg(msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display', 'block');
            $.each(msg, function(key, value) {
                $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
            });
        }
        // edit
        $('.btnEditUser').on("click", function() {

            var id = $(this).attr('name');
            $.ajax({
                type: "GET",
                url: "http://127.0.0.1:8000/admin/users/edit/" + id + "",
                success: function(data) {

                    $('.modal-user-edit').html(data)
                    $('#editModal').modal('show')
                    $('.updateUser').on('click', function() {
                        var formData = new FormData();
                        formData.append('_token', $('input[name="_token"]').val());
                        formData.append('id', $('input[name="id"]').val());
                        formData.append('name', $('input[name="nameEdit"]').val());
                        formData.append('phone', $('input[name="phoneEdit"]').val());
                        formData.append('address', $('input[name="addressEdit"]').val());
                        formData.append('avatar', $('input[type=file]')[1].files[0]);
                        $.ajax({
                            type: "POST",
                            url: "{{route('admin.user.update')}}",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                if ($.isEmptyObject(data.error)) {
                                    $.ajax({
                                        type: "GET",
                                        url: "{{route('admin.user.index')}}",
                                        success: function(data) {
                                            location.reload();
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
                    })
                }
            });
        });
        // del
        $('.btnBanUser').on('click', function() {
            var id = $(this).attr('name');
            var formData = new FormData();
            formData.append('_token', $('input[name="_token"]').val());
            formData.append('id', id);
            $.ajax({
                type: "POST",
                url: "{{route('admin.user.del')}}",
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