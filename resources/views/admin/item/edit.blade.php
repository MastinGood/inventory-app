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
                <h3>Add Item</h3>
                <br>
              </div>
              <br>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Item Details</h2>
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
                    <form id="demo-form2" action="{{route('admin.item.update', ['id' => $item->id])}}" method="POST" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
                      @method('PATCH');
                      @csrf
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Item Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" name="name" required="required" class="form-control col-md-7 col-xs-12{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{$item->name}}" >
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                      </div>
                       <input type="hidden" name="id" value="{{$item->id}}">
                       <input type="hidden" name="addedby" value="{{$item->addedby}}">
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Item Code <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" name="item_code" required="required" class="form-control col-md-7 col-xs-12{{ $errors->has('item_code') ? ' is-invalid' : '' }}" value="{{$item->item_code}}" >
                            @if ($errors->has('item_code'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('item_code') }}</strong>
                                </span>
                            @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Type <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control col-md-7 col-xs-12{{ $errors->has('type') ? ' is-invalid' : '' }}" name="type">
                            @if(count($types))
                              @foreach($types->all() as $type)
                              <option value="{{$type->id}}-{{$type->getBranch($type->branchid)->id}}" @if($type->id == $item->type) selected @endif>{{$type->type}} ({{$type->getBranch($type->branchid)->branchname}})</option>
                              @endforeach
                            @endif
                          </select>
                            @if ($errors->has('type'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('type') }}</strong>
                                </span>
                                @else
                                <span class="invalid-feedback" role="alert">
                                    <strong>* Note that this branch should match to branch you choose after.</strong>
                                </span>
                            @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Choose Branch <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control col-md-7 col-xs-12{{ $errors->has('type') ? ' is-invalid' : '' }}" name="branch">
                            @if(count($branch))
                              @foreach($branch->all() as $bra)
                              <option value="{{$bra->id}}" @if($bra->id == $item->branchid) selected @endif>{{$bra->branchname}}</option>
                              @endforeach
                            @endif
                          </select>
                            @if ($errors->has('type'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('type') }}</strong>
                                </span>
                            @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Price <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="first-name" name="price" required="required" class="form-control col-md-7 col-xs-12{{ $errors->has('price') ? ' is-invalid' : '' }}" value="{{$item->price}}" >
                            @if ($errors->has('price'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('price') }}</strong>
                                </span>
                            @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Description <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea class="form-control col-md-7 col-xs-12{{ $errors->has('description') ? ' is-invalid' : '' }}" value="{{$item->description}}" name="description">{{$item->description}}</textarea>
                            @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Status <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control col-md-7 col-xs-12" name="status">
                            <option value="1" @if($item->type == 1) selected="selected" @else @endif>Active</option>
                            <option value="0" @if($item->type == 0) selected="selected" @else @endif>Not Active</option>
                          </select>
                          @if ($errors->has('status'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                            @endif
                        </div>
                        </div>
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Choose New
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" id="src" name="photo" class="form-control col-md-7 col-xs-12{{ $errors->has('photo') ? ' is-invalid' : '' }}" value="{{old('photo')}}" >
                            @if ($errors->has('photo'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('photo') }}</strong>
                                </span>
                            @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Current Photo
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <img id="target" name="up" src="/uploads/{{$item->photo}}" alt="" height="250" width="280" />
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <a href="{{route('items.index')}}" class="btn btn-primary" type="button">Back</a>
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
              var type = "{{Session::get('alert-type','warning')}}";
              switch(type){
                case 'warning':
                toastr.warning("{{Session::get('message')}}");
                break;
              }

             @endif
          </script>
          <script type="text/javascript">
           function showImage(src,target) {
            var fr=new FileReader();
            // when image is loaded, set the src of the image where you want to display it
            fr.onload = function(e) { target.src = this.result; };
            src.addEventListener("change",function() {
              // fill fr with image data
              fr.readAsDataURL(src.files[0]);
            });
          }

          var src = document.getElementById("src");
          var target = document.getElementById("target");
          showImage(src,target);
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
