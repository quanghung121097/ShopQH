<div class="col-12" style="margin-top: 20px">
    <center>
    <form role="form" method="post" action="" enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="{{$productAddImg->id}}" name="idproduct">
        <div class="form-group">
            <label for="multiFiles">Thêm hình ảnh</label>
            <div class="input-group">
                <div class="custom-file">

                    <input type="file" class="btn btn-success" id="AddmultiFiles" name="addimages[]" multiple>


                </div>
            </div>
        </div>
        <button type="button" class="btn btn-primary addNewImg">Upload ảnh</button>
    </form>
    <div class="alert alert-danger print-error-msg" style="display:none; color:black">
        <ul></ul>
    </div>
    </center>
</div>
@if(isset($images))
@foreach($images as $img)
<div class="itemTheme col-md-3" id="theme{{$img->id}}">
    <img id="{{$img->name}}" class="" src="/{{$img->path}}" alt="">
</div>
@endforeach
@endif