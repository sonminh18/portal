<div class="navbar navbar-default" id="navbar-second">
    <div class="navbar-boxed">
        <ul class="nav navbar-nav no-border visible-xs-block">
            <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-menu7"></i></a></li>
        </ul>

        <div class="navbar-collapse collapse" id="navbar-second-toggle">
            <ul class="nav navbar-nav">
                <li><a href="/dashboard"><i class="icon-display4 position-left"></i> Dashboard</a></li>
                @foreach($menu as $item)
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="{!! $item['ModIcon'] !!} position-left"></i> {!! $item['ModName'] !!} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu width-200">
                            <li class="dropdown-header">Chọn tính năng</li>
                            @foreach($item['Feature'] as $feature)
                                <li><a href="/{!! $item['ModLink'] !!}/{!! $feature->vFeatLink !!}"><i class="{!! $feature->vFeatIcon !!}"></i> {!! $feature->vFeatName !!}</a></li>
                            @endforeach
                        </ul>
                    </li>

                @endforeach

            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a>
                        <i class="icon-users4 position-left"></i>
                        {{session('teamname')}} <i class="icon-arrow-left5 position-left"></i> {{session('deptname')}}
                        <span class="label label-inline position-right bg-success-400"></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>