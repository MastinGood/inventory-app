<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Computer Inventory System </title>

    <!-- Bootstrap -->
    <link href="{{asset('../vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('../vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('../vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="{{asset('../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="{{asset('../vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{asset('../build/css/custom.min.css')}}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{asset('css/hover.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <style type="text/css">
        .fir{
            display: none!important;
        }
        .sec{
            display: none!important;
        }
    </style>
    @yield('header-asset')
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container" id="logo">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">

                        <img src="{{url('images/logo.png')}}"  width="220" height="56" class="log">
                    </div>

                    <div class="clearfix"></div>
                    <br />
                    <br>
                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3 class="he">General</h3>
                            <ul class="nav side-menu">
                                @if(Auth::user()->usertype == "admin")
                                    <li><a href="{{route('home')}}" class="hvr-bounce-to-right"><img src="{{url('images/home.png')}}" class="iconz"> Dashboard</a>
                                    </li>
                                     <li><a href="{{route('branch.index')}}" class="hvr-bounce-to-right"><img src="{{url('images/company.png')}}" class="iconz"> Branch</a>
                                    </li>
                                    <li><a href="{{route('staff.index')}}" class="hvr-bounce-to-right"><img src="{{url('images/company-workers.png')}}" class="iconz"> Staff</a>
                                    </li>
                                    <li><a href="{{route('admin.type.index')}}" class="hvr-bounce-to-right"><img src="{{url('images/keyboard.png')}}" class="iconz"> Item Type</a>
                                    </li>
                                    <li><a href="{{route('admin.items.index')}}" class="hvr-bounce-to-right"><img src="{{url('images/computer(1).png')}}" class="iconz"> Item</a>
                                    </li>
                                    <li><a href="{{route('admin.report')}}" class="hvr-bounce-to-right"><img src="{{url('images/file.png')}}" class="iconz"> Reports </a>
                                    </li>
                                   {{--  <li><a href="{{route('logs.index')}}" class="hvr-bounce-to-right"><img src="{{url('images/file.png')}}" class="iconz"> Logs </a>
                                    </li> --}}
                                    @else
                                    <li><a href="{{route('home')}}" class="hvr-bounce-to-right"><img src="{{url('images/home.png')}}" class="iconz"> Dashboard</a>
                                    </li>
                                    <li><a href="{{route('type.index')}}" class="hvr-bounce-to-right"><img src="{{url('images/keyboard.png')}}" class="iconz"> Item Type</a>
                                    </li>
                                    <li><a href="{{route('items.index')}}" class="hvr-bounce-to-right"><img src="{{url('images/computer(1).png')}}" class="iconz"> Item</a>
                                    </li>
                                    <li><a href="{{route('report.index')}}" class="hvr-bounce-to-right"><img src="{{url('images/file.png')}}" class="iconz"> Reports </a>
                                    </li>

                                    @endif

                            </ul>
                        </div>
                    </div>
                    <!-- /sidebar menu -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <nav>
                        <div class="nav toggle">
                            <a id="menu_toggle"><img src="{{asset('images/menu(1).png')}}" height="25" width="25"></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">

                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    @if(!empty(getImage()) && getImage() !==null)
                                    <img src="/profile/{{getImage()}}" style="width: 40px;height: 40px;border-radius: 50%;"  alt="">{{Auth::user()->name}}
                                    @else
                                     <img src="{{url('images/placeholder.jpg')}}" style="width: 40px;height: 40px;border-radius: 50%;"  alt="">{{Auth::user()->name}}
                                     @endif
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu pull-right">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('profile', ['id'=> auth()->user()->id]) }}">
                                            {{ __('Account Settings') }}
                                        </a>
                                         <a class="dropdown-item" href="{{ route('reset') }}">
                                            {{ __('Change Password') }}
                                        </a>
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            <li class="">
                                <label style="margin-top: 22px;margin-right: 7px;">@if(Auth::user()->branchid == 0) Admin @else {{ branch(Auth::user()->branchid)->branchname }} @endif</label>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->

            @yield('content')

            <!-- footer content -->
            <footer>
                <div class="text-center">
                    All Rights Reserved {{Carbon\Carbon::now()->format('Y')}}</a>
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{asset('../vendors/jquery/dist/jquery.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <!-- Bootstrap -->
    <script src="{{asset('../vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('../vendors/fastclick/lib/fastclick.js')}}"></script>
    <!-- morris.js -->
    <link rel="stylesheet" type="text/css" href="{{asset('js/blockui.js')}}">

    <script src="{{asset('../vendors/gauge.js/dist/gauge.min.js')}}"></script>
    <!-- Skycons -->
    <script src="{{asset('../vendors/skycons/skycons.js')}}"></script>
    <!-- DateJS -->
    <script src="{{asset('../vendors/DateJS/build/date.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{asset('../vendors/moment/min/moment.min.js')}}"></script>


    <!-- Custom Theme Scripts -->
    <script src="{{asset('../build/js/custom.min.js')}}"></script>
    <script type="text/javascript">
          $('.normal').on('click', function() {
              var $this = $(this);
            $this.button('loading');
              setTimeout(function() {
                 $this.button('reset');
             }, 2000);
          });

        </script>
    @yield('footer-assets')
</body>

</html>