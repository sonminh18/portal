<?php
/**
 * Created by PhpStorm.
 * User: Son Minh
 * Date: 11/23/2017
 * Time: 11:05 AM
 */
?>
<style>
    .modal-open .modal {
        display: flex !important;
        align-items: center;
        justify-content: center;
    }
</style>
<form action="#" id="formupdate">
    <div class="modal-body">
        <div class="form-group">
            <div class="row">
                <div class="col-sm-12">
                    <label>Danh Mục Cha:</label>
                    <select class="select-border-color border-warning" id="iCapCha" required data-required-msg="Vui lòng chọn danh mục cha">
                        <option value="0">Không có</option>
                        @foreach($MenuCapCha as $item)
                            @if($item['Selected'] == 1)
                                <option value="{{$item['iMaLoaiBaiViet']}}" selected>{!! $item['vTenLoaiBaiViet'] !!}</option>
                            @else
                                <option value="{{$item['iMaLoaiBaiViet']}}">{!! $item['vTenLoaiBaiViet'] !!}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row" style="margin-top: 15px">
                <div class="col-sm-12">
                    <label>Tên loại danh mục:</label>
                    <input type="text" placeholder="Nhập tên loại" class="form-control" value="{{$posttypeselected['vTenLoaiBaiViet']}}" name="vTenLoaiBaiViet" id="vTenLoaiBaiViet">
                </div>
            </div>
        </div>
    </div>
</form>