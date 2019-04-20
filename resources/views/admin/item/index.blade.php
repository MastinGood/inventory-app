@extends('layouts.admin-template')

@section('content')
@section('header-asset')
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
                <h3>ITEM <small>List</small></h3>
              </div>
              <div class="title_right">
                    <a href="{{route('admin.item.add')}}" class="btn btn-info btn-lg pull-right up"><img src="{{asset('images/add.png')}}" height="25" width="25"> Add ITEM </a>
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
                        <div class="col-md-12">
                           <form class="form-horizontal" action="{{route('admin.item.search')}}" method="POST">
                              @csrf
                              <div class="col-md-6">
                                <label>Start Date - End Date</label>
                                  <fieldset>
                                    <div class="control-group">
                                      <div class="controls">
                                        <div class="input-prepend input-group">
                                          <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                          <input type="text" style="width: 400px" name="search" id="reservation" class="form-control" value="new Date()" />
                                        </div>

                                      </div>
                                    </div>
                                  </fieldset>
                              </div>
                              <div class="col-md-2">
                                <br>
                                <button type="submit" class="btn btn-success btn-lg se" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Loading...">Search</button>
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
                          <th>Item Code</th>
                          <th>Item Name</th>
                          <th>Price</th>
                          <th class="col-md-3">Description</th>
                          <th>Added By</th>
                          <th>Status</th>
                          <th><i class="fa fa-settings"></i>Action</th>
                        </tr>
                      </thead>


                      <tbody>
                      @if(count($items)> 0)
                      @foreach($items as $item)
                        <tr>
                          <td>{{$item->getBranch($item->branchid)->branchname}}</td>
                          <td><img src="/uploads/{{$item->photo}}" width="120" height="80"></td>
                          <td>{{$item->item_code}}</td>
                          <td>{{$item->name}}</td>
                          <td>P{{$item->price}}</td>
                          <td>{{$item->description}}</td>
                          <td>{{$item->getUser($item->addedby)->name}}</td>
                         <td class="text-success">
                              @if($item->status == 1)
                              <i class="fa fa-circle text-success"></i> Active
                              @else
                              <p class="text-danger">Not Active</p>
                              @endif
                            </td>
                            <td class="text-center">
                                <a href="{{route('admin.item.edit', ['id' => $item->id])}}" class="btn btn-primary normal" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Wait..."><span class="glyphicon glyphicon-edit"></span> Edit</a>
                                <a href="{{route('admin.item.delete', ['id' => $item->id])}}" class="btn btn-danger normal" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Removing..."><span class="glyphicon glyphicon-remove"></span> Remove</a>
                            </td>
                        </tr>
                      @endforeach

                      @endif
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @elseif(Auth::user()->usertype == 'staff' && Auth::user()->status == 0 || Auth::user()->status == 3 )
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
          $('.se').on('click', function() {
              var $this = $(this);
            $this.button('loading');
              setTimeout(function() {
                 $this.button('reset');
             }, 8000);
          });
          $('.normal').on('click', function() {
              var $this = $(this);
            $this.button('loading');
              setTimeout(function() {
                 $this.button('reset');
             }, 2000);
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
