@extends('admin/layouts.master')
@section('title','Dashboard')
@section('pageTitle','Dashboard')
@section('content')

<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Hsopitals
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
            </ul>
        </div>
    </div>
</div>
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    All Admins
                </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">

            </ul>
        </div>
    </div>
    <div class="m-portlet__body">
        <!--begin: Search Form -->
        <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
            <div class="row align-items-center">
                <div class="col-xl-8 order-2 order-xl-1">
                    <div class="form-group m-form__group row align-items-center">

                        <div class="col-md-4">
                            <div class="m-input-icon m-input-icon--left">
                                <input type="text" class="form-control m-input" placeholder="Search..." id="generalSearch">
                                <span class="m-input-icon__icon m-input-icon__icon--left">
                                    <span>
                                        <i class="la la-search"></i>
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                <a href="{{@route('admins.create')}}" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                        <span>
                            <i class="la la-cart-plus"></i>
                            <span>
                                New Admin
                            </span>
                        </span>
                    </a>
                    <div class="m-separator m-separator--dashed d-xl-none"></div>
                </div>
            </div>
        </div>
        <!--end: Search Form -->
<!--begin: Datatable -->
<div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="">
    <table class="m-datatable__table" style="display: block; min-height: 300px; overflow-x: auto;">
        <thead class="m-datatable__head"><tr class="m-datatable__row" style="height: 56px;">
            <th data-field="ID" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 110px;">#</span></th>
            <th data-field="Admin_Name" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 160px;">Name</span></th>
            <th data-field="Admin_Hospital" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 160px;">Hospital</span></th>
            <th data-field="Admin_Phone" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 160px;">Phone</span></th>
            <th data-field="Admin_Role" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 160px;">Role</span></th>
            <th data-field="Actions" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 110px;">Actions</span></th>
        </thead>
        <tbody class="m-datatable__body" style="">
        @foreach($admins as $admin)
            <tr data-row="0" class="m-datatable__row" style="height: 64px;">
            <td data-field="ID" class="m-datatable__cell"><span style="width: 110px;">{{$loop->index+1}}</span></td>
                <td data-field="Admin_Name" class="m-datatable__cell"><span style="width: 160px;">{{$admin->name}}</span></td>
            <td data-field="Admin_Hospital" class="m-datatable__cell"><span style="width: 160px;">@foreach($hospitals as $hospital) @if($hospital->id == $admin->hospital_id) {{$hospital->name}} @endif @endforeach</span></td>
                <td data-field="Admin_Phone" class="m-datatable__cell"><span style="width: 160px;">{{$admin->phone}}</span></td>
            <td data-field="Admin_Role" class="m-datatable__cell"><span style="width: 160px;">@if($admin->role_id == 1) {{"Admin"}} @else {{"Hospital Admin"}} @endif</span></td>
                <td data-field="Actions" class="m-datatable__cell"><span style="overflow: visible; width: 110px;"><div class="dropdown "><a href="#" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown"><i class="la la-ellipsis-h"></i></a><div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="{{route('admins.edit',$admin->id)}}"><i class="la la-edit"></i> Edit</a><a class="dropdown-item" href="{{route('admins.show',$admin->id)}}"><i class="la flaticon-laptop"></i>Show</a></span></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
        <!--end: Datatable -->
    </div>
</div>




@endsection
@section('scripts')
<script src="{{asset('default/assets/demo/default/custom/components/datatables/base/data-local.js')}}" type="text/javascript"></script>
@endsection
