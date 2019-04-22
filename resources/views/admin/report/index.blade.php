@extends('layouts.admin-template')

@section('content')
@section('header-assets')
<!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/toastr.min.css')}}">
    <link href="{{asset('../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="{{asset('../vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

@endsection
<!-- page content -->
        @if(Auth::user()->usertype == 'admin' && Auth::user()->status == 1)
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Report <small>List</small></h3>
                <br>
              </div>

             <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h5>Search Item <span class="glyphicon glyphicon-search"></span></h5>
                  </div>
                  <div class="x_content">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="row">
                        <div class="col-md-12 ol-sm-12 col-xs-12">
                           <form class="form-horizontal" action="{{route('admin.report.generate')}}" method="POST">
                              @csrf
                              <div class="col-md-4 col-sm-6 col-xs-12">
                                <label>Start Date - End Date</label>
                                  <fieldset>
                                    <div class="control-group">
                                      <div class="controls">
                                        <div class="input-prepend input-group">
                                          <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                          <input type="text" name="date" id="reservation" class="form-control col-md-4 col-sm-8 colxs-12" value="new Date()" />
                                        </div>

                                      </div>
                                    </div>
                                  </fieldset>
                              </div>
                              <div class="col-md-3 col-sm-6 col-xs-12">
                                <label>Branch</label>
                                <select name="branch" class="form-control">
                                  <option value="all" selected>All</option>
                                 @if(count($branchs)>0)
                                 @foreach($branchs as $bran)
                                 <option value="{{$bran->id}}">{{$bran->branchname}}</option>
                                 @endforeach
                                 @endif
                                </select>
                              </div>
                              <div class="col-md-3 col-sm-12 col-xs-12">
                                <label>Item Type</label>
                                <select name="type" class="form-control">
                                  <option value="all" selected>All</option>
                                  @if(count($types)>0)
                                 @foreach($types as $type)
                                 <option value="{{$type->id}}">{{$type->type}} ({{$type->getBranch($type->branchid)->branchname}})</option>
                                 @endforeach
                                 @endif
                                </select>
                              </div>
                              <div class="col-md-2 col-sm-6 col-xs-12">
                                <br>
                                <button type="submit" class="btn btn-success btn-lg se1" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Loading...">Generate Report</button>
                              </div>
                           </form>
                        </div>
                      </div>
                  </div>
                </div>
                </div>
              </div>
             </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Branch</th>
                           <th class="col-md-2">Photo</th>
                          <th>Item Type</th>
                          <th>Item Name</th>
                          <th>Price</th>
                          <th class="col-md-3">Description</th>
                          <th>Added By</th>
                          <th>Added At</th>
                        </tr>
                      </thead>


                      <tbody>
                       @if(count($items)> 0)
                        @foreach($items as $item)
                          <tr>
                            <td>{{$item->getBranch($item->branchid)->branchname}}</td>
                            <td><img src="/uploads/{{$item->photo}}" width="100" height="100"></td>
                            <td>{{$item->getType($item->type)->type}}</td>
                            <td>{{$item->name}}</td>
                            <td>₱{{number_format($item->price, 2, '.', ',')}}</td>
                            <td>{{$item->description}}</td>
                            <td>{{$item->getUser($item->addedby)->name}}</td>
                          <td>{{$item->addedat}}</td>
                          </tr>
                          @endforeach
                        @endif
                      </tbody>

                    </table>

                    <div class="col-md-12" style="border-top: 2px solid #E6E9ED;">
                       <br>
                      <div class="row mt-3">
                        <div class="col-md-2 pull-right text-center mt-5" style="color: #505458;">
                          <label>Total Assets :</label><p class="lead"> ₱{{number_format($totals, 2, '.', ',')}}</p>
                        </div>
                        <div class="col-md-2 pull-right text-center mt-5" style="color: #505458;">
                          <label>Total Items :</label><p class="lead"> {{$counts}}</p>
                        </div>

                        <div class="col-md-2 pull-right text-center mt-5" style="color: #505458;">
                          <label>Branch :</label><p class="lead"> {{ $brans}}</p>
                        </div>
                        <div class="col-md-2 pull-right text-center mt-5" style="color: #505458;">
                          <label>To :</label><p class="lead"> {{$to}}</p>
                        </div>
                        <div class="col-md-2 pull-right text-center mt-5" style="color: #505458;">
                          <label>From :</label><p class="lead"> {{$from}}</p>
                        </div>

                      </div>

                    </div>
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
        @section('footer-assets')
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
           <script src="{{asset('../vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
            <script>
            $('#myDatepicker').datetimepicker();

            $('#myDatepicker2').datetimepicker({
                format: 'DD.MM.YYYY'
            });

            $('#myDatepicker3').datetimepicker({
                format: 'hh:mm A'
            });

            $('#myDatepicker4').datetimepicker({
                ignoreReadonly: true,
                allowInputToggle: true
            });

            $('#datetimepicker6').datetimepicker();

            $('#datetimepicker7').datetimepicker({
                useCurrent: false
            });

            $("#datetimepicker6").on("dp.change", function(e) {
                $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
            });

            $("#datetimepicker7").on("dp.change", function(e) {
                $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
            });
        </script>
        <script type="text/javascript">
          $('.btn').on('click', function() {
              var $this = $(this);
            $this.button('loading');
              setTimeout(function() {
                 $this.button('reset');
             }, 3000);
          });

        </script>
        <script src="{{asset('../vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
        <script src="{{asset('../vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
        <script src="{{asset('../vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
        <script src="{{asset('../vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
        <script src="{{asset('../vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
        <script src="{{asset('../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
        <script src="{{asset('../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
        <script src="{{asset('../vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{asset('../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
        <script src="{{asset('../vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
        <script src="{{asset('../vendors/jszip/dist/jszip.min.js')}}"></script>
        <script src="{{asset('../vendors/pdfmake/build/pdfmake.min.js')}}"></script>
        <script src="{{asset('../vendors/pdfmake/build/vfs_fonts.js')}}"></script>
        @endsection
@endsection
