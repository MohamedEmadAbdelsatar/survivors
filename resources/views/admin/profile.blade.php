@extends('Dashboard::layouts.master')
@section('title','Profile')
@section('pageTitle','Profile')
@section('content')
    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" style="max-width: 400px"
                         src="@if(!file_exists(public_path(str_replace(url('/'),'',getCurrentAdmin()->image))))/metronic/assets/app/media/img/users/user4.jpg
                                                      @else{{getCurrentAdmin()->image}} @endif" alt="User profile picture">

                    <h3 class="profile-username text-center">{{getCurrentAdmin()->name}}</h3>

                    <p class="text-muted text-center">{{getCurrentAdmin()->roles()->first() ? getCurrentAdmin()->roles()->first()->name : 'Super Admin' }}</p>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">

                <div class="tab-content">

                    <div class="tab-pane active" id="settings">
                        <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{ route('admin.profile') }}">
                            {{ csrf_field() }}
                            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="inputName" class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" value="{{getCurrentAdmin()->name}}"
                                           class="form-control" id="inputName" placeholder="Full Name">
                                      <span class="help-block">
                                          <strong>@errors('name')</strong>
                                      </span>
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" value="{{getCurrentAdmin()->email}}"
                                           class="form-control" id="inputEmail" placeholder="Email">
                                      <span class="help-block">
                                          <strong>@errors('email')</strong>
                                      </span>
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('old_password') ? ' has-error' : '' }}">
                                <label for="inputOldPass" class="col-sm-2 control-label">Old Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="old_password" class="form-control" id="inputOldPass" placeholder="Old Password">
                                    <span class="help-block">
                                          <strong>@errors('old_password')</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('new_password') ? ' has-error' : '' }}">
                                <label for="inputNewPass" class="col-sm-2 control-label">New Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="new_password" class="form-control" id="inputNewPass" placeholder="New Password">
                                    <span class="help-block">
                                          <strong>@errors('new_password')</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('new_password_confirmation') ? ' has-error' : '' }}">
                                <label for="inputReNewPass" class="col-sm-2 control-label">Confirm New Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="new_password_confirmation" class="form-control" id="inputReNewPass" placeholder="Confirm New Password">
                                    <span class="help-block">
                                          <strong>@errors('new_password_confirmation')</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">

                                <label for="file2" class="col-sm-2 control-label">Profile Picture</label>
                                <div class="col-sm-10">

                                    <div></div>
                                    <label class="custom-file">
                                        <input type="file" id="file2" name="image" class="custom-file-input">
                                        <span class="custom-file-control form-control"></span>
                                    </label>
                                    <span class="help-block">
                                              <strong>@errors('image')</strong>
                                        </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

@endsection