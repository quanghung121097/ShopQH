<div class="modal fade" id="addcategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger print-error-msg" style="display:none; color:black">
                    <ul></ul>
                </div>
                <form role="form" method="post" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" class="form-control" id="" placeholder="Điền tên danh mục " name="name">

                        </div>
                        <div class="form-group">
                            <label>Danh mục cha</label>
                            <select class="form-control select2" style="width: 100%;" name="parent_id">
                                <option value="">--Danh mục cha---</option>
                                @foreach ($categories as $cate)
                                <option value="{{$cate->id}}">{{$cate->name}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Logo: </label>
                            <div class="input-group" style="margin-top: 20px">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="logo" multiple>
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>

                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">Upload</span>
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <label>Depth</label>
                            <input type="number" class="form-control" id="" placeholder="" name="depth">
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-danger">Huỷ bỏ</button>
                        <button type="button" class="btn btn-success savecategory">Tạo mới</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>