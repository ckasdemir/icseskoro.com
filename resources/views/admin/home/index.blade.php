@extends('admin/template/layout')

@section('content')
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"><a href="index.html" title="Anasayfa" class="tip-bottom"><i class="icon-home"></i>
                Anasayfa</a></div>
    </div>
    <!--End-breadcrumbs-->

    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"><span class="icon"> <i class="icon-signal"></i> </span>
                        <h5>Turning-series chart</h5>
                    </div>
                    <div class="widget-content">
                        <div id="placeholder"></div>
                        <p id="choices"></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="widget-box widget-plain">
            <div class="center">
                <ul class="stat-boxes2">
                    <li>
                        <div class="left peity_bar_neutral"><span><span style="display: none;">2,4,9,7,12,10,12</span>
              <canvas width="50" height="24"></canvas>
              </span>+10%
                        </div>
                        <div class="right"><strong>15598</strong> Visits</div>
                    </li>
                    <li>
                        <div class="left peity_line_neutral"><span><span
                                    style="display: none;">10,15,8,14,13,10,10,15</span>
              <canvas width="50" height="24"></canvas>
              </span>10%
                        </div>
                        <div class="right"><strong>150</strong> New Users</div>
                    </li>
                    <li>
                        <div class="left peity_bar_bad"><span><span style="display: none;">3,5,6,16,8,10,6</span>
              <canvas width="50" height="24"></canvas>
              </span>-40%
                        </div>
                        <div class="right"><strong>4560</strong> Orders</div>
                    </li>
                    <li>
                        <div class="left peity_line_good"><span><span style="display: none;">12,6,9,23,14,10,17</span>
              <canvas width="50" height="24"></canvas>
              </span>+60%
                        </div>
                        <div class="right"><strong>5672</strong> Active Users</div>
                    </li>
                    <li>
                        <div class="left peity_bar_good"><span>12,6,9,23,14,10,13</span>+30%</div>
                        <div class="right"><strong>2560</strong> Register</div>
                    </li>
                </ul>
            </div>
        </div>

        <!--Chart-box-->
        <div class="row-fluid">
            <div class="widget-box">
                <div class="widget-title bg_lg"><span class="icon"><i class="icon-signal"></i></span>
                    <h5>Site Analytics</h5>
                </div>
                <div class="widget-content">
                    <div class="row-fluid">
                        <div class="span9">
                            <div class="chart"></div>
                        </div>
                        <div class="span3">
                            <ul class="site-stats">
                                <li class="bg_lh"><i class="icon-user"></i> <strong>2540</strong>
                                    <small>Total Users</small>
                                </li>
                                <li class="bg_lh"><i class="icon-plus"></i> <strong>120</strong>
                                    <small>New Users</small>
                                </li>
                                <li class="bg_lh"><i class="icon-shopping-cart"></i> <strong>656</strong>
                                    <small>Total Shop</small>
                                </li>
                                <li class="bg_lh"><i class="icon-tag"></i> <strong>9540</strong>
                                    <small>Total Orders</small>
                                </li>
                                <li class="bg_lh"><i class="icon-repeat"></i> <strong>10</strong>
                                    <small>Pending Orders</small>
                                </li>
                                <li class="bg_lh"><i class="icon-globe"></i> <strong>8540</strong>
                                    <small>Online Orders</small>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End-Chart-box-->
        <hr/>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"><span class="icon"><i class="icon-repeat"></i></span>
                        <h5>Kullanıcı Hareketleri</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <ul class="activity-list">
                            @foreach($recent_activities as $item)
                                <li><a href="#"> <i class="icon-user"></i>
                                        <strong>{{$item->user->username}}</strong>, {!! $item->description !!}
                                        <span>
                                            @php
                                                $time_msg = "";
                                                $now = \Carbon\Carbon ::now();
                                                $created_at = \Carbon\Carbon ::parse($item->created_at);

                                                $diffInYears = $now->diffInYears($created_at, true);
                                                if(($diffInYears % 365) > 0)
                                                    $time_msg .= ($diffInYears % 365)." yıl, ";

                                                $diffInMonths = $now->diffInMonths($created_at, true);
                                                if(($diffInMonths % 12) > 0)
                                                    $time_msg .= ($diffInMonths % 12)." ay, ";

                                                $diffInDays = $now->diffInDays($created_at, true);
                                                if(($diffInDays % 24) > 0)
                                                    $time_msg .= ($diffInDays % 24)." gün, ";

                                                $diffInHours = $now->diffInHours($created_at, true);
                                                if(($diffInHours % 60) > 0)
                                                    $time_msg .= ($diffInHours % 60)." saat, ";

                                                $diffInMinutes = $now->diffInMinutes($created_at, true);
                                                if(($diffInMinutes % 60) > 0)
                                                    $time_msg .= ($diffInMinutes % 60)." dakika, ";

                                                $diffInSeconds = $now->diffInSeconds($created_at, true);
                                                if(($diffInSeconds % 60) > 0)
                                                    $time_msg .= ($diffInSeconds % 60)." saniye ";
                                            @endphp
                                            {{ $time_msg. "önce" }}
                                            </span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="/admin/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/admin/css/bootstrap-responsive.min.css"/>
    <link rel="stylesheet" href="/admin/css/fullcalendar.css"/>
    <link rel="stylesheet" href="/admin/css/matrix-style.css"/>
    <link rel="stylesheet" href="/admin/css/matrix-media.css"/>
    <link rel="stylesheet" href="/admin/css/jquery.gritter.css"/>

@endsection

@section('js')
    <script src="/admin/js/excanvas.min.js"></script>
    <script src="/admin/js/jquery.min.js"></script>
    <script src="/admin/js/jquery.ui.custom.js"></script>
    <script src="/admin/js/bootstrap.min.js"></script>
    <script src="/admin/js/jquery.flot.min.js"></script>
    <script src="/admin/js/jquery.flot.resize.min.js"></script>
    <script src="/admin/js/jquery.peity.min.js"></script>
    <script src="/admin/js/fullcalendar.min.js"></script>
    <script src="/admin/js/matrix.js"></script>
    <script src="/admin/js/matrix.dashboard.js"></script>
    <script src="/admin/js/jquery.gritter.min.js"></script>
    <script src="/admin/js/matrix.interface.js"></script>
    <script src="/admin/js/matrix.chat.js"></script>
    <script src="/admin/js/jquery.validate.js"></script>
    <script src="/admin/js/matrix.form_validation.js"></script>
    <script src="/admin/js/jquery.wizard.js"></script>
    <script src="/admin/js/jquery.uniform.js"></script>
    <script src="/admin/js/select2.min.js"></script>
    <script src="/admin/js/matrix.popover.js"></script>
    <script src="/admin/js/jquery.dataTables.min.js"></script>
    <script src="/admin/js/matrix.tables.js"></script>

    <script type="text/javascript">
        // This function is called from the pop-up menus to transfer to
        // a different page. Ignore if the value returned is a null string:
        function goPage(newURL) {

            // if url is empty, skip the menu dividers and reset the menu selection to default
            if (newURL != "") {

                // if url is "-", it is this page -- reset the menu:
                if (newURL == "-") {
                    resetMenu();
                }
                // else, send page to designated URL            
                else {
                    document.location.href = newURL;
                }
            }
        }

        // resets the menu selection upon entry to this page:
        function resetMenu() {
            document.gomenu.selector.selectedIndex = 2;
        }
    </script>

@endsection
