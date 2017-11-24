@extends('master')
@section('contents')
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main sidebar -->
            <div class="sidebar sidebar-main sidebar-default sidebar-separate">
                <div class="sidebar-content">

                    <!-- User details -->
                    <div class="content-group">
                        <div class="panel-body bg-indigo-400 border-radius-top text-center" style="background-image: url(http://demo.interface.club/limitless//template/images/bg.png); background-size: contain;">
                            <div class="content-group-sm">
                                <h6 class="text-semibold no-margin-bottom">
                                    {{session('fullname')}}
                                </h6>

                                <span class="display-block">{{session('teamname')}}</span>
                            </div>

                            <a href="#" class="display-inline-block content-group-sm">
                                @if( $data['email'] != null)
                                    <img src="{{$data['image']}}" class="img-circle img-responsive" alt="" style="width: 110px; height: 110px;">
                                @else
                                    <img src="/template/images/placeholder.jpg" class="img-circle img-responsive" alt="" style="width: 110px; height: 110px;">
                                @endif
                            </a>
                        </div>

                    </div>
                    <!-- /user details -->

                    <!-- Latest updates -->
                    <div class="sidebar-category">
                        <div class="category-title">
                            <span>Latest updates</span>
                            <ul class="icons-list">
                                <li><a href="#" data-action="collapse"></a></li>
                            </ul>
                        </div>

                        <div class="category-content">
                            <ul class="media-list">
                                <li class="media">
                                    <div class="media-left">
                                        <a href="#" class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-pull-request"></i></a>
                                    </div>

                                    <div class="media-body">
                                        Drop the IE <a href="#">specific hacks</a> for temporal inputs
                                        <div class="media-annotation">4 minutes ago</div>
                                    </div>
                                </li>

                                <li class="media">
                                    <div class="media-left">
                                        <a href="#" class="btn border-warning text-warning btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-commit"></i></a>
                                    </div>

                                    <div class="media-body">
                                        Add full font overrides for popovers and tooltips
                                        <div class="media-annotation">36 minutes ago</div>
                                    </div>
                                </li>

                                <li class="media">
                                    <div class="media-left">
                                        <a href="#" class="btn border-info text-info btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-branch"></i></a>
                                    </div>

                                    <div class="media-body">
                                        <a href="#">Chris Arney</a> created a new <span class="text-semibold">Design</span> branch
                                        <div class="media-annotation">2 hours ago</div>
                                    </div>
                                </li>

                                <li class="media">
                                    <div class="media-left">
                                        <a href="#" class="btn border-success text-success btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-merge"></i></a>
                                    </div>

                                    <div class="media-body">
                                        <a href="#">Eugene Kopyov</a> merged <span class="text-semibold">Master</span> and <span class="text-semibold">Dev</span> branches
                                        <div class="media-annotation">Dec 18, 18:36</div>
                                    </div>
                                </li>

                                <li class="media">
                                    <div class="media-left">
                                        <a href="#" class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-pull-request"></i></a>
                                    </div>

                                    <div class="media-body">
                                        Have Carousel ignore keyboard events
                                        <div class="media-annotation">Dec 12, 05:46</div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /latest updates -->

                </div>
            </div>
            <!-- /main sidebar -->


            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Tab content -->
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="profile">
                        <!-- Profile info -->
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">Thông tin cá nhân</h6>
                                <div class="heading-elements">
                                    <ul class="icons-list">
                                        <li><a data-action="collapse"></a></li>
                                        <li><a data-action="reload"></a></li>

                                    </ul>
                                </div>
                            </div>

                            <div class="panel-body">
                                <form id="personalinfo" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Tên đăng nhập(*)</label>
                                                <input type="text" value="{{session('username')}}" class="form-control" readonly="readonly" name="username">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Tên đầy đủ</label>
                                                <input type="text" value="{{session('fullname')}}" class="form-control" readonly="readonly">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email(*)</label>
                                                <input type="text" id="email" name="email" value="{{$data['email']}}" class="form-control">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Số điện thoại(*)</label>
                                                <input type="text" class="form-control" name="phonenumber" id="phonenumber"  value="{{$data['phonenumber']}}">

                                            </div>

                                            <div class="col-md-6">
                                                <label class="display-block">Thay đổi hình đại diện(*)</label>
                                                <input type="file" class="file-styled" id="myimage" name="myimage" required>
                                                <span class="help-block">Chỉ chấp nhận: gif, png, jpg. Tối đa: 2Mb</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-right">
                                        <button onclick="updateinfo()" class="btn btn-primary">Lưu <i class="icon-arrow-right14 position-right"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /profile info -->


                        <!-- Account settings -->
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">Đổi mật khẩu</h6>
                                <div class="heading-elements">
                                    <ul class="icons-list">
                                        <li><a data-action="collapse"></a></li>
                                        <li><a data-action="reload"></a></li>
                                        {{--<li><a data-action="close"></a></li>--}}
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-body">
                                <form id="changepassword">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Tên đăng nhập</label>
                                                <input type="text" value="{{session('username')}}" id="username" readonly="readonly" class="form-control">
                                            </div>

                                            <div class="col-md-6">
                                                <label>Mật khẩu hiện tại</label>
                                                <input type="password" value="" id="password" placeholder="Nhập mật khẩu hiện tại" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Mật khẩu mới</label>
                                                <input type="password" id="newpassword" placeholder="Nhập mật khẩu mới" class="form-control">
                                            </div>

                                            <div class="col-md-6">
                                                <label>Nhập lại mật khẩu mới</label>
                                                <input type="password" id="newpasswordrepeat" placeholder="Nhập lại mật khẩu mới" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-right">
                                        <button onclick="changepass()" class="btn btn-primary">Lưu <i class="icon-arrow-right14 position-right"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /account settings -->

                    </div>
                </div>
                <!-- /tab content -->

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

    </div>
    <script type="text/javascript" src="{{ Module::asset('dashboard:dashboard.js') }}"></script>
@endsection