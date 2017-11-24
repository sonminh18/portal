<?php
/**
 * Created by PhpStorm.
 * User: Son Minh
 * Date: 11/23/2017
 * Time: 4:21 PM
 */
?>
<style>
    .product
    {
        float: left;
        width: 220px;
        height: 110px;
        margin: 0;
        padding: 32px;
        cursor: pointer;
    }
    .product img
    {
        float: left;
        width: 110px;
        height: 110px;
    }
    .product h3
    {
        margin: 0;
        padding: 10px 0 0 10px;
        font-size: .9em;
        overflow: hidden;
        font-weight: normal;
        float: left;
        max-width: 100px;
        text-transform: uppercase;
    }
    .product h4
    {
        margin: 0;
        padding: 10px 0 0 10px;
        font-size: .9em;
        overflow: hidden;
        font-weight: normal;
        float: left;
        max-width: 100px;
        text-transform: uppercase;
    }
    .product h5
    {
        margin: 0;
        padding: 10px 0 0 10px;
        font-size: .9em;
        overflow: hidden;
        font-weight: normal;
        float: left;
        max-width: 100px;
        text-transform: uppercase;
    }
    .k-pager-wrap
    {
        border-top: 0;
    }
    .demo-section .k-listview:after
    {
        content: ".";
        display: block;
        height: 0;
        clear: both;
        visibility: hidden;
    }
</style>
<div class="tabbable">
    <ul class="nav nav-tabs nav-tabs-bottom">
        <li class="active"><a href="#bottom-tab1" data-toggle="tab">Upload hình</a></li>
        <li><a id="thuvienhinh" href="#bottom-tab2" data-toggle="tab">Thư viện hình</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="bottom-tab1">
            <div class="form-group">
                <div class="col-lg-12">
                    <form id="imageuploader" enctype="multipart/form-data">
                        <input type="file" name="imageposts" id="imageposts" class="file-input-ajax" multiple="multiple">
                        <span class="help-block" style="color: red">Bạn chỉ được chọn tối đa 5 file để upload cùng 1 lúc.</span>
                    </form>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="bottom-tab2">
            <div class="demo-section k-content wide">
                <div id="listView"></div>
                <div id="pager" class="k-pager-wrap"></div>
                <script type="text/x-kendo-tmpl" id="template">
                    <div class="product">
                        <img src="#:vUrl#" alt="#:vName#"/>
                        <h3>#:vName#</h3>
                        <h4>#:vKichThuoc#</h4>
                        <h5>#:vDungLuong#</h5>
                    </div>
                </script>
            </div>
        </div>
    </div>
</div>