@extends('layouts.admin-template')
@section('header-asset')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{asset('css/toastr.min.css')}}">
<script>
    jQuery(document).ready(function() {
        $('.counter').counterUp({
            delay: 10,
            time: 1000
        });
    });
</script>
<style type="text/css">
  .tab2{
    display: none!important;
  }
   .tab3{
    display: none!important;
  }
</style>
@endsection
@section('content')

<!-- page content -->
<div class="right_col" role="main">
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
             <div class="head-color">
                <br>
                <h1 class="text-center display-4" style="color:white!important;">Todays Asset</h1>
             </div>
          <div class="modal-body">
            <br>
           <div class="table-responsive">
            <table class="table table-striped">
                    <thead class=thead-dark>
                     <tr>
                        <th style="padding-bottom: 18px;">Branch</th>
                        <th style="padding-bottom: 18px;">Total Asset</th>
                        <th style="padding-bottom: 18px;">Total Items</th>
                     </tr>
                     <tbody>
                        @if(count($brans)>0)
                        @foreach($brans as $bran)
                        <tr>
                            <td>{{$bran->branchname}}</td>
                            <td>₱<span class="counter">{{$bran->getTodayAsset($bran->id)}}</span></td>
                            <td><span class="counter">{{$bran->getTodayItem($bran->id)}}</span></td>
                        </tr>
                        @endforeach
                        @endif
                        <tr>
                            <td></td>
                            <td><h4>₱<span class="counter">{{$total_today}}</span></h4></td>
                            <td><h4><span class="counter">{{$items_today_count}}</span></h4></td>
                        </tr>
                     </tbody>
                    </thead>
                </tr>
            </table>
           </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="yesterday" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="head-color">
            <br>
            <h1 class="text-center display-4" style="color:white!important;">Yesterday's Asset</h1>
         </div>
          <div class="modal-body">
            <br>
           <div class="table-responsive">
            <table class="table table-striped">
                    <thead class=thead-dark>
                     <tr>
                        <th>Branch</th>
                        <th>Total Asset</th>
                        <th>Total Items</th>
                     </tr>
                     <tbody>
                        @if(count($brans)>0)
                        @foreach($brans as $bran)
                        <tr>
                            <td>{{$bran->branchname}}</td>
                            <td>₱<span class="counter">{{$bran->getYesterdayAsset($bran->id)}}</span></td>
                            <td><span class="counter">{{$bran->getYesterdayItem($bran->id)}}</span></td>
                        </tr>
                        @endforeach
                        @endif
                        <tr>
                            <td></td>
                            <td><h4>₱<span class="counter">{{$total_yesterday}}</span></h4></td>
                            <td><h4><span class="counter">{{$items_yesterday_count}}</span></h4></td>
                        </tr>
                     </tbody>
                    </thead>
                </tr>
            </table>
           </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="month" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="head-color">
            <br>
            <h1 class="text-center display-4" style="color:white!important;">Last Month Asset</h1>
         </div>
          <div class="modal-body">
            <br>
           <div class="table-responsive">
            <table class="table table-striped">
                    <thead class=thead-dark>
                     <tr>
                        <th>Branch</th>
                        <th>Total Asset</th>
                        <th>Total Items</th>
                     </tr>
                     <tbody>
                        @if(count($brans)>0)
                        @foreach($brans as $bran)
                        <tr>
                            <td>{{$bran->branchname}}</td>
                            <td>₱<span class="counter">{{$bran->getMonthAsset($bran->id)}}</span></td>
                            <td><span class="counter">{{$bran->getMonthItem($bran->id)}}</span></td>
                        </tr>
                        @endforeach
                        @endif
                        <tr>
                            <td></td>
                            <td><h4>₱<span class="counter">{{$total_month}}</span></h4></td>
                            <td><h4><span class="counter">{{$items_month_count}}</span></h4></td>
                        </tr>
                     </tbody>
                    </thead>
                </tr>
            </table>
           </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    {{-- Staff --}}
     <div class="modal fade" id="staff_today" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="head-color">
                 <br>
                <h1 class="text-center display-4" style="color:white!important;">Todays Asset</h1>
             </div>
              <div class="modal-body">
                <br>
               <div class="table-responsive">
                 <table class="table table-striped" height="350" style="margin-bottom: none!important;">
                    <thead>
                        <tr>
                            <th>Item Type</th>
                            <th>Name</th>
                            <th>Photo</th>
                            <th>Price</th>
                        </tr>
                         </thead>
                    <tbody>
                        @if(count($items_today)>0)
                            @foreach($items_today as $item_tot)
                            <tr>
                                <td>{{$item_tot->getType($item_tot->type)->type}}</td>
                                <td>{{$item_tot->name}}</td>
                                <td><img src="../uploads/{{$item_tot->photo}}" width="80" height="50" /></td>
                                <td>₱<span class="counter">{{$item_tot->price}}</span></td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td class="text-center" colspan="12">
                                    <br>
                                    <br>
                                <br><img src="{{url('images/blank.png')}}" width="100" height="100">
                                <h2 class="text-center" style="color: #2c303b!important; font-size: 20px;margin-right: -20px;">Nothing added today!!</h2>
                                </td>
                            </tr>
                            @endif
                            <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><h4>₱<span class="counter">{{$total_today}}</span></h4></td>
                        </tr>
                    </tbody>
                </table>
               </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
    </div>
    <div class="modal fade" id="staff_yesterday" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="head-color">
                <br>
                <h1 class="text-center display-4" style="color:white!important;">Yesterday's Asset</h1>
             </div>
              <div class="modal-body">
                <br>
               <div class="table-responsive">
                 <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Item Type</th>
                            <th>Name</th>
                            <th>Photo</th>
                            <th>Price</th>
                        </tr>
                        </thead>
                    <tbody>
                        @if(count($items_yesterday)>0)
                            @foreach($items_yesterday as $item_yes)
                            <tr>
                                <td>{{$item_yes->getType($item_yes->type)->type}}</td>
                                <td>{{$item_yes->name}}</td>
                                <td><img src="../uploads/{{$item_yes->photo}}" width="80" height="60" /></td>
                                <td>₱<span class="counter">{{$item_yes->price}}</span></td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="12"><img src="{{url('images/ani.gif')}}" width="256" height="256" style="margin-left: 9px!important;">
                                 <h2 class="text-center" style="color: #2c303b!important; font-size: 25px;margin-right: -20px;">Nothing here yet!!</h2>
                                </td>
                            </tr>
                            @endif
                            <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><h4>₱<span class="counter">{{$total_yesterday}}</span></h4></td>
                    </tbody>
                </table>
               </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
    </div>
    <div class="modal fade" id="staff_month" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="head-color">
                <br>
                <h1 class="text-center display-4" style="color:white!important;">Last Month Asset</h1>
             </div>
              <div class="modal-body">
                <br>
               <div class="table-responsive">
                 <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Item Type</th>
                            <th>Name</th>
                            <th>Photo</th>
                            <th>Price</th>
                        </tr>
                        </thead>
                    <tbody>
                        @if(count($items_month)>0)
                            @foreach($items_month as $item_mon)
                            <tr>
                                <td>{{$item_mon->getType($item_mon->type)->type}}</td>
                                <td>{{$item_mon->name}}</td>
                                <td><img src="../uploads/{{$item_mon->photo}}" width="80" height="50" /></td>
                                <td>₱<span class="counter">{{$item_mon->price}}</span></td>
                            </tr>
                            @endforeach
                             @else
                            <tr>
                                <td colspan="12"><img src="{{url('images/ani.gif')}}" width="256" height="256" style="margin-left: 9px!important;">
                                 <h2 class="text-center" style="color: #2c303b!important; font-size: 25px;margin-right: -20px;">Nothing here yet!!</h2>
                                </td>
                            </tr>
                            @endif
                            <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><h4>₱<span class="counter">{{$total_month}}</span></h4></td>
                    </tbody>
                </table>
               </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
    </div>
    <div class="">
        <div class="row top_tiles">
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats first-card hvr-grow-shadow">
                    <div class="icon"><img src="{{url('images/graph(1).png')}}" width="50" height="50"></div>
                    <div class="count">₱<span class="counter">{{number_format($totals, 2, '.', ',')}}</span></div>
                    <br>
                    <h3>Overall Assets</h3>

                </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats second-card hvr-grow-shadow">
                    <div class="icon"><img src="{{url('images/website.png')}}" width="50" height="50"></i></div>
                    <div class="count"><span class="counter">{{$counts}}</span></div>
                     <br>
                    <h3>Total Items</h3>

                </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats third-card hvr-grow-shadow">
                    <div class="icon"><img src="{{url('images/group.png')}}" width="50" height="50"></div>
                    <div class="count"><span class="counter">{{$staff}}</span></div>
                     <br>
                    <h3>Branch Staff</h3>

                </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats forth-card hvr-grow-shadow">
                    <div class="icon"><img src="{{url('images/building.png')}}" width="50" height="50"></div>
                    <div class="count"><span class="counter">{{$branch}}</span></div>
                     <br>
                    <h3>Total Branch</h3>

                </div>
            </div>
        </div>
        @if(Auth::user()->usertype == 'admin' && Auth::user()->status == 1)
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="x_panel" style="height:600px;">
                        <div class="x_content" id="app">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                        <div class="col-md-4">
                                            <a class="nav-item nav-link active sa" id="nav-home-tab" role="tab" aria-controls="nav-home" aria-selected="true"  style="font-size: 16px;color: #6b6f82;"><img src="{{url('images/calendar.png')}}" width="20" height="20" /> Today's Asset</a>
                                        </div>
                                        <div class="col-md-4">
                                            <a class="nav-item nav-link sa" id="nav-profile-tab" role="tab" aria-controls="nav-profile" aria-selected="false"  style="font-size: 16px;color: #6b6f82;"><img src="{{url('images/calendar.png')}}" width="20" height="20" /> Yesterday</a>
                                        </div>
                                        <div class="col-md-4">
                                            <a class="nav-item nav-link sa" id="nav-contact-tab" role="tab" aria-controls="nav-contact" aria-selected="false" style="font-size: 16px;color: #6b6f82;"><img src="{{url('images/calendar.png')}}" width="20" height="20" /> Last Month</a>
                                        </div>
                                    </div>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab1" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <br />
                                    <br />
                                    <div class="col-md-6">
                                        <br />
                                        <h1 class="display-2 text-center pull-right" style="font-size:3rem;">₱<span class="counter">{{number_format($total_today, 2, '.', ',')}}</span></h1>
                                    </div>
                                      <div class="col-md-6">
                                          <img src="{{url('images/growth.png')}}" width="80" height="80">
                                      </div>
                                    <br />
                                    <table class="table table-striped" height="350" style="margin-bottom: none!important;">
                                        <thead>
                                            <tr>
                                                <th>Branch</th>
                                                <th>Total Assets</th>
                                                <th>Total Items</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($brans)>0)
                                                @foreach($brans as $bran)
                                                <tr>
                                                    <td>{{$bran->branchname}}</td>
                                                    <td>₱<span class="counter">{{number_format($bran->getTodayAsset($bran->id), 2, '.', ',')}}</span></td>
                                                    <td><span class="counter">{{$bran->getTodayItem($bran->id)}}</span></td>
                                                </tr>
                                                @endforeach
                                                @endif
                                        </tbody>
                                    </table>
                                    <a type="button" class="btn btn-info up btn-lg pull-right" data-toggle="modal" data-target="#exampleModal">
                                         See More
                                    </a>
                                </div>
                                <div class="tab2" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" style="display: none!important;">
                                    <br />
                                    <br />
                                    <div class="col-md-6">
                                        <br />
                                        <h1 class="display-2 text-center pull-right" style="font-size:3rem;">₱<span class="counter">{{number_format($total_yesterday, 2, '.', ',')}}</span></h1>
                                    </div>
                                    <div class="col-md-6">
                                        <img src="{{url('images/graph(2).png')}}" width="80" height="80" />
                                    </div>
                                    <br />
                                    <table class="table table-striped" height="350" style="margin-bottom: none!important;">
                                        <thead>
                                            <tr>
                                                <th>Branch</th>
                                                <th>Total Assets</th>
                                                <th>Total Items</th>
                                            </tr>
                                             </thead>
                                        <tbody>
                                            @if(count($brans)>0)
                                                @foreach($brans as $bran)
                                                <tr>
                                                    <td>{{$bran->branchname}}</td>
                                                    <td>₱<span class="counter">{{number_format($bran->getYesterdayAsset($bran->id), 2, '.', ',')}}</span></td>
                                                    <td><span class="counter">{{$bran->getYesterdayItem($bran->id)}}</span></td>
                                                </tr>
                                                @endforeach
                                                @endif
                                        </tbody>
                                    </table>
                                     <a type="button" class="btn btn-info up btn-lg pull-right" data-toggle="modal" data-target="#yesterday">
                                         See More
                                    </a>
                                </div>
                                <div class="tab3" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" style="display: none;">
                                    <br />
                                    <br />
                                    <div class="col-md-6">
                                        <br />
                                        <h1 class="display-2 text-center pull-right" style="font-size:3rem;">₱<span class="counter">{{number_format($total_month, 2, '.', ',')}}</span></h1>
                                    </div>
                                    <div class="col-md-6">
                                        <img src="{{url('images/bars-chart.png')}}" width="80" height="80" />
                                    </div>
                                    <br />
                                    <table class="table table-striped" height="350" style="margin-bottom: none!important;">
                                        <thead>
                                            <tr>
                                                <th>Branch</th>
                                                <th>Total Assets</th>
                                                <th>Total Items</th>
                                            </tr>
                                              </thead>
                                        <tbody>
                                            @if(count($brans)>0)
                                                @foreach($brans as $bran)
                                                <tr>
                                                    <td>{{$bran->branchname}}</td>
                                                    <td>₱<span class="counter">{{number_format($bran->getMonthAsset($bran->id), 2, '.', ',')}}</span></td>
                                                    <td><span class="counter">{{$bran->getMonthItem($bran->id)}}</span></td>
                                                </tr>
                                                @endforeach
                                                @endif
                                        </tbody>
                                    </table>
                                    <a type="button" class="btn btn-info up btn-lg pull-right" data-toggle="modal" data-target="#month">
                                         See More
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="x_panel" style="height:600px;">
                        <div class="x_title">
                            <h2>All Branch <small>Total</small></h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">

                                      <div class="col-md-6 col-sm-6 col-xs-6" style="margin: 0px auto;display: block;">
                                        <h2 class="display-2 text-center pull-right" style="font-size: 3rem!important;margin-top: 10px"><span class="counter">{{$allbranchtotal}}</span><br>
                                            <small>Total Branch</small>
                                        </h2>
                                    </div>
                                     <div class="col-md-6 col-sm-6 col-xs-6" style="margin: 0px auto;display: block;">
                                        <img src="{{url('images/building(1).png')}}" height="72">

                                    </div>
                                </div>
                            </div>
                            <br>
                            <table class="table table-striped" height="350" style="margin-bottom: 0px!important;">
                                <thead>
                                    <tr>
                                        <th>Branch</th>
                                        <th>Total Assets</th>
                                        <th>Total Items</th>
                                        <th>Action</th>

                                    </tr>
                                     </thead>
                                <tbody>
                                    @if(count($brans)>0)
                                        @foreach($brans as $bran)
                                        <tr>
                                            <td>{{$bran->branchname}}</td>
                                            <td>₱<span class="counter">{{number_format($bran->getAsset($bran->id), 2, '.', ',')}}</span></td>
                                            <td><span class="counter">{{$bran->getItem($bran->id)}}</span></td>
                                            <td><a href="{{route('admin.summary', ['id' => $bran->id])}}" class="btn btn-success view"><i class="fa fa-search"></i> View</a></td>
                                        </tr>
                                        @endforeach
                                        @endif
                                </tbody>
                            </table>
                            <a href="{{route('branch.index')}}" class="btn btn-info btn-lg up pull-right" style="margin-top: 10px;">See more</a>
                        </div>
                    </div>
                </div>
                 <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="col-md-6 col-sm-12 col-xs-12">
                          <div class="x_panel" style="height:600px!important;">
                            <div class="x_title">
                              <h2>Todays Activity<small>Top 5</small></h2>
                              <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                  <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a>
                                    </li>
                                    <li><a href="#">Settings 2</a>
                                    </li>
                                  </ul>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                              </ul>
                              <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                              <ul class="list-unstyled timeline">
                                 <br>
                                @if(count($latest)>0)
                                @foreach($latest as $late)
                                <li>
                                  <div class="block">
                                    <div class="tags">
                                      <a href="#" class="tag">
                                        <span>{{$late->getBranch($late->branchid)->branchname}}</span>
                                      </a>

                                    </div>
                                    <div class="block_content">
                                         <img src="uploads/{{$late->photo}}" width="100" height="80" style="position: absolute; right: 50px;margin-top: -5px!important;">
                                      <h2 class="title">
                                          <a>{{$late->name}}</a>
                                       </h2>
                                      <div class="byline">
                                        <span>{{$late->addedat}}</span> by <a>{{$late->getUser($late->addedby)->name}}</a>
                                      </div>
                                      <p class="excerpt">{{$late->description}}</a>
                                      </p>

                                    </div>
                                  </div>
                                </li>
                                @endforeach
                                @else
                                <img src="{{url('images/ani.gif')}}" width="256" height="256" style="margin-left: 120px!important;">
                                <h2 class="text-center" style="color: #2c303b!important; font-size: 25px;margin-right: -20px;margin-top: -20px;">Nothing here yet!!</h2>
                                @endif
                              </ul>
                            </div>
                          </div>
                     </div>
                 </div>
            </div>
        @else
            <div class="row">
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <div class="x_panel" style="height:600px;">
                        <div class="x_content" id="app">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                        <div class="col-md-4 col-xs-4 col-xs-4">
                                            <a class="nav-item nav-link active sa" id="nav-home-tab" role="tab" aria-controls="nav-home" aria-selected="true" v-on:click="showTab1"><img src="{{url('images/calendar.png')}}" width="20" height="20" style="color: #2c303b!important;" /> Today's Asset</a>
                                        </div>
                                        <div class="col-md-4 col-xs-4 col-xs-4">
                                            <a class="nav-item nav-link sa" id="nav-profile-tab" role="tab" aria-controls="nav-profile" aria-selected="false" v-on:click="showTab2"><img src="{{url('images/calendar.png')}}" width="20" height="20" style="color: #2c303b!important;"/> Yesterday</a>
                                        </div>
                                        <div class="col-md-4 col-xs-4 col-xs-4">
                                            <a class="nav-item nav-link sa" id="nav-contact-tab" role="tab" aria-controls="nav-contact" aria-selected="false" v-on:click="showTab3"><img src="{{url('images/calendar.png')}}" width="20" height="20" style="color: #2c303b!important;"/> Last Month</a>
                                        </div>
                                    </div>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab1" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <br />
                                    <br />
                                    <div class="col-md-6">
                                        <br />
                                        <h1 class="display-2 text-center pull-right" style="font-size:3rem;">₱<span class="counter">{{number_format($total_today, 2, '.', ',')}}</span></h1>
                                    </div>
                                    <div class="col-md-6">
                                        <img src="{{url('images/growth.png')}}" width="80" height="72" />
                                    </div>
                                    <br />
                                    <table class="table table-striped" height="350" style="margin-bottom: none!important;">
                                        <thead>
                                            <tr>
                                                <th>Item Type</th>
                                                <th>Name</th>
                                                <th>Photo</th>
                                                <th>Price</th>
                                            </tr>
                                             </thead>
                                        <tbody>
                                            @if(count($items_today)>0)
                                                @foreach($items_today as $item_tot)
                                                <tr>
                                                    <td>{{$item_tot->getType($item_tot->type)->type}}</td>
                                                    <td>{{$item_tot->name}}</td>
                                                    <td><img src="../uploads/{{$item_tot->photo}}" width="80" height="50" /></td>
                                                    <td>₱<span class="counter">{{$item_tot->price}}</span></td>
                                                </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td class="text-center" colspan="12">
                                                        <br>
                                                        <br>
                                                    <br><img src="{{url('images/blank.png')}}" width="100" height="100">
                                                    <h2 class="text-center" style="color: #2c303b!important; font-size: 20px;margin-right: -20px;">Nothing added today!!</h2>
                                                    </td>
                                                </tr>
                                                @endif
                                        </tbody>
                                    </table>
                                    <a type="button" class="btn btn-info up btn-lg pull-right" data-toggle="modal" data-target="#staff_today">
                                         See More
                                    </a>
                                </div>
                                <div class="tab2" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" style="display: none;">
                                    <br />
                                    <br />
                                    <div class="col-md-6">
                                        <br />
                                        <h1 class="display-2 text-center pull-right" style="font-size:3rem;">₱<span class="counter">{{number_format($total_yesterday, 2, '.', ',')}}</span></h1>
                                    </div>
                                    <div class="col-md-6">
                                        <img src="{{url('images/graph(2).png')}}" width="80" height="80" />
                                    </div>
                                    <br />
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Item Type</th>
                                                <th>Name</th>
                                                <th>Photo</th>
                                                <th>Price</th>
                                            </tr>
                                            </thead>
                                        <tbody>
                                            @if(count($items_yesterday)>0)
                                                @foreach($items_yesterday as $item_yes)
                                                <tr>
                                                    <td>{{$item_yes->getType($item_yes->type)->type}}</td>
                                                    <td>{{$item_yes->name}}</td>
                                                    <td><img src="../uploads/{{$item_yes->photo}}" width="80" height="60" /></td>
                                                    <td>₱<span class="counter">{{$item_yes->price}}</span></td>
                                                </tr>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="12"><img src="{{url('images/ani.gif')}}" width="256" height="256" style="margin-left: 9px!important;">
                                                     <h2 class="text-center" style="color: #2c303b!important; font-size: 25px;margin-right: -20px;">Nothing here yet!!</h2>
                                                    </td>
                                                </tr>
                                                @endif
                                        </tbody>
                                    </table>
                                     <a type="button" class="btn btn-info up btn-lg pull-right" data-toggle="modal" data-target="#staff_yesterday">
                                         See More
                                    </a>
                                </div>
                                <div class="tab3" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                    <br />
                                    <br />
                                    <div class="col-md-6">
                                        <br />
                                        <h1 class="display-2 text-center pull-right" style="font-size:3rem;">₱<span class="counter">{{number_format($total_month, 2, '.', ',')}}</span></h1>
                                    </div>
                                    <div class="col-md-6">
                                        <img src="{{url('images/bars-chart.png')}}" width="80" height="80" />
                                    </div>
                                    <br />
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Item Type</th>
                                                <th>Name</th>
                                                <th>Photo</th>
                                                <th>Price</th>
                                            </tr>
                                            </thead>
                                        <tbody>
                                            @if(count($items_month)>0)
                                                @foreach($items_month as $item_mon)
                                                <tr>
                                                    <td>{{$item_mon->getType($item_mon->type)->type}}</td>
                                                    <td>{{$item_mon->name}}</td>
                                                    <td><img src="../uploads/{{$item_mon->photo}}" width="80" height="50" /></td>
                                                    <td>₱<span class="counter">{{$item_mon->price}}</span></td>
                                                </tr>
                                                @endforeach
                                                 @else
                                                <tr>
                                                    <td colspan="12"><img src="{{url('images/ani.gif')}}" width="256" height="256" style="margin-left: 9px!important;">
                                                     <h2 class="text-center" style="color: #2c303b!important; font-size: 25px;margin-right: -20px;">Nothing here yet!!</h2>
                                                    </td>
                                                </tr>
                                                @endif
                                        </tbody>
                                    </table>
                                     <a type="button" class="btn btn-info up btn-lg pull-right" data-toggle="modal" data-target="#staff_month">
                                         See More
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="x_panel" style="height: 600px;">
                            <div class="x_title">
                              <h2>Todays Activity<small>Top 5</small></h2>
                              <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                  <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a>
                                    </li>
                                    <li><a href="#">Settings 2</a>
                                    </li>
                                  </ul>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                              </ul>
                              <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                              <ul class="list-unstyled timeline">
                                @if(count($latest)>0)
                                @foreach($latest as $late)
                                <li>
                                  <div class="block">
                                    <div class="tags">
                                      <a href="" class="tag">
                                        <span>{{$late->getBranch($late->branchid)->branchname}}</span>
                                      </a>

                                    </div>
                                    <div class="block_content">
                                         <img src="uploads/{{$late->photo}}" width="100" height="80" style="position: absolute; right: 50px;margin-top: -5px!important;">
                                      <h2 class="title">
                                          <a class="titl">{{$late->name}}</a>
                                       </h2>
                                      <div class="byline">
                                        <span>{{$late->addedat}}</span> by <a class="by">{{$late->getUser($late->addedby)->name}}</a>
                                      </div>
                                      <p class="desc">{{$late->description}}</a>
                                      </p>

                                    </div>
                                  </div>
                                </li>
                                @endforeach
                                @else
                                <img src="{{url('images/ani.gif')}}" width="256" height="256" style="margin-left: 142px!important;">
                                <h2 class="text-center" style="color: #2c303b!important; font-size: 25px;margin-right: -20px;">Nothing here yet!!</h2>
                                @endif
                              </ul>
                            </div>
                          </div>
                     </div>
            </div>
        @endif
    </div>
</div>

<!-- /page content -->

@endsection
@section('footer-assets')

 <script>
   $("#nav-home-tab").click(function(){
            $(".tab1").show();
            $(".tab2").hide();
            $(".tab3").hide();
    });
     $("#nav-profile-tab").click(function(){
            $(".tab2").show();
            $(".tab1").hide();
            $(".tab3").hide();
    });
      $("#nav-contact-tab").click(function(){
            $(".tab3").show();
            $(".tab2").hide();
            $(".tab1").hide();
    });

 </script>

<script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
<script src="{{asset('../js/jquery.counterup.min.js')}}"></script>
<script src="{{asset('js/toastr.min.js')}}"></script>
           <script type="text/javascript">
              @if(Session::has('message'))
              var type = "{{Session::get('alert-type','success')}}";
              switch(type){
                case 'success':
                toastr.success("{{Session::get('message')}}");
                break;
              }

             @endif
          </script>
@endsection