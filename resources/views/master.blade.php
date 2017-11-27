<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="login/images/favicon.ico">
    <title>Portal - Online Data services JSC</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="/template/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="/template/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="/template/css/core.css" rel="stylesheet" type="text/css">
    <link href="/template/css/components.css" rel="stylesheet" type="text/css">
    <link href="/template/css/colors.css" rel="stylesheet" type="text/css">
    <link href="/template/css/extras/animate.min.css" rel="stylesheet" type="text/css">
    <link href="/template/kendoUI/styles/kendo.material.min.css" rel="stylesheet" type="text/css">
    <link href="/template/kendoUI/styles/kendo.fiori.mobile.min.css" rel="stylesheet" type="text/css">
    <link href="/template/kendoUI/styles/kendo.common-bootstrap.min.css" rel="stylesheet" type="text/css">
    {{--<link href="/template/kendoUI/styles/kendo.rtl.min.css" rel="stylesheet" type="text/css">--}}
    {{--<link href="/template/kendoUI/kendo.bootstrap.min.css" rel="stylesheet" type="text/css">--}}



    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="/template/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="/template/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="/template/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="/template/js/plugins/loaders/blockui.min.js"></script>
    <script type="text/javascript" src="/template/js/plugins/ui/nicescroll.min.js"></script>
    <script type="text/javascript" src="/template/js/plugins/ui/drilldown.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="/template/js/plugins/visualization/d3/d3.min.js"></script>
    <script type="text/javascript" src="/template/js/plugins/visualization/d3/d3_tooltip.js"></script>
    <script type="text/javascript" src="/template/js/plugins/forms/styling/switchery.min.js"></script>
    <script type="text/javascript" src="/template/js/plugins/forms/styling/uniform.min.js"></script>
    <script type="text/javascript" src="/template/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
    <script type="text/javascript" src="/template/js/plugins/ui/moment/moment.min.js"></script>
    <script type="text/javascript" src="/template/js/plugins/pickers/daterangepicker.js"></script>

    <script type="text/javascript" src="/template/js/plugins/notifications/pnotify.min.js"></script>
    <script type="text/javascript" src="/template/js/plugins/notifications/bootbox.min.js"></script>
    <script type="text/javascript" src="/template/js/plugins/notifications/sweet_alert.min.js"></script>
    <script type="text/javascript" src="/template/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="/template/js/plugins/velocity/velocity.min.js"></script>
    <script type="text/javascript" src="/template/js/plugins/velocity/velocity.ui.min.js"></script>
    <script type="text/javascript" src="/template/js/plugins/buttons/spin.min.js"></script>
    <script type="text/javascript" src="/template/js/plugins/buttons/ladda.min.js"></script>
    <script type="text/javascript" src="/template/js/plugins/forms/inputs/passy.js"></script>
    <script type="text/javascript" src="/template/kendoUI/kendo.all.min.js"></script>
    <script type="text/javascript" src="/template/js/plugins/forms/styling/uniform.min.js"></script>
    {{--<script type="text/javascript" src="/template/js/core/libraries/jquery_ui/interactions.min.js"></script>--}}
    {{--<script type="text/javascript" src="/template/js/core/libraries/jquery_ui/touch.min.js"></script>--}}
    <script type="text/javascript" src="/template/js/core/app.js"></script>
    {{--<script type="text/javascript" src="/template/js/pages/dashboard_boxed.js"></script>--}}
    <!-- /theme JS files -->
    {{--<script type="text/javascript" src="/template/js/plugins/ui/headroom/headroom.min.js"></script>--}}
    {{--<script type="text/javascript" src="/template/js/plugins/ui/headroom/headroom_jquery.min.js"></script>--}}

    {{--<script type="text/javascript" src="/template/js/pages/layout_navbar_main_hideable.js"></script>--}}
    {{--<script type="text/javascript" src="/template/js/pages/layout_navbar_secondary_fixed.js"></script>--}}
    <script type="text/javascript" src="/template/js/plugins/uploaders/fileinput/plugins/purify.min.js"></script>
    <script type="text/javascript" src="/template/js/plugins/uploaders/fileinput/plugins/sortable.min.js"></script>
    <script type="text/javascript" src="/template/js/plugins/uploaders/fileinput/fileinput.min.js"></script>

</head>

<body class="navbar-bottom-lg">

<!-- Main navbar -->
@include('mainnavbar')
<!-- /main navbar -->


<!-- Second navbar -->
@include('secondnavbar')
<!-- /second navbar -->


<!-- Page header -->
@include('header')
<!-- /page header -->


<!-- Page container -->
@yield('contents')
<!-- /page container -->


<!-- Footer -->
@include('footer')
<!-- /footer -->

</body>

</html>

