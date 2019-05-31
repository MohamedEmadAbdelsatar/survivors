@extends('admin/layouts.master')
@section('title','Dashboard')
@section('pageTitle','Dashboard')
@section('styles')

@endsection
@section('content')

<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Admins
            </h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                <li class="m-nav__item m-nav__item--home">
                    <a href="{{route('home')}}" class="m-nav__link m-nav__link--icon">
                        <i class="m-nav__link-icon la la-home"></i>
                    </a>
                </li>
                <li class="m-nav__separator">
                    -
                </li>
                <li class="m-nav__item">
                    <a href="/admins" class="m-nav__link">
                        <span class="m-nav__link-text">
                            Admins
                        </span>
                    </a>
                </li>
                <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                    <a href="{{route('admins.edit',$admin->id)}}" class="m-nav__link">
                            <span class="m-nav__link-text">
                                Update Admin information
                            </span>
                        </a>
                    </li>
            </ul>
        </div>
    </div>
</div>
<div class="m-portlet m-portlet--tab">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon m--hide">
                        <i class="la la-gear"></i>
                    </span>
                    <h3 class="m-portlet__head-text">
                        Update Admin information
                    </h3>
                </div>
            </div>
        </div>
        <!--begin::Form-->
    <form class="m-form m-form--fit m-form--label-align-right" role="form" action="{{route('admins.update',$admin->id)}}" method="POST" >
            {{ csrf_field()}}
            {{method_field('PUT')}}
            <div class="m-portlet__body">
            <div class="row">
                <div class="form-group m-form__group col-md-6"style="padding-top:0px;">
                    <label>
                        Admin Name
                    </label>
                <input type="text" class="form-control m-input" id="name" value="{{$admin->name}}" name="name">
                </div>
                <div class="form-group m-form__group col-md-6"style="padding-top:0px;">
                    <label>
                        Email Address
                    </label>
                    <input type="email" class="form-control m-input" id="email" value="{{$admin->email}}" name="email">
                </div>
            </div>
            <div class="row">
                <div class="form-group m-form__group col-md-6" style="padding-top:0px;">
                    <label>
                        Phone Number
                    </label>
                    <input type="text" class="form-control m-input" id="phone" value="{{$admin->phone}}" name="phone">
                </div>
                <div class="form-group m-form__group col-md-6" style="padding-top:0px;">
                    <label>
                        Password
                    </label>
                    <input type="password" class="form-control m-input" id="password" placeholder="Enter a new password or leave it empty" name="password">
                </div>
            </div>
            <div class="row">
                @if(Auth::user()->id != $admin->id)
                @if(Auth::user()->role_id == 1)
                <div class="form-group m-form__group col-md-6" style="padding-top:0px;">
                    <label>
                        Choose Role
                    </label>
                    <select class="form-control m-input m-input--square" id="role" name="role">
                        <option id="1" value="1" @if($admin->role_id == 1) selected @endif>Admin</option>
                        <option id="2" value="2" @if($admin->role_id == 2) selected @endif>Hospital Admin</option>
                    </select>
                </div>
                @endif
                @endif
                <div class="form-group m-form__group col-md-6 hospital" @if($admin->role_id == 1) style="display:none;padding:0px;" @endif>
                    <label>
                        Choose Hospital
                    </label>
                    <select class="form-control m-input m-input--square" id="hospital" name="hospital">
                        <option></option>
                        @foreach ($hospitals as $hospital)
                    <option id="{{$hospital->id}}" value="{{$hospital->id}}" @if($admin->hospital_id == $hospital->id) selected @endif>{{$hospital->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            </div>
            <div class="m-portlet__foot m-portlet__foot--fit">
                <div class="m-form__actions">
                        <button type="submit" class="btn btn-primary">
                                Submit
                        </button>
                </div>
            </div>
        </form>
        <!--end::Form-->
    </div>
@endsection
@section('scripts')
<script sec="{{asset('default/assets/jquery-3.4.0.min.js')}}"></script>
<script>
$(document).ready(function(){
    $('#role').change(function(){
        if($(this).val() == "1"){
            $('.hospital').hide()
        } else {
            $('.hospital').show()
        }
    })
});
</script>
@endsection
