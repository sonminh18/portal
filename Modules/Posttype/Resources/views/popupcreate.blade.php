<?php
/**
 * Created by PhpStorm.
 * User: Son Minh
 * Date: 11/27/2017
 * Time: 3:59 PM
 */
?>
<style>
    .modal-open .modal {
        display: flex !important;
        align-items: center;
        justify-content: center;
    }
</style>
<form action="#" id="formsave">
    <div class="modal-body">
        <div class="form-group">
            <div class="row">
                <div class="col-sm-12">
                    <label>Danh Mục Cha:</label>
                    <select class="select-border-color border-warning" id="iCapCha" required data-required-msg="Vui lòng chọn danh mục cha">
                        <option value="0">Không có</option>
                        @foreach($posttype as $item)
                            <option value="{{$item['iMaLoaiBaiViet']}}">{!! $item['vTenLoaiBaiViet'] !!}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row" style="margin-top: 15px">
                <div class="col-sm-12">
                    <label>Tên loại danh mục:</label>
                    <input type="text" placeholder="Nhập tên loại" class="form-control" value="" name="vTenLoaiBaiViet" id="vTenLoaiBaiViet">
                </div>
            </div>
        </div>
    </div>
</form>
