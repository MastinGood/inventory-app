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

@endsection
<!-- page content -->
        @if(Auth::user()->usertype == 'admin' && Auth::user()->status == 1)
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Branch <small>List</small></h3>
              </div>

              <div class="title_right">

                    <a href="{{route('branch.add')}}" class="btn btn-info btn-lg pull-right up"><img src="{{asset('images/add.png')}}" height="25" width="25"> Add Branch</a>

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
                          <th>Branch ID</th>
                          <th>Name</th>
                          <th>Status</th>
                          <th class="col-md-3">Action</th>
                        </tr>
                      </thead>


                      <tbody>
                        @if(count($branches)>0)
                        @foreach($branches as $branch)
                        <tr>
                          <td class="text-center">{{$branch->id}}</td>
                          <td class="text-center">{{$branch->branchname}}</td>
                          @if($branch->status == 1)
                          <td class="text-center text-success" style="color: #4cb84a!important;">
                            <i class="fa fa-circle text-success"></i> Active
                          </td>
                           @else
                            <td class="text-center text-danger" style="color: #a94442!important;">
                            <i class="fa fa-circle text-danger"></i>  Not Active
                          </td>
                            @endif
                          <td class="col-md-4 text-center">
                            <a href="{{route('admin.summary', ['id' => $branch->id])}}" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span> View</a>
                              <a href="{{route('branch.edit', ['id' => $branch->id])}}" class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                              @if($branch->status == 1)
                              <a href="{{route('branch.destroy', ['id' => $branch->id])}}" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Remove</a>
                              @endif
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
