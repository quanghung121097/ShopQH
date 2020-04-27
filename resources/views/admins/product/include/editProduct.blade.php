<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sửa thông tin sản phẩm</h5>
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

                            <input type="hidden" name="id" class="form-control" id="" placeholder="Điền tên sản phẩm" value="{{$product->id}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Thêm số lượng</label>
                            <input type="text" name="quantityNew" class="form-control" id="" value="0">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Đã bán</label>
                            <input type="text" name="sold" class="form-control" id="" value="0">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" name="nameEdit" class="form-control" id="product_name" placeholder="Điền tên sản phẩm" value="{{$product->name}}">
                        </div>
                        <div class="form-group">
                            <label>Danh mục sản phẩm</label>
                            <select name="category_idEdit" class="form-control select2" style="width: 100%;">
                                <option>--Chọn danh mục---</option>
                                @foreach($categoriesEdit as $category)
                                <option value="{{ $category->id }}" @if($product->category_id==$category->id) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Giá gốc</label>
                                    <input type="text" name="origin_priceEdit" class="form-control" placeholder="Điền giá gốc" value="{{$product->origin_price}}">
                                </div>
                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Giá bán</label>
                                    <input type="text" name="sale_priceEdit" class="form-control" placeholder="Điền giá gốc" value="{{$product->sale_price}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mô tả sản phẩm</label>
                            <input type="text" name="contentEdit" >
                        </div>
                        
                        <div class="form-group">
                            <label>Trạng thái sản phẩm</label>
                            <select name="statusEdit" class="form-control select2" style="width: 100%;">
                                <option>--Chọn trạng thái---</option>
                                <option value="0" @if($product->status==0) selected @endif>Đang nhập</option>
                                <option value="1" @if($product->status==1) selected @endif>Mở bán</option>
                                <option value="-1" @if($product->status==-1) selected @endif>Hết hàng</option>
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-danger">Huỷ bỏ</button>
                        <button type="button" class="btn btn-success updateProduct">Update</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>