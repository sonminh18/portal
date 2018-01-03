<?php
/**
 * Created by PhpStorm.
 * User: Son Minh
 * Date: 12/5/2017
 * Time: 1:48 PM
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
                                <legend class="text-bold">Chỉnh sửa bookmarks</legend>
                            </div>

                            <div class="panel-body">
                                <form id="bookmarkinfo" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <input type="hidden" value="{{$bookmark['iBookID']}}" name="bookmarksid" id="bookmarksid">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="content-group">
                                                    <h6 class="text">Tên bookmarks:</h6>
                                                    <input type="text" value="{{$bookmark['vBookName']}}" class="form-control" name="bookmarksname" id="bookmarksname" placeholder="Nhập tên bookmarks" required data-required-msg="Vui lòng nhập tên bookmark" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="content-group">
                                                    <h6 class="text">Liên kết:</h6>
                                                    <input type="text" value="{{$bookmark['vBookLink']}}" class="form-control" name="bookmarkslink" id="bookmarkslink" placeholder="Nhập liên kết bookmarks" required data-required-msg="Vui lòng nhập liên kết bookmark">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="content-group">
                                                    <h6 class="text">Thuộc về Team:</h6>
                                                    <code>Bookmark này sẽ được gán cho team bạn chọn và sẽ hiển thị trong tab của team trên dashboard.</code>
                                                    {{--<input type="text" value="" class="form-control" name="bookmarksTeam" id="bookmarksTeam" placeholder="Vui lòng chọn team" required data-required-msg="Vui lòng chọn">--}}
                                                    <select class="select-search" id="bookmarksTeam" required data-required-msg="Vui lòng chọn team">
                                                        @foreach($BelongToTeam as $value)
                                                            @if($value['iSelected'] == 0)
                                                                <option value="{!! $value['vTeamName'] !!}">{!! $value['vTeamName'] !!}</option>
                                                            @else
                                                                <option value="{!! $value['vTeamName'] !!}" selected>{!! $value['vTeamName'] !!}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        {{--<div class="row">--}}
                                        {{--<div class="col-md-3">--}}
                                        {{--<div class="content-group">--}}
                                        {{--<h6 class="text">Username:</h6>--}}
                                        {{--<input type="text" value="" class="form-control" name="bookmarkslink" id="bookmarkslink" placeholder="Nhập Username nếu có">--}}
                                        {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="col-md-3">--}}
                                        {{--<div class="content-group">--}}
                                        {{--<h6 class="text">Password:</h6>--}}
                                        {{--<input type="text" value="" class="form-control" name="bookmarkslink" id="bookmarkslink" placeholder="Nhập password nếu có">--}}
                                        {{--</div>--}}
                                        {{--</div>--}}
                                        {{--</div>--}}
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="content-group">
                                                    <h6 class="text">Màu sắc:</h6>
                                                    <input type="text" id="color" class="form-control colorpicker-palette-toggle" value="{{$bookmark['vBookColor']}}" required data-required-msg="Vui lòng chọn màu cho bookmark">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="content-group">
                                                    <h6 class="text">Icon:</h6>
                                                    <button class="btn btn-default" data-icon="{{$bookmark['vBookIcon']}}" id="target" role="iconpicker" required data-required-msg="Vui lòng chọn icon cho bookmark"></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="content-group">
                                                    <h6 class="text">Hiển thị:</h6>
                                                    <select class="select-search" id="iShowAll" required data-required-msg="Vui lòng chọn chế độ hiển thị">
                                                        <option value="">Vui lòng chọn</option>
                                                        @if($bookmark->iShowAll == 1)
                                                            <option value="1" selected>Tất cả mọi người</option>
                                                            <option value="0">Chỉ định</option>
                                                        @else
                                                            <option value="1">Tất cả mọi người</option>
                                                            <option value="0" selected>Chỉ định</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="content-group">
                                                    <h6 class="text">Chọn nhóm chỉ định:</h6>
                                                    <select class="select-search" id="iGroup" multiple required data-required-msg="Vui lòng chọn team">
                                                        @foreach($TeamName as $value)
                                                            @if($value['iSelected'] == 0)
                                                                <option value="{!! $value['vTeamName'] !!}">{!! $value['vTeamName'] !!}</option>
                                                            @else
                                                                <option value="{!! $value['vTeamName'] !!}" selected>{!! $value['vTeamName'] !!}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div style="margin-top: 15px" class="text-center">

                                        <button onclick="OnUpdate('bookmarkinfo');" class="btn btn-primary btn-ladda btn-ladda-progress" data-style="expand-right" data-spinner-size="20"><span class="ladda-label"><i class="icon-cog3 position-left"></i> Lưu bookmarks</span></button>
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
    <script type="text/javascript" src="{{ Module::asset('bookmarks:edit.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#target').iconpicker({
                align: 'left', // Only in div tag
                arrowClass: 'btn-danger',
                arrowPrevIconClass: 'glyphicon glyphicon-chevron-left',
                arrowNextIconClass: 'glyphicon glyphicon-chevron-right',
                cols: 7,
                footer: true,
                header: true,
                icon: "{{$bookmark['vBookIcon']}}",
                iconset: 'fontawesome',
                labelHeader: '{0} - {1} Trang',
                labelFooter: '{0} - {1} tổng {2} icons',
                placement: 'bottom', // Only in button tag
                rows: 4,
                search: true,
                searchText: 'Search',
                selectedClass: 'btn-success',
                unselectedClass: ''
            });
        });
    </script>
@endsection
