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
                  <h3>Staff <small>List</small></h3>
                </div>

                <div class="title_right">

                      <a href="{{route('staff.add')}}" class="btn btn-info btn-lg pull-right up"><img src="{{asset('images/add.png')}}" height="25" width="25"> Add Staff</a>

                </div>
              </div>

              <div class="clearfix"></div>

              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_content">
                      <table id="datatable-buttons" class="table table-striped table-bordered col-md-12 col-sm-12 col-xs-12">
                        <thead>
                          <tr>
                            <th>Branch ID</th>
                            <th>Name</th>
                            <th>User Type</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>


                        <tbody>
                          @if(count($users)>0)
                          @foreach($users as $user)
                          <tr>
                              <td class="text-center">{{$user->branchid}}</td>
                              <td class="text-center">{{$user->name}}</td>
                              <td class="text-center">{{$user->usertype}}</td>
                              <td class="text-center">{{$user->email}}</td>
                              @if($user->status == 1)
                              <td class="text-center text-success" style="color: #4cb84a!important;">
                                <i class="fa fa-circle text-success pulse"></i> Active
                              </td>
                               @else
                                <td class="text-center text-danger">
                                <i class="fa fa-circle text-danger"></i>  Not Active
                              </td>
                              @endif
                              <td class="text-center">
                                  <a href="{{route('staff.edit', ['user' => $user->id])}}" class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                                  @if($user->status == 1)
                                  <a href="{{route('staff.delete', ['user' => $user->id])}}" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Remove</a>
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
