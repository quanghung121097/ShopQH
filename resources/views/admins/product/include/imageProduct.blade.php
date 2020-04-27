<style>
    .itemTheme {
        margin-left: 2%;
        margin-right: 2%;
        margin-top: 2%;
        margin-bottom: 2%;
        display: flex;
        background-color: #FAFAFA;
        border-radius: 3px;
        border: 1px solid #FAFAFA;
        color: #848484;
        display: flex;
        align-items: center;
        height: 150px;
    }

    .itemTheme:hover {
        background-color: #58ACFA;
        color: white;
        cursor: pointer;
        border: 2px solid #2E9AFE;

    }

    .itemTheme img {


        height: 90%;

    }



    .listTheme {
        height: 400px;
        overflow-y: auto;
        width: 99%;
        background-color: white;
    }

    .titleTheme {
        width: 99%;
        background-color: #F2F2F2;
        color: #58ACFA;
        padding-left: 2%;
        padding-top: 10px;
        padding-bottom: 10px;
        cursor: pointer;
    }

    .theme-all {
        width: 100%;
        background-color: #FAFAFA;
        position: relative;
        padding-left: 5%;
        padding-top: 1%;
        padding-bottom: 3%;
    }
</style>

<div class="modal fade" id="imgEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-body">
                <div class="theme-all">
                    <div class="titleTheme row"><span>Hình ảnh sản phẩm</span></div>

                    <div class="listTheme row">

                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-danger">Xóa hình ảnh</button>
                <div><i class=""></i></div>
            </div>
        </div>
    </div>
</div>