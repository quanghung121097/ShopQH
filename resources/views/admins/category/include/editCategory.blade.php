<div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sửa thông tin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body body-edit">
                <div class="alert alert-danger print-error-msg" style="display:none; color:black">
                    <ul></ul>
                </div>
                <form role="form" method="post" action="" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="PUT">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên category</label>
                            <input type="text" name="nameEdit" class="form-control" id="" placeholder="Điền tên category" value="{{$categoryEdit->name}}">
                            <input type="hidden" name="id" class="form-control" id="" value="{{$categoryEdit->id}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Depth</label>
                            <input type="text" name="depthEdit" class="form-control" id="" placeholder="" value="{{$categoryEdit->depth}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Logo: </label>
                            <img src="/{{$categoryEdit->logo}}" width="100px" height="100px">
                            <div class="input-group" style="margin-top: 20px">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="logo" multiple>

                                </div>


                            </div>


                        </div>
                        <div class="form-group">
                            <label>Danh mục cha</label>
                            <select name="parent_idEdit" class="form-control select2" style="width: 100%;">
                                <option value="" @if($categoryEdit->parenr_id==NULL) selected @endif>--Danh mục cha---</option>

                                @foreach($categories as $cate)

                                <option value="{{$cate->id}}" @if($categoryEdit->parent_id==$cate->id) selected @endif @if($categoryEdit->id==$cate->id)
                                    disabled
                                    @endif>{{$cate->name}}</option>
                                @endforeach
                            </select>
                        </div>


                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="button" class="btn btn-success updateCategory">Update mới</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>