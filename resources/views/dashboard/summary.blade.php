 @extends('layouts.admin-template')
 @section('content')
 <!-- page content -->
      @if(Auth::user()->usertype == 'admin' && Auth::user()->status == 1)
        <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Branch Summary</h2>
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
						  <br>
                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row">
                        <div class="col-xs-12 invoice-header">
                          <h1>
                            <img src="{{url('images/3d-building(1).png')}}" width="50" height="50"> {{$branch->branchname}}
                                <small class="pull-right">As Of : {{Carbon\Carbon::now()->format('M d Y')}}</small>
                                      </h1>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->

                      <!-- /.row -->

                      <!-- Table row -->
                      <div class="row">
                      	<br>
                        <div class="col-xs-12 table">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>Item Type</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th style="width: 50%">Description</th>
                                <th>Added At</th>
                              </tr>
                            </thead>
                            <tbody>
                            	@if(count($items))
                              @foreach($items as $item)
                								<tr>
                									<td>{{$item->getType($item->type)->type}}</td>
                									<td><img src="/uploads/{{$item->photo}}" width="70" height="70"></td>
                									<td>{{$item->name}}</td>
                									<td>₱{{number_format($item->price, 2, '.', ',')}}</td>
                									<td>{{$item->description}}</td>
                									<td>{{$item->addedat}}</td>
                								</tr>
                								@endforeach
                								@endif
                            </tbody>
                          </table>
                          <hr>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <div class="row">
                        <div class="col-xs-12">
          							<div class="col-md-4">
          							<h2 class="text-center">Total Assets</h2>
          							<h1 class="text-center">₱{{number_format($tots, 2, '.', ',')}}</h1>
          							</div>
          							<div class="col-md-4">
          							<h2 class="text-center"><span class="glyphicon glyphicon-tags"></span> Total Items</h2>
          							<h1 class="text-center">{{$itemscount}}</h1>
          							</div>
          							<div class="col-md-4">
          							<h2 class="text-center"><span class="glyphicon glyphicon-user"></span> Total Staff</h2>
          							<h1 class="text-center">{{$staff}}</h1>
          							</div>
          							<br>
                        </div>

                      </div>
                      <!-- /.row -->

                      <!-- this row will not appear when printing -->
                      <div class="row no-print">
                      	<br>
                        <div class="col-xs-12">
                          <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                          <a href="{{route('summary.pdf', ['id' => $branch->id])}}" class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</a>
                        </div>
                      </div>
                    </section>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      @elseif(Auth::user()->usertype == 'admin' && Auth::user()->status == 0 || Auth::user()->status == 3 )
      @include('error.ban')
      @else
      @include('error.404')
      @endif
        <!-- /page content -->
@endsection