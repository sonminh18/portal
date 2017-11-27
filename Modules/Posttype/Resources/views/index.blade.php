@extends('master')

@section('contents')
    <div class="page-container" style="min-height:708px">

        <!-- Page content -->
        <div class="page-content">
            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Tab content -->
                <div class="tab-content">
                    <div class="tab-pane fade in active">

                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <legend class="text-bold">Quản lý loại Posts</legend>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <div class="input-group col-md-6">
                                        <span class="input-group-btn">
                                            <button onclick="OnShowPoppupCreate();" class="btn bg-pink-400 btn-rounded legitRipple btn-ladda btn-ladda-progress" data-style="expand-right" data-spinner-size="20">
                                                <span class="ladda-label "><i class="icon-cog3 position-left"></i> Tạo loại mới</span>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group col-md-6">
                                        <input type="text" id="txtSearchKey" class="form-control" placeholder="Nhập để tìm"/>
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-primary" id="search">Tìm Kiếm<i class="icon-arrow-right14 position-right"></i></button>
                                        </span>
                                    </div>
                                </div>
                                <div id="List_grid" class="cus-kendo"></div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /tab content -->

            </div>

        </div>
        <!-- /page content -->

    </div>
    <script type="text/javascript" src="{{ Module::asset('posttype:index.js') }}"></script>
@endsection
