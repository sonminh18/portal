<?php
/**
 * Created by PhpStorm.
 * User: Son Minh
 * Date: 11/23/2017
 * Time: 11:14 AM
 */
?>
@extends('master')

@section('contents')
    <div class="page-container" style="min-height:708px">

        <!-- Page content -->
        <div class="page-content">
            <!-- Main content -->
            <div class="content-wrapper">
                <!-- Tab content -->
                <div class="row">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <fieldset class="content-group">
                                <legend class="text-bold">Tạo Post Mới</legend>
                                <form id="form_taomoi">
                                    <div class="content-group">
                                        <div class="form-group">
                                            <div class="upanh-input">
                                                <label class="admin_tieu_de">Ảnh đại diện</label>
                                                <div id="upanh-preview">
                                                    <img style="max-width: 300px;margin-bottom: 15px" id="img_show_avatar"/>
                                                </div>
                                                <!-- Button add media -->
                                                <button type="button" class="btn btn-primary btn-add-medida-1" onclick="return openUploadPopup('img_show_avatar');">Chọn ảnh</button>
                                                <input type="hidden" name="vHinhAnh" id="vHinhAnh" value=""/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Tiêu Đề</label>
                                            <input type="text" name="vTieuDe" id="vTieuDe" class="form-control"  placeholder="Nhập Tiêu Đề ..." required data-required-msg="Tiêu đề phải nhập vào">
                                        </div>

                                        <div class="form-group">
                                            <label>Mô Tả</label>
                                            <textarea type="text" name="vMoTa" id="vMoTa" class="form-control" placeholder="Nhập Mô Tả Ngắn ..." required data-required-msg="Mô tả phải nhập vào"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Từ khóa</label>
                                            <input type="text" name="vKeyword" id="vKeyword" class="form-control" placeholder="Nhập từ khóa ..." required data-required-msg="Key word phải nhập vào">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Loại Post</label>
                                                    <select class="select-border-color border-warning" id="loaibaiviet" required>
                                                        <option value="">Chọn loại bài viết</option>
                                                        @foreach($PostType as $item)
                                                            <option value="{{$item['iMaLoaiBaiViet']}}">{!! $item['vTenLoaiBaiViet'] !!}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        {{--<div class="form-group">--}}
                                            {{--<label>Tags</label>--}}
                                            {{--<input type="text" name="vTags" value="" class="form-control tags-input" id="vTags">--}}
                                        {{--</div>--}}
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Trạng Thái</label>
                                                    <select class="select-border-color border-warning" style="width: 100%;" name="iTrangThai" id="iTrangThai" required data-required-msg="Chọn trạng thái cho bài viết">
                                                        <option value="">Chọn một lựa chọn</option>
                                                        <option value="0">Lưu Nháp</option>
                                                        <option value="1">Đăng Lên Trang Chủ</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        {{--<div class="form-group">--}}
                                            {{--<div class="checkbox">--}}
                                                {{--<label>--}}
                                                    {{--<div class="checker border-primary-600 text-primary-800">--}}
                                                        {{--<input type="checkbox" name="iBinhLuan" class="styled" value="1" id="iBinhLuan">--}}
                                                        {{--<span></span>--}}
                                                    {{--</div>--}}
                                                    {{--Cho phép bình luận--}}
                                                {{--</label>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    </div>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary btn-add-medida-1" data-toggle="modal" data-target="#thuvienhinhbv_popup" onclick="return openUploadPopup('editor');">Chọn ảnh bài viết</button>
                                    </div>
                                    <textarea id="editor" name="editor" rows="10" cols="80" required></textarea>
                                    <div class="text-left" style="margin-top: 15px;">
                                        <button class="btn btn-info">Huỷ Bỏ</button>
                                        <button class="btn btn-primary" onclick="return themBaiViet(this,'form_taomoi');">Lưu Lại <i class="icon-arrow-right14 position-right"></i></button>
                                    </div>
                                </form>
                            </fieldset>
                        </div><!-- /.box -->
                    </div>
                </div>
                <!-- /.row -->

                <!-- /tab content -->
            </div>

        </div>
        <!-- /page content -->

    </div>
    <script type="text/javascript" src="{{ Module::asset('posts:create.js') }}"></script>
    <script type="text/javascript" src="{{ Module::asset('uploadimage:uploadpopup.js') }}"></script>
    <script type="text/javascript" src="/template/ckeditor/ckeditor.js"></script>
@endsection
