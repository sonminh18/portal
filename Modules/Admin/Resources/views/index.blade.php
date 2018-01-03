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
                        <div class="col-md-6">
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <legend class="text-bold">Phân quyền module</legend>
                                </div>
                                <div class="panel-body">
                                    <div id="List_grid" class="cus-kendo"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <legend class="text-bold">Phân quyền tính năng</legend>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Username</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Eugene</td>
                                                <td>Kopyov</td>
                                                <td>@Kopyov</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Victoria</td>
                                                <td>Baker</td>
                                                <td>@Vicky</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>James</td>
                                                <td>Alexander</td>
                                                <td>@Alex</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Franklin</td>
                                                <td>Morrison</td>
                                                <td>@Frank</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /tab content -->

            </div>

        </div>
        <!-- /page content -->

    </div>
    <script type="text/javascript" src="{{ Module::asset('admin:index.js') }}"></script>
@stop
