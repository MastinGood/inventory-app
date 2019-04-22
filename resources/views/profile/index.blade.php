@extends('layouts.admin-template')
@section('header-assets')
<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/toastr.min.css')}}">
@endsection
@section('content')
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>User Profile</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <img src="{{url('images/bg-img1.jpg')}}" style="width: 100%;">
                <div class="x_panel">


                    <div class="clearfix"></div>

                  <div class="x_content">
                    <div class="col-md-3 col-sm-12 col-xs-12 profile_left" style="margin-top: -100px;">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          @if(isset($profile->photo) && $profile->photo !=null)
                          <img class="img-responsive avatar-view" src="/profile/{{$profile->photo}}" width="120" style="border-radius: 50%;border:4px solid white;height: 123px!important;" alt="Avatar" title="Change the avatar">
                          @else
                          <img class="img-responsive avatar-view" src="{{url('images/placeholder.jpg')}}" width="120" height="120" style="border-radius: 50%;border:4px solid white;" alt="Avatar" title="Change the avatar">
                          @endif
                        </div>
                      </div>
                      <h3>{{ $profile->getName($profile->userid)->name ?? 'Not specified' }}</h3>

                      <ul class="list-unstyled user_data">
                        <li><i class="fa fa-map-marker user-profile-icon"> </i> {{ $profile->address ?? 'Not specified' }}
                        </li>

                        <li>
                          <i class="fa fa-briefcase user-profile-icon"> </i> @if($profile->birthdate == null) Not specified @else {{$profile->getDate($profile->birthdate)}}@endif
                        </li>

                        <li class="m-top-xs">
                          <i class="fa fa-external-link user-profile-icon"></i>
                          <a href="http://www.kimlabs.com/profile/" target="_blank">{{ $profile->website ?? 'Not specified' }}</a>
                        </li>
                      </ul>
                      @if($id == auth()->user()->id)
                      <a class="btn btn-success" data-toggle="modal" data-target="#showModal"><i class="fa fa-edit m-right-xs"></i>Change Profile</a>
                      <br />
                      @else
                      <br>

                      @endif

                      <!-- start skills -->
                      <h4>Contact Information</h4>
                      <ul class="list-unstyled user_data">
                        <li style="border-bottom: 1px dotted #e6e6e6;padding: 10px;">
                          <label>Email</label>
                          <p>{{ $profile->getName($profile->userid)->email ?? 'Not specified' }}</p>
                        </li>
                        <li style="border-bottom: 1px dotted #e6e6e6;padding: 10px;">
                          <label>Mobile Number</label>
                          <p>{{ $profile->mobile_number ?? 'Not specified' }}</p>
                        </li>
                        <li style="border-bottom: 1px dotted #e6e6e6;padding: 10px;">
                          <label>Facebook</label>
                         <p>{{ $profile->facebook ?? 'Not specified' }}</p>
                        </li>
                        <li style="border-bottom: 1px dotted #e6e6e6;padding: 10px;">
                          <label>Skype</label>
                          <p>{{ $profile->skype ?? 'Not specified' }}</p>
                        </li>
                      </ul>
                      <!-- end of skills -->
                      <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <img src="{{url('images/bg-img1.jpg')}}" style="width: 100%;">
                        <div class="row">
                          @if(!empty(getImage()) && getImage() !==null)
                          <img id="target" style="border-radius: 50%;display: block;margin:0px auto;margin-top: -50px;border:3px solid #fff;" src="/profile/{{getImage()}}" alt="" height="120" width="120" />
                          @else
                          <img id="target" style="border-radius: 50%;display: block;margin:0px auto;margin-top: -50px;border:3px solid #fff;" src="{{asset('images/placeholder.jpg')}}" alt="" height="120" width="120" />
                          @endif
                        </div>
                          <div class="col-md-12 colsm-12 col-xs-12">
                            <br>
                              <h4>Change Profile</h4>
                              <form method="POST" action="{{route('changePic', ['id' => $profile->id])}}" enctype="multipart/form-data">
                                  @method('PATCH')
                                  @csrf
                                  <div class="input-group">

                                      <label class="input-group-btn">
                                          <span class="btn btn-primary" style="height: 40px;">
                                              Browse&hellip; <input type="file" name="photo" id="src" style="display: none;" multiple>
                                          </span>
                                      </label>
                                      <input type="text"  class="form-control" readonly style="border-left: 0px!important;border-radius: 0px!important;width: 200px!important;">

                                  </div>
                                  <span class="help-block">

                          </div>
                          <div class="col-md-6 col-md-offset-6">
                          <br>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-success normal" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Loading...">Update</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">

                      <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Recent Activity</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Personal Information</a>
                          </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                            <!-- start recent activity -->
                            <ul class="messages">
                              @if(count($items))
                              @foreach($items as $item)
                              <li>
                                @if(!empty(getImage()) && getImage() !==null)
                                <img src="/profile/{{$profile->photo}}" style="border-radius: 50%;" class="avatar" alt="Avatar">
                                @else
                                <img src="/images/placeholder.jpg" style="border-radius: 50%;" class="avatar" alt="Avatar">
                                @endif
                                <div class="message_date">
                                  <h3 class="date text-info">{{\Carbon\Carbon::parse($item->addedat)->format('d')}}</h3>
                                  <p class="month">{{\Carbon\Carbon::parse($item->addedat)->format('M')}}</p>
                                </div>
                                <div class="message_wrapper">
                                  <h4 class="heading">{{$item->getUser($item->addedby)->name}} <small>added a {{$item->name}} ({{$item->item_code}})</small></h4>
                                  <blockquote class="message">{{$item->description}}</blockquote>
                                  <img src="/uploads/{{$item->photo}}" width="140" height="140" alt="Avatar">
                                  <br />
                                  <p class="url" style="margin-top: 10px;">
                                    <span class="fs1 text-info mt-3" aria-hidden="true" data-icon=""></span>
                                    <a href="#" style="margin-top:10px; font-size: 13px;><i class="far fa-clock"></i> {{$item->created_at->diffForHumans()}} </a>
                                  </p>
                                </div>
                              </li>
                              @endforeach
                              @else
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="row">
                                  <br>
                                   <br><img src="{{url('images/blank.png')}}" width="100" height="100" style="margin: 0px auto;display: block;">
                                   <br>
                                <h2 class="text-center" style="color: #2c303b!important; font-size: 20px;margin-right: -20px;">Nothing added yet!!</h2>
                                </div>
                              </div>
                              @endif
                            </ul>
                            <!-- end recent activity -->

                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                              <div class="x_title" style="border: none!important;">
                                <h2>Personal Details</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                  @if($id == auth()->user()->id)
                                  <button class="btn btn-info up" id="formButton"><i class="fa fa-edit"></i> Edit</button>
                                  @else
                                  @endif
                                </ul>
                                <div class="clearfix"></div>
                              </div>
                              <div class="row">
                                <form id="form2">
                                  <div class="col-md-6 col-sm-9 col-xs-12">
                                  <table class="table m-0">
                                    <tbody>
                                      <tr>
                                        <th>Full Name</th>
                                        <td>{{ $profile->getName($profile->userid)->name ?? 'Not specified' }}</td>
                                      </tr>
                                      <tr>
                                        <th>Gender</th>
                                        <td>{{ $profile->gender ?? 'Not specified' }}</td>
                                      </tr>
                                      <tr>
                                        <th>Birthdate</th>
                                        <td>{{ $profile->birthdate ?? 'Not specified' }}</td>
                                      </tr>
                                      <tr>
                                        <th>Marital Status</th>
                                        <td>{{ $profile->marital_status ?? 'Not specified' }}</td>
                                      </tr>
                                      <tr>
                                        <th>Address</th>
                                        <td>{{ $profile->address ?? 'Not specified' }}</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                                <div class="col-md-6 col-sm-9 col-xs-12">
                                  <table class="table m-0">
                                    <tbody>
                                      <tr>
                                        <th>Email</th>
                                        <td>{{ $profile->getName($profile->userid)->email ?? 'Not specified' }}</td>
                                      </tr>
                                      <tr>
                                        <th>Mobile no.</th>
                                        <td>{{ $profile->mobile_number ?? 'Not specified' }}</td>
                                      </tr>
                                      <tr>
                                        <th>Facebook</th>
                                        <td>{{ $profile->facebook ?? 'Not specified' }}</td>
                                      </tr>
                                      <tr>
                                        <th>Skype</th>
                                        <td>{{ $profile->skype ?? 'Not specified' }}</td>
                                      </tr>
                                      <tr>
                                        <th>Website</th>
                                        <td>{{ $profile->website ?? 'Not specified' }}</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                                </form>
                                <form id="form1" style="display:none;" method="POST" action="{{route('update_profile', ['id' => $profile->id])}}">
                                  @method('PATCH')
                                  @csrf
                                   <div class="col-md-6 col-sm-9 col-xs-12">
                                  <table class="table m-0">
                                    <tbody>
                                      <tr>
                                        <th>Full Name</th>
                                        <td>
                                          <input type="text" name="name" value="{{ $profile->getName($profile->userid)->name ?? 'Not specified' }}" class="form-control" required="required">
                                          @if ($errors->has('name'))
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $errors->first('name') }}</strong>
                                              </span>
                                          @endif
                                        </td>
                                      </tr>
                                      <tr>
                                        <th>Gender</th>
                                        <td><select class="form-control" name="gender" required="required">
                                          <option value="Male" @if($profile->gender == "Male") selected @endif)>Male</option>
                                          <option value="Female" @if($profile->gender == "Female") selected @endif>Female</option>
                                        </select></td>
                                      </tr>
                                      <tr>
                                        <th>Birthdate</th>
                                        <td><input type="date" name="birthdate" class="form-control" required="required" value="{{ $profile->birthdate ?? null }}">
                                          @if ($errors->has('birthdate'))
                                              <span class="invalid-feedback" role="alert">
                                                  <strong class="st">{{ $errors->first('birthdate') }}</strong>
                                              </span>
                                          @endif
                                        </td>
                                      </tr>
                                      <tr>
                                        <th>Marital Status</th>
                                        <td>
                                          <select class="form-control" name="marital_status">
                                            <option value="Single" @if($profile->marital_status == "Single") selected @endif)>Single</option>
                                            <option value="Married" @if($profile->marital_status == "Married") selected @endif>Married</option>
                                            <option value="Complicated" @if($profile->marital_status == "Complicated") selected @endif>Complicated</option>
                                            <option value="Windowed" @if($profile->marital_status == "Windowed") selected @endif>Windowed</option>
                                          </select>
                                        </td>
                                      </tr>
                                      <tr>
                                        <th>Address</th>
                                        <td><input type="text" name="address" class="form-control" required="required" value="{{ $profile->address ?? old('address') }}">
                                          @if ($errors->has('address'))
                                              <span class="invalid-feedback" role="alert">
                                                  <strong class="st">{{ $errors->first('address') }}</strong>
                                              </span>
                                          @endif</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                                <div class="col-md-6 col-sm-9 col-xs-12">
                                  <table class="table m-0">
                                    <tbody>
                                       <tr>
                                        <th>Email</th>
                                        <td><input type="text" value="{{auth()->user()->email}}" name="email" class="form-control" required="required">
                                        @if ($errors->has('email'))
                                              <span class="invalid-feedback" role="alert">
                                                  <strong class="st">{{ $errors->first('email') }}</strong>
                                              </span>
                                          @endif
                                        </td>
                                      </tr>
                                      <tr>
                                        <th>Mobile Number</th>
                                        <td><input type="text" name="mobile_number" class="form-control" required="required" value="{{ $profile->mobile_number ?? old('mobile_number')}}">
                                          @if ($errors->has('mobile_number'))
                                              <span class="invalid-feedback" role="alert">
                                                  <strong class="st">{{ $errors->first('mobile_number') }}</strong>
                                              </span>
                                          @endif
                                        </td>
                                      </tr>
                                      <tr>
                                        <th>Facebook</th>
                                        <td><input type="url" name="facebook" class="form-control" required="required" value="{{ $profile->facebook ?? old('facebook') }}">
                                          @if ($errors->has('facebook'))
                                              <span class="invalid-feedback" role="alert">
                                                  <strong class="st">{{ $errors->first('facebook') }}</strong>
                                              </span>
                                          @endif
                                        </td>
                                      </tr>
                                      <tr>
                                        <th>Skype</th>
                                        <td><input type="text" name="skype" class="form-control" required="required" value="{{ $profile->skype ?? old('skype') }}">
                                          @if ($errors->has('skype'))
                                              <span class="invalid-feedback" role="alert">
                                                  <strong class="st">{{ $errors->first('skype') }}</strong>
                                              </span>
                                          @endif
                                        </td>
                                      </tr>
                                      <tr>
                                        <th>Website</th>
                                        <td><input type="url" name="website" class="form-control" required="required" value="{{ $profile->website ?? old('website') }}">
                                          @if ($errors->has('website'))
                                              <span class="invalid-feedback" role="alert">
                                                  <strong class="st">{{ $errors->first('website') }}</strong>
                                              </span>
                                          @endif
                                        </td>
                                      </tr>
                                      <tr>
                                        <th></th>
                                        <td><button class="btn btn-success pull-right normal" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Updating...">Update</button></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                                </form>
                              </div>
                            </div>
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                            <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui
                              photo booth letterpress, commodo enim craft beer mlkshk </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
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
        <script>
          $(function() {

  // We can attach the `fileselect` event to all file inputs on the page
  $(document).on('change', ':file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
  });

  // We can watch for our custom `fileselect` event like this
  $(document).ready( function() {
      $(':file').on('fileselect', function(event, numFiles, label) {

          var input = $(this).parents('.input-group').find(':text'),
              log = numFiles > 1 ? numFiles + ' files selected' : label;

          if( input.length ) {
              input.val(log);
          } else {
              if( log ) alert(log);
          }

      });
  });

});
        </script>
        <script>
          $("#formButton").click(function(){
            $("#form1").toggle();
            $("#form2").toggle();
        });
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
        @endsection
@endsection