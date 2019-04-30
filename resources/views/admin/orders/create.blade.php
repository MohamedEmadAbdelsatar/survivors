@extends('admin/layouts.master')
@section('title','Dashboard')
@section('pageTitle','Dashboard')
@section('content')

<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Orders
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
                    <a href="{{route('hospital/orders')}}" class="m-nav__link">
                        <span class="m-nav__link-text">
                            Orders
                        </span>
                    </a>
                </li>
                <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                    <a href="{{route('hospital.create')}}" class="m-nav__link">
                            <span class="m-nav__link-text">
                                Create Order
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
                        Order a blood type
                    </h3>
                </div>
            </div>
        </div>
        <!--begin::Form-->
    <form class="m-form m-form--fit m-form--label-align-right" role="form" action="{{route('orders.store')}}" method="POST" >
            {{ csrf_field()}}
        <div class="m-portlet__body">
            <div class="row">
                <div class="form-group m-form__group col-md-4" style="padding-top:0px;">
                        <label>
                            Choose Blood Type
                        </label>
                    <select class="form-control m-input m-input--square" id="blood_type" name="blood_type">
                        <option id="1" value="1">O+</option>
                        <option id="2" value="2">O-</option>
                        <option id="3" value="3">A+</option>
                        <option id="4" value="4">A-</option>
                        <option id="5" value="5">B+</option>
                        <option id="6" value="6">B-</option>
                        <option id="7" value="7">AB+</option>
                        <option id="8" value="8">AB-</option>
                    </select>
                </div>
                <div class="form-group m-form__group col-md-4" style="padding-top:0px;">
                    <label>
                        Amount
                    </label>
                    <input type="number" class="form-control m-input" id="amounr" placeholder="Enter Amount" name="amount">
                </div>
                <div class="form-group m-form__group col-md-4" style="padding-top:0px;">
                    <label>
                        Choose Hospitals To order from
                    </label>
                    <select class="form-control m-input m-input--square" id="to_id" name="to_id">
                        <option id="0" value="0"></option>
                        @foreach($hospitals as $hospital)
                        @if($hospital->id != Auth::user()->hospital_id)
                        <option id="{{$hospital->id}}" value="{{$hospital->id}}">{{$hospital->name}}</option>
                        @endif
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
