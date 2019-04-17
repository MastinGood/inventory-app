@extends('layouts.admin-template')
@section('content')
@section('header-asset')
<!-- Notificationa -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/toastr.min.css')}}">
@endsection
<!-- page content -->
        @if(Auth::user()->usertype == 'admin' && Auth::user()->status == 1)
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Add Branch</h3>
              </div>
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

                    <form id="demo-form2" method="POST" action="{{route('branch.update', ['branch' => $branch->id])}}" data-parsley-validate class="form-horizontal form-label-left">
                      @method('PATCH');
                      @csrf
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Branch Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="branchname" id="first-name" required="required" class="form-control col-md-7 col-xs-12 {{ $errors->has('branchname') ? ' is-invalid' : '' }}" value="{{$branch->branchname}}">
                          @if ($errors->has('branchname'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('branchname') }}</strong>
                              </span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Status <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control col-md-7 col-xs-12 {{ $errors->has('status') ? ' is-invalid' : '' }}" name="status">
                            <option value="1" {{ $branch->status == 1 ? 'selected' : '' }} > Active</option>
                            <option value="0" {{ $branch->status == 0 ? 'selected' : '' }}> Not Active</option>
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
                          <a href="{{route('branch.index')}}" class="btn btn-primary">Back</a>
                          <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success">Update</button>
                        </div>
                      </div>
                    </form>
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
        <!-- jQuery Tags Input -->
        <script src="{{asset('../vendors/jquery.tagsinput/src/jquery.tagsinput.js')}}"></script>
        <!-- Select2 -->
        <script src="{{asset('../vendors/select2/dist/js/select2.full.min.js')}}"></script>
        <!-- Parsley -->
        <script src="{{asset('../vendors/parsleyjs/dist/parsley.min.js')}}"></script>
        <!-- Autosize -->
        <script src="{{asset('../vendors/autosize/dist/autosize.min.js')}}"></script>
        <!-- jQuery autocomplete -->
        <script src="{{asset('../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js')}}"></script>
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
@endsection
