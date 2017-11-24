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
                                <legend class="text-bold">Tạo tài khoản mới</legend>
                            </div>

                            <div class="panel-body">
                                <form id="personalinfo" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="content-group">
                                                    <h6 class="text">Tên đầy đủ:</h6>
                                                    <input type="text" value="" class="form-control" name="fullname" id="fullname" placeholder="Nhập tên không dấu, viết hoa chữ cái đầu. VD: Nguyen Thai Minh Son">
                                                </div>

                                            </div>

                                            <div class="col-md-6">
                                                <div class="content-group">
                                                    <h6 class="text">Phòng ban:</h6>
                                                    <select class="select-search" id="deptname">
                                                        <option value="">Chọn 1 phòng ban bất kỳ để thêm</option>
                                                        <optgroup label="ODSCenter">
                                                            @foreach($ou as $item)
                                                                <option value="{!! $item['DeptName'] !!}">{!! $item['DeptName'] !!}</option>
                                                            @endforeach
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="content-group-sm"><code>Lưu ý: Hệ thống sẽ tự động thêm số để phân biệt nếu tên bị trùng.</code></p>
                                    <legend class="text-bold"></legend>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="content-group">
                                                <h6 class="text">Mật khẩu:</h6>
                                                <p class="content-group-sm"><code>Bạn có thể chọn tạo mật khẩu tự động hoặc tự nhập vào mật khẩu mà bạn muốn.</code></p>

                                                <div class="form-group">
                                                    <div class="label-indicator-absolute">
                                                        <input type="text" class="form-control" placeholder="Nhập mật khẩu" id="password">
                                                        <span class="label password-indicator-label-absolute" id="passwordoutput">No password</span>
                                                    </div>
                                                </div>

                                                <a class="btn btn-info generate-group legitRipple" id="generate">Tạo mật khẩu tự động</a>
                                            </div>
                                        </div>
                                    </div>


                                    <div style="margin-top: 15px" class="text-center">

                                        <button onclick="addnewuser();" class="btn btn-primary btn-ladda btn-ladda-progress" data-style="expand-right" data-spinner-size="20"><span class="ladda-label"><i class="icon-cog3 position-left"></i> Tạo tài khoản</span></button>
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
    <script type="text/javascript" src="{{ Module::asset('account:createuser.js') }}"></script>
@endsection