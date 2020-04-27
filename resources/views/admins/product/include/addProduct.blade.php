<div class="modal fade hide-modal-add-product" id="addproduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger print-error-msg" style="display:none; color:black">
                    <ul></ul>
                </div>
                <form role="form" method="post" action="" enctype="multipart/form-data" >
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" name="name" class="form-control" id="" placeholder="Điền tên sản phẩm" value="{{old('name')}}">
                        </div>
                        <div class="form-group">
                            <label>Danh mục sản phẩm</label>
                            <select name="category_id" class="form-control select2" style="width: 100%;">
                                <option>--Chọn danh mục---</option>
                                @foreach($categoriesAdd as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số lượng</label>
                            <input type="text" name="quantity" class="form-control" id="">
                        </div>
                        <div class="form-group">
                            <label>Giá gốc</label>
                            <input type="text" name="origin_price" class="form-control" placeholder="Điền giá gốc" value="{{old('origin_price')}}">
                        </div>
                        <div class="form-group">
                            <label>Giá bán</label>
                            <input type="text" name="sale_price" class="form-control" placeholder="Điền giá gốc" value="{{old('sale_price')}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mô tả sản phẩm</label>
                            <!-- <textarea name="content"></textarea> -->
                            <input type="text" name="content" >
                        
                        </div>
                        <div class="form-group">
                            <label for="multiFiles">Hình ảnh sản phẩm</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="multiFiles" name="images[]" multiple>
                                    <label class="custom-file-label" for="multiFiles">Choose file</label>

                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label>Trạng thái sản phẩm</label>
                            <select name="status" class="form-control select2" style="width: 100%;">
                                <option>--Chọn trạng thái---</option>
                                <option value="0">Đang nhập</option>
                                <option value="1">Mở bán</option>
                                <option value="-1">Hết hàng</option>
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-danger closemodalAdd">Huỷ bỏ</button>
                        <button type="button" class="btn btn-success saveproduct">Tạo mới</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
