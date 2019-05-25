@extends('admin/layouts.master')
@section('title','Dashboard')
@section('pageTitle','Modify Blood Balances')
@section('styles')

@endsection
@section('content')

<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Blood
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
                    <a href="{{route('blood/modify',$hospital->id)}}" class="m-nav__link">
                            <span class="m-nav__link-text">
                                Modify Blood Balances
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
                        Modify Blood Balances for {{$hospital->name}}
                    </h3>
                </div>
            </div>
        </div>
        <!--begin::Form-->
    <form class="m-form m-form--fit m-form--label-align-right" role="form" action="{{route('blood/update')}}" method="POST" >
            {{ csrf_field()}}
            <div class="m-portlet__body">
            <div class="row">
                <div class="form-group m-form__group col-md-6"style="padding-top:0px;">
                    <label>
                        O+
                    </label>
                <input type="number" class="form-control m-input" id="o+" value="{{$balance->o_pos ?? '0'}}" name="o_pos">
                </div>
                <div class="form-group m-form__group col-md-6"style="padding-top:0px;">
                    <label>
                        O-
                    </label>
                    <input type="number" class="form-control m-input" id="o-" value="{{$balance->o_neg ?? '0'}}" name="o_neg">
                </div>
            </div>
        <input type="hidden" name="hospital_id" value="{{$hospital->id}}">
            <div class="row">
                <div class="form-group m-form__group col-md-6"style="padding-top:0px;">
                    <label>
                        A+
                    </label>
                <input type="number" class="form-control m-input" id="a+" value="{{$balance->a_pos ?? '0'}}" name="a_pos">
                </div>
                <div class="form-group m-form__group col-md-6"style="padding-top:0px;">
                    <label>
                        A-
                    </label>
                    <input type="number" class="form-control m-input" id="a-" value="{{$balance->a_neg ?? '0'}}" name="a_neg">
                </div>
            </div>
            <div class="row">
                <div class="form-group m-form__group col-md-6"style="padding-top:0px;">
                    <label>
                        B+
                    </label>
                <input type="number" class="form-control m-input" id="b+" value="{{$balance->b_pos ?? '0'}}" name="b_pos">
                </div>
                <div class="form-group m-form__group col-md-6"style="padding-top:0px;">
                    <label>
                        B-
                    </label>
                    <input type="number" class="form-control m-input" id="b-" value="{{$balance->b_neg ?? '0'}}" name="b_neg">
                </div>
            </div>
            <div class="row">
                <div class="form-group m-form__group col-md-6"style="padding-top:0px;">
                    <label>
                        AB+
                    </label>
                <input type="number" class="form-control m-input" id="ab+" value="{{$balance->ab_pos ?? '0'}}" name="ab_pos">
                </div>
                <div class="form-group m-form__group col-md-6"style="padding-top:0px;">
                    <label>
                        AB-
                    </label>
                    <input type="number" class="form-control m-input" id="ab-" value="{{$balance->ab_neg ?? '0'}}" name="ab_neg">
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
