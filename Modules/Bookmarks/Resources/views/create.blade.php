<?php
/**
 * Created by PhpStorm.
 * User: Son Minh
 * Date: 11/30/2017
 * Time: 10:56 AM
 */
?>

@extends('master')
@section('contents')
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">
            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Tab content -->
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="profile">
                        <!-- Profile info -->
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <legend class="text-bold">Tạo tài bookmarks mới</legend>
                            </div>

                            <div class="panel-body">
                                <form id="personalinfo" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="content-group">
                                                    <h6 class="text">Tên bookmarks:</h6>
                                                    <input type="text" value="" class="form-control" name="bookmarksname" id="bookmarksname" placeholder="Nhập tên bookmarks">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="content-group">
                                                    <h6 class="text">Liên kết:</h6>
                                                    <input type="text" value="" class="form-control" name="bookmarkslink" id="bookmarkslink" placeholder="Nhập liên kết bookmarks">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="content-group">
                                                    <h6 class="text">Username:</h6>
                                                    <input type="text" value="" class="form-control" name="bookmarkslink" id="bookmarkslink" placeholder="Nhập Username nếu có">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="content-group">
                                                    <h6 class="text">Password:</h6>
                                                    <input type="text" value="" class="form-control" name="bookmarkslink" id="bookmarkslink" placeholder="Nhập password nếu có">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="content-group">
                                                    <h6 class="text">Màu sắc:</h6>
                                                    <input type="text" class="form-control colorpicker-palette-toggle" value="#27ADCA">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="content-group">
                                                    <h6 class="text">Icon:</h6>
                                                    <button class="btn btn-default" id="target" role="iconpicker"></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="content-group">
                                                    <h6 class="text">Hiển thị:</h6>
                                                    <select class="select-search" id="iShowAll">
                                                        <option value="">Vui lòng chọn</option>
                                                        <option value="1">Tất cả mọi người</option>
                                                        <option value="0">Chỉ định</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="content-group">
                                                    <h6 class="text">Chọn nhóm chỉ định:</h6>
                                                    <select class="select-search" id="iGroup" multiple>
                                                        @foreach($TeamName as $value)
                                                            <option value="{{$value}}">{{$value}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div style="margin-top: 15px" class="text-center">

                                        <button onclick="addnewuser();" class="btn btn-primary btn-ladda btn-ladda-progress" data-style="expand-right" data-spinner-size="20"><span class="ladda-label"><i class="icon-cog3 position-left"></i> Tạo bookmarks</span></button>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <!-- /profile info -->
                    </div>
                </div>
                <!-- /tab content -->

            </div>

        </div>
        <!-- /page content -->

    </div>
    <script type="text/javascript" src="{{ Module::asset('bookmarks:create.js') }}"></script>
@endsection