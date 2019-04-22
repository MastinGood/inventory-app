@extends('layouts.admin-template')
@section('content')
@section('header-assets')
<!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/toastr.min.css')}}">
@endsection
<!-- page content -->
        @if(Auth::user()->usertype == 'admin' && Auth::user()->status == 1)
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Add Type</h3>
                <br>
              </div>
              <br>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Form</h2>
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
                    <br />
                    <form id="demo-form2" action="{{route('admin.type.store')}}" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                      @csrf
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Item Type <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" name="type" required="required" class="form-control col-md-7 col-xs-12{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{old('name')}}" >
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                      </div>
                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Assign Branch <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control col-md-7 col-xs-12" name="branch">
                              @if(count($branch)> 0)
                              @foreach($branch as $bra)
                                <option value="{{$bra->id}}">{{$bra->branchname}}</option>
                              @endforeach
                              @endif
                          </select>
                          @if ($errors->has('branch'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('branch') }}</strong>
                                </span>
                            @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Status <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control col-md-7 col-xs-12" name="status">
                            <option value="1" selected>Active</option>
                            <option value="0">Not Active</option>
                          </select>
                          @if ($errors->has('status'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                            @endif
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="{{route('type.index')}}" class="btn btn-primary" type="button">Back</a>
                          <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success normal" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Loading...">Submit</button>
                        </div>
                      </div>
                    </form>
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
        <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
        <!-- bootstrap-wysiwyg -->
        <script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
        <script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
        <script src="../vendors/google-code-prettify/src/prettify.js"></script>
        <!-- jQuery Tags Input -->
        <script src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
        <!-- Switchery -->
        <script src="../vendors/switchery/dist/switchery.min.js"></script>
        <!-- Select2 -->
        <script src="../vendors/select2/dist/js/select2.full.min.js"></script>
        <!-- Parsley -->
        <script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
        <!-- Autosize -->
        <script src="../vendors/autosize/dist/autosize.min.js"></script>
        <!-- jQuery autocomplete -->
        <script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
        <!-- starrr -->
        <script src="../vendors/starrr/dist/starrr.js"></script>
        @endsection
@endsection
