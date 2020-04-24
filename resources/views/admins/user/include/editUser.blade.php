<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body body-edit">
                <form role="form" method="post" action="" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="PUT">
                    <div class="card-body">
                        <div class="form-group">

                            <input type="hidden" name="id" class="form-control" id="" placeholder="Điền tên sản phẩm" value="{{$userEdit->id}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên user</label>
                            <input type="text" name="nameEdit" class="form-control" id="" placeholder="Điền tên user" value="{{$userEdit->name}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Address</label>
                            <input type="text" name="address" class="form-control" id="" placeholder="Điền địa chỉ" value="{{$userEdit->address}}">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Avatar: </label>
                            <img src="/{{$userEdit->avatar}}" width="100px" height="100px">
                            <div class="input-group" style="margin-top: 20px">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="avatar" multiple>


                                </div>


                            </div>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số điện thoại</label>
                            <input type="text" name="phoneEdit" class="form-control" id="" placeholder="Số điện thoại" value="{{$userEdit->phone}}">

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="password" name="passwordEdit" class="form-control" id="" placeholder="">

                        </div>




                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <a data-dismiss="modal" class="btn btn-danger">Huỷ bỏ</a>
                        <button type="button" class="btn btn-success updateUser">Update</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>