@extends('master')
@section('contents')
<style>
    .margin-bottom{
        margin-bottom: 10px;
    }
</style>
<div class="page-container">
    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Traffic sources -->


                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h6 class="panel-title">Daily financials<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
                                    <div class="heading-elements">
                                        <form class="heading-form" action="#">
                                            <div class="form-group">

                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="panel-body">
                                    <div class="tabbable nav-tabs-vertical nav-tabs-left">
                                        <ul class="nav nav-tabs nav-tabs-highlight">
                                            <li class="active"><a href="#left-tab1" data-toggle="tab"> Support Team</a></li>
                                            <li><a href="#left-tab2" data-toggle="tab"> Voip Team</a></li>
                                            <li><a href="#left-tab2" data-toggle="tab"> Network Team</a></li>
                                            <li><a href="#left-tab2" data-toggle="tab"> Elect Team</a></li>
                                            <li><a href="#left-tab2" data-toggle="tab"> System Team</a></li>
                                            <li><a href="#left-tab2" data-toggle="tab"> Dev Team</a></li>
                                        </ul>

                                        <div class="tab-content">
                                            <div class="tab-pane active has-padding" id="left-tab1">
                                                <div class="row">
                                                    <div class="col-xs-3 margin-bottom">
                                                        <button type="button" class="btn bg-blue btn-block btn-float btn-float-lg legitRipple"><i class="icon-cog3"></i> <span>Settings</span></button>
                                                    </div>
                                                    <div class="col-xs-3 margin-bottom">
                                                        <button type="button" class="btn bg-blue btn-block btn-float btn-float-lg legitRipple"><i class="icon-cog3"></i> <span>Settings</span></button>
                                                    </div>
                                                    <div class="col-xs-3 margin-bottom">
                                                        <button type="button" class="btn bg-blue btn-block btn-float btn-float-lg legitRipple"><i class="icon-cog3"></i> <span>Settings</span></button>
                                                    </div>
                                                    <div class="col-xs-3 margin-bottom">
                                                        <button type="button" class="btn bg-blue btn-block btn-float btn-float-lg legitRipple"><i class="icon-cog3"></i> <span>Settings</span></button>
                                                    </div>
                                                    <div class="col-xs-3 margin-bottom">
                                                        <button type="button" class="btn bg-blue btn-block btn-float btn-float-lg legitRipple"><i class="icon-cog3"></i> <span>Settings</span></button>
                                                    </div>
                                                    <div class="col-xs-3 margin-bottom">
                                                        <button type="button" class="btn bg-blue btn-block btn-float btn-float-lg legitRipple"><i class="icon-cog3"></i> <span>Settings</span></button>
                                                    </div>
                                                    <div class="col-xs-3 margin-bottom">
                                                        <button type="button" class="btn bg-blue btn-block btn-float btn-float-lg legitRipple"><i class="icon-cog3"></i> <span>Settings</span></button>
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="tab-pane has-padding" id="left-tab2">
                                                <div class="row">
                                                    <div class="col-xs-3 margin-bottom">
                                                        <button type="button" class="btn bg-purple-300 btn-block btn-float btn-float-lg legitRipple"><i class="icon-archive"></i> <span>Archive</span></button>
                                                    </div>
                                                    <div class="col-xs-3 margin-bottom">
                                                        <button type="button" class="btn bg-purple-300 btn-block btn-float btn-float-lg legitRipple"><i class="icon-archive"></i> <span>Archive</span></button>
                                                    </div>
                                                    <div class="col-xs-3 margin-bottom">
                                                        <button type="button" class="btn bg-purple-300 btn-block btn-float btn-float-lg legitRipple"><i class="icon-archive"></i> <span>Archive</span></button>
                                                    </div>
                                                    <div class="col-xs-3 margin-bottom">
                                                        <button type="button" class="btn bg-purple-300 btn-block btn-float btn-float-lg legitRipple"><i class="icon-archive"></i> <span>Archive</span></button>
                                                    </div>
                                                    <div class="col-xs-3 margin-bottom">
                                                        <button type="button" class="btn bg-purple-300 btn-block btn-float btn-float-lg legitRipple"><i class="icon-archive"></i> <span>Archive</span></button>
                                                    </div>
                                                    <div class="col-xs-3 margin-bottom">
                                                        <button type="button" class="btn bg-purple-300 btn-block btn-float btn-float-lg legitRipple"><i class="icon-archive"></i> <span>Archive</span></button>
                                                    </div>
                                                    <div class="col-xs-3 margin-bottom">
                                                        <button type="button" class="btn bg-purple-300 btn-block btn-float btn-float-lg legitRipple"><i class="icon-archive"></i> <span>Archive</span></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                                        {{----}}
                                                        {{--<li><button type="button" class="btn bg-blue btn-block btn-float btn-float-lg legitRipple"><i class="icon-cog3"></i> <span>Settings</span></button></li>--}}
                                                        {{--<li><button type="button" class="btn bg-purple-300 btn-block btn-float btn-float-lg legitRipple"><i class="icon-archive"></i> <span>Archive</span></button></li>--}}
                                                        {{--<li><button type="button" class="btn bg-teal-400 btn-block btn-float btn-float-lg legitRipple"><i class="icon-file-plus"></i> <span>New invoice</span></button></li>--}}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!-- Daily financials -->
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h6 class="panel-title">Daily financials<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
                                    <div class="heading-elements">
                                        <form class="heading-form" action="#">
                                            <div class="form-group">
                                                <label class="checkbox checkbox-inline checkbox-switchery checkbox-right switchery-xs">
                                                    <input type="checkbox" class="switcher" id="realtime" checked="checked">
                                                    Realtime
                                                </label>
                                            </div>
                                        </form>
                                        <span class="badge bg-danger-400 heading-text">+86</span>
                                    </div>
                                </div>

                                <div class="panel-body">
                                    <div class="content-group-xs" id="bullets"></div>

                                    <ul class="media-list">
                                        <li class="media">
                                            <div class="media-left">
                                                <a href="#" class="btn border-pink text-pink btn-flat btn-rounded btn-icon btn-xs legitRipple"><i class="icon-statistics"></i></a>
                                            </div>

                                            <div class="media-body">
                                                Stats for July, 6: 1938 orders, $4220 revenue
                                                <div class="media-annotation">2 hours ago</div>
                                            </div>

                                            <div class="media-right media-middle">
                                                <ul class="icons-list">
                                                    <li>
                                                        <a href="#"><i class="icon-arrow-right13"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>

                                        <li class="media">
                                            <div class="media-left">
                                                <a href="#" class="btn border-success text-success btn-flat btn-rounded btn-icon btn-xs legitRipple"><i class="icon-checkmark3"></i></a>
                                            </div>

                                            <div class="media-body">
                                                Invoices <a href="#">#4732</a> and <a href="#">#4734</a> have been paid
                                                <div class="media-annotation">Dec 18, 18:36</div>
                                            </div>

                                            <div class="media-right media-middle">
                                                <ul class="icons-list">
                                                    <li>
                                                        <a href="#"><i class="icon-arrow-right13"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>

                                        <li class="media">
                                            <div class="media-left">
                                                <a href="#" class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-xs legitRipple"><i class="icon-alignment-unalign"></i></a>
                                            </div>

                                            <div class="media-body">
                                                Affiliate commission for June has been paid
                                                <div class="media-annotation">36 minutes ago</div>
                                            </div>

                                            <div class="media-right media-middle">
                                                <ul class="icons-list">
                                                    <li>
                                                        <a href="#"><i class="icon-arrow-right13"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>

                                        <li class="media">
                                            <div class="media-left">
                                                <a href="#" class="btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs legitRipple"><i class="icon-spinner11"></i></a>
                                            </div>

                                            <div class="media-body">
                                                Order <a href="#">#37745</a> from July, 1st has been refunded
                                                <div class="media-annotation">4 minutes ago</div>
                                            </div>

                                            <div class="media-right media-middle">
                                                <ul class="icons-list">
                                                    <li>
                                                        <a href="#"><i class="icon-arrow-right13"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>

                                        <li class="media">
                                            <div class="media-left">
                                                <a href="#" class="btn border-teal-400 text-teal btn-flat btn-rounded btn-icon btn-xs legitRipple"><i class="icon-redo2"></i></a>
                                            </div>

                                            <div class="media-body">
                                                Invoice <a href="#">#4769</a> has been sent to <a href="#">Robert Smith</a>
                                                <div class="media-annotation">Dec 12, 05:46</div>
                                            </div>

                                            <div class="media-right media-middle">
                                                <ul class="icons-list">
                                                    <li>
                                                        <a href="#"><i class="icon-arrow-right13"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /daily financials -->

                        </div>
                    </div>

                </div>

                <div class="position-relative" id="traffic-sources"></div>
            <!-- /traffic sources -->

        </div>
        <!-- /content area -->

    </div>
    <!-- /page content -->

</div>
@endsection