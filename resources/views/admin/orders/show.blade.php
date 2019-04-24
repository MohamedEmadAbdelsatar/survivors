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
                <a href="@if(Auth::user()->role_id == 2) {{"/hospital_orders"}} @else {{"/pending_orders"}} @endif" class="m-nav__link">
                        <span class="m-nav__link-text">
                            Orders
                        </span>
                    </a>
                </li>
                <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                    <a href="{{route('orders.show',$order->id)}}" class="m-nav__link">
                            <span class="m-nav__link-text">
                                Order Information
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
                        Order Information
                    </h3>
                </div>
            </div>
        </div>

      <div class="m-portlet__body col-md-12">
                    <div class="row" style="margin-bottom:20px;">
                        <div class="col-md-6"><p> Hospital Name: {{$hospital->name}}</p></div>
                        <div class="col-md-6"><p> Hospital Address: {{$hospital->address}}</p></div>
                    </div>
                    <div class="row">
                            <div class="col-md-6"><p> Blood Type: @switch($order->blood_type)
                                @case(1) {{"O+"}} @break
                                @case(2) {{"O-"}} @break
                                @case(3) {{"A+"}} @break
                                @case(4) {{"A-"}} @break
                                @case(5) {{"B+"}} @break
                                @case(6) {{"B-"}} @break
                                @case(7) {{"AB+"}} @break
                                @case(8) {{"AB-"}} @break
                                @endswitch</p></div>
                            <div class="col-md-6"><p> Amount: {{$order->amount}}</p></div>
                    </div>
                    <div class="row" style="margin-bottom:20px;">
                        <div class="col-md-6"><p> Order Status : @switch($order->status)
                            @case(1) <span class="m-badge m-badge--brand m-badge--wide">Pending</span> @break
                            @case(2) <span class="m-badge  m-badge--success m-badge--wide">Accepted</span> @break
                            @case(3) <span class="m-badge  m-badge--danger m-badge--wide">Refused</span> @break
                            @endswitch</p></div>
                        <div class="col-md-6"><button type="button" class="btn btn-secondary active m-btn m-btn--custom">
                            Follow Order
                        </button>*(Future Plan)</div>
                    </div>
            </div>
    </div>

@endsection
