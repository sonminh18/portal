<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <!-- App Favicon -->
    <link rel="shortcut icon" href="login/images/favicon.ico">

    <!-- App title -->
    <title>Chào mừng đến với ODS - Portal</title>

    <!-- App CSS -->
    <link href="login/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="login/css/core.css" rel="stylesheet" type="text/css" />
    <link href="login/css/components.css" rel="stylesheet" type="text/css" />
    <link href="login/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="login/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="login/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="login/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="login/plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" type="text/css" />


    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script src="login/js/modernizr.min.js"></script>

</head>
<body>

<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="wrapper-page">
    <div class="text-center">
        <a href="index.html" class="logo"><span style="font-size: 80px">Portal<span> v2</span></span></a>
        <h4 class="text-muted m-t-0 font-600">Cổng thông tin đăng nhập</h4>
    </div>
    <div class="m-t-40 card-box">
        <div class="text-center">
            <h4 class="text-uppercase font-bold m-b-0">Welcome</h4>
        </div>
        <div class="panel-body">

            <form id="loginform" class="text-center" data-parsley-validate>
                <div class="form-horizontal m-t-20">
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" name="username" id="username" required="" placeholder="Tên đăng nhập">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" name="password"  id="password" required="" placeholder="Mật khẩu">
                        </div>
                    </div>

                    <div class="form-group text-center m-t-30">
                        <div class="col-xs-12">
                            <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" onclick="dangnhap();">Đăng Nhập</button>
                        </div>
                    </div>

                    <div class="form-group m-t-30 m-b-0">
                        <div class="col-sm-12">
                            <a href="page-recoverpw.html" class="text-muted"><i class="fa fa-lock m-r-5"></i> Quên mật khẩu?</a>
                        </div>
                    </div>
                </div>

            </form>

        </div>
    </div>
    <!-- end card-box-->

    <div class="row">
        <div class="col-sm-12 text-center">
            <p class="text-muted">  &copy; Online Data Services Jsc | 2017</p>
        </div>
    </div>

</div>
<!-- end wrapper page -->



<script>
    var resizefunc = [];
</script>

<!-- jQuery  -->
<script src="login/js/jquery.min.js"></script>
<script src="login/js/bootstrap.min.js"></script>
<script src="login/js/detect.js"></script>
<script src="login/js/fastclick.js"></script>
<script src="login/js/jquery.slimscroll.js"></script>
<script src="login/js/jquery.blockUI.js"></script>
<script src="login/js/waves.js"></script>
<script src="login/js/wow.min.js"></script>
<script src="login/js/jquery.nicescroll.js"></script>
<script src="login/js/jquery.scrollTo.min.js"></script>

<!-- App js -->
<script src="login/js/jquery.core.js"></script>
<script src="login/js/jquery.app.js"></script>
<script src="login/plugins/bootstrap-sweetalert/sweet-alert.min.js"></script>
<script type="text/javascript" src="{{ Module::asset('login:login.js') }}"></script>
</body>
</html>