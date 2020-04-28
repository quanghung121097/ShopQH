<div class="col-12" style=" padding-top: 20px ;background-color: #F2F2F2;padding-left: 11px;padding-bottom: 20px;">

    <div class="alert alert-danger print-error-msg" style="display:none; color:black">
        <ul></ul>
    </div>
    <form role="form" method="post" action="" enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="{{$productAddImg->id}}" name="idproduct">
        <div class="form-group">
            <div class="input-group">
                <div class="custom-file">

                    <input type="file" class="btn btn-success" id="AddmultiFiles" name="addimages[]" multiple>


                </div>
            </div>
        </div>
        <button type="button" class="btn btn-primary addNewImg" name="{{$productAddImg->slug}}">Upload ảnh</button>
    </form>
</div>
<style>
    .form-del-img {
        position: absolute;
        top: 0;
        right: 0;
        border-radius: 50%;
        font-size: 20px;
        color: red;
    }
</style>
@if(isset($images))
@foreach($images as $img)

<div class="itemTheme col-md-3" id="theme{{$img->id}}">
    <i class="fa fa-ban form-del-img " data-toggle="modal" data-target="#exampleModalCenter-{{$img->id}}"></i>
    <div class="modal fade" id="exampleModalCenter-{{$img->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle" style="display: inline-block;">Bạn có chắc chắn xóa ko?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4>Hình ảnh sẽ bị xóa vĩnh viễn?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    <form style="display: inline-block;" action="" method="post" accept-charset="utf-8">
                        @csrf
                        <input type="hidden" value="{{$img->name}}" name="nameimg">
                        <input type="hidden" value="{{$productAddImg->slug}}" name="slugProduct">
                        <button type="button" name="{{$img->id}}" class="btn btn-danger btn-BanImgProduct">Đồng ý</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <img id="{{$img->name}}" class="" src="/{{$img->path}}" alt="">
</div>
@endforeach
@endif
<script>
    $(document).ready(function() {
        function ErrorMsg(msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display', 'block');
            $.each(msg, function(key, value) {
                $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
            });
        }
        $('.addNewImg').click(function() {
            var slugProductEdit = $(this).attr('name');
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
                            url: "http://127.0.0.1:8000/admin/images/" + slugProductEdit + "",
                            success: function(datatheme) {
                                $('.listTheme').html(datatheme);
                            }
                        });
                    } else {
                        ErrorMsg(data.error);
                    }

                },
                error: function(error) {
                    alert('lỗi')
                }
            });
        });
        $('.btn-BanImgProduct').on('click', function() {
            var slugProductBan = name = $('input[name="slugProduct"]').val();
            var id = $(this).attr('name');
            var formData = new FormData();
            formData.append('_token', $('input[name="_token"]').val());
            formData.append('name', $('input[name="nameimg"]').val());
            formData.append('id', id);
            $.ajax({
                type: "POST",
                url: "{{route('admin.image.del')}}",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    $.ajax({
                        type: "GET",
                        url: "http://127.0.0.1:8000/admin/images/" + slugProductBan + "",
                        success: function(datatheme) {
                            $('.listTheme').html(datatheme);
                        }
                    });

                },
                error: function(error) {
                    alert('lỗi')
                }
            });
        })
    });
</script>