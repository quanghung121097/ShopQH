<div class="modal fade" id="adduser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <form role="form" method="post" action="{{route('admin.user.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên</label>
                            <input type="text" class="form-control" id="" placeholder="Tên người dùng" name="name" value="{{old('name')}}">
                            @error('name')
                            <br>
                            <div class="" style="color: red;">* {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Avatar</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="avatar" multiple>
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>

                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">Upload</span>
                                </div>

                            </div>

                            @error('avatar')
                            <br>
                            <div class="" style="color: red;">* {{ $message }}</div>
                            @enderror
                            {{-- @error('images.*')
                                <br><div class="" style="color: red;">* {{ $message }}
                        </div>
                        @enderror --}}
                        {{-- @if(isset($info_img))
                                @foreach($info_img as $info)
                                <img src="/storage/{{$info}}" alt="">
                        @endforeach
                        @endif --}}
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" id="" placeholder="Email" name="email" value="{{old('email')}}">
                        @error('email')
                        <br>
                        <div class="" style="color: red;">* {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Mật khẩu</label>
                        <input type="password" class="form-control" id="" name="password">
                        @error('password')
                        <br>
                        <div class="" style="color: red;">* {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Số điện thoại</label>
                        <input type="number" class="form-control" name="phone" id="" value="{{old('phone')}}">
                        @error('phone')
                        <br>
                        <div class="" style="color: red;">* {{ $message }}</div>
                        @enderror
                    </div>
                    <!-- <div class="form-group">
                                <label>Quyền</label>
                                <select class="form-control select2" style="width: 100%;" name="role">
                                    <option>--Chọn quyền---</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Khách hàng</option>
                                </select>
                                @error('role')
                                <br><div class="" style="color: red;">* {{ $message }}</div>
                                @enderror
                            </div> -->
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="button" data-dismiss="modal" class="btn btn-danger">Huỷ bỏ</button>
                <button type="button" class="btn btn-success saveuser">Tạo mới</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
