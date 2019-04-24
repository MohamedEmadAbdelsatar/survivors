@extends('admin/layouts.master')
@section('title','Dashboard')
@section('pageTitle','Dashboard')

@section('content')

<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Home
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
                    <a href="{{route('admins.show',$admin->id)}}" class="m-nav__link">
                            <span class="m-nav__link-text">
                                Admin Information
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
                        Admin Informations
                    </h3>
                </div>
            </div>
        </div>
            <div class="m-portlet__body col-md-12">
                    <div class="row">
                        <div class="col-md-6"><p> Admin Name: {{$admin->name}}</p></div>
                        <div class="col-md-6"><p> Admin Mail: {{$admin->email}}</p></div>
                    </div>
                    <div class="row">
                            <div class="col-md-6"><p> Admin Phone: {{$admin->phone}}</p></div>
                    <div class="col-md-3"><p> Admin Role: @if($admin->role_id == 1) {{"Admin"}} @else {{"Hospital Admin"}}@endif</p></div>
                        @if($admin->role_id != 1)<div class="col-md-3"><p> Hospital Name: {{$hospital->name}}</p></div>@endif
                    </div>
                    @if($admin->role_id != 1)
                    <hr>
                        <h4>Orders by this Admin</h4>
                        <table class="table table-striped m-table">
                                <thead>
                                    <tr>
                                        <th>
                                            #
                                        </th>
                                        <th>
                                            Blood Type
                                        </th>
                                        <th>
                                            Amount
                                        </th>
                                        <th>
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                    <tr>
                                        <th scope="row">
                                            {{$loop->index+1}}
                                        </th>
                                        <td>
                                                @switch($order->blood_type)
                                                @case(1) {{"O+"}} @break
                                                @case(2) {{"O-"}} @break
                                                @case(3) {{"A+"}} @break
                                                @case(4) {{"A-"}} @break
                                                @case(5) {{"B+"}} @break
                                                @case(6) {{"B-"}} @break
                                                @case(7) {{"AB+"}} @break
                                                @case(8) {{"AB-"}} @break
                                                @endswitch
                                        </td>
                                        <td>
                                            {{$order->amount}}
                                        </td>
                                        <td>
                                            @switch($order->status)
                                            @case(1) <span class="m-badge m-badge--brand m-badge--wide">Pending</span> @break
                                            @case(2) <span class="m-badge  m-badge--success m-badge--wide">Accepted</span> @break
                                            @case(3) <span class="m-badge  m-badge--danger m-badge--wide">Refused</span> @break
                                            @endswitch
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
            </div>
    </div>

@endsection
