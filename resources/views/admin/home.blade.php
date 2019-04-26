@extends('admin/layouts.master')
@section('title','Dashboard')
@section('pageTitle','Home')
@section('content')




@if($role == 1)
<div class="m-portlet " style="margin-top:50px;padding-bottom:20px;">
    <div class="m-portlet__body  m-portlet__body--no-padding">
        <div class="row m-row--no-padding m-row--col-separator-xl">
            <div class="col-md-12 col-lg-6 col-xl-3">
                <!--begin::Total Profit-->
                <div class="m-widget24">
                    <div class="m-widget24__item">
                        <h4 class="m-widget24__title">
                            Total Hospitals
                        </h4>
                        <br>
                        <span class="m-widget24__desc">
                            All Registered Hospitals
                        </span>
                        <span class="m-widget24__stats m--font-brand">
                            {{$n_hospital}}
                        </span>

                    </div>
                </div>
                <!--end::Total Profit-->
            </div>
            <div class="col-md-12 col-lg-4 col-xl-4">
                <!--begin::New Orders-->
                <div class="m-widget24">
                    <div class="m-widget24__item">
                        <h4 class="m-widget24__title">
                            Total Orders
                        </h4>
                        <br>
                        <span class="m-widget24__desc">
                            All orders between hospitals
                        </span>
                        <span class="m-widget24__stats m--font-danger">
                            {{$n_order}}
                        </span>

                    </div>
                </div>
                <!--end::New Orders-->
            </div>
            <div class="col-md-12 col-lg-4 col-xl-4">
                <!--begin::New Users-->
                <div class="m-widget24">
                    <div class="m-widget24__item">
                        <h4 class="m-widget24__title">
                            New Pending orders
                        </h4>
                        <br>
                        <span class="m-widget24__desc">

                        </span>
                        <span class="m-widget24__stats m--font-success">
                            {{$n_pending}}
                        </span>

                    </div>
                </div>
                <!--end::New Users-->
            </div>
        </div>
    </div>
</div>
@else
<div class="m-portlet " style="margin-top:50px;padding-bottom:20px;">
    <div class="m-portlet__body  m-portlet__body--no-padding">
        <div class="row m-row--no-padding m-row--col-separator-xl">
            <div class="col-md-12 col-lg-6 col-xl-3">
                <!--begin::Total Profit-->
                <div class="m-widget24">
                    <div class="m-widget24__item">
                        <h4 class="m-widget24__title">
                            Received Requestes
                        </h4>
                        <br>
                        <span class="m-widget24__desc">
                            All requestes to hospitals
                        </span>
                        <span class="m-widget24__stats m--font-brand">
                            {{$n_received}}
                        </span>

                    </div>
                </div>
                <!--end::Total Profit-->
            </div>
            <div class="col-md-12 col-lg-4 col-xl-4">
                <!--begin::New Orders-->
                <div class="m-widget24">
                    <div class="m-widget24__item">
                        <h4 class="m-widget24__title">
                            Sent Requestes
                        </h4>
                        <br>
                        <span class="m-widget24__desc">
                            All requestes made by hospital
                        </span>
                        <span class="m-widget24__stats m--font-danger">
                            {{$n_sent}}
                        </span>

                    </div>
                </div>
                <!--end::New Orders-->
            </div>
            <div class="col-md-12 col-lg-4 col-xl-4">
                <!--begin::New Users-->
                <div class="m-widget24">
                    <div class="m-widget24__item">
                        <h4 class="m-widget24__title">
                            Accepted Requests
                        </h4>
                        <br>
                        <span class="m-widget24__desc">

                        </span>
                        <span class="m-widget24__stats m--font-success">
                            {{$n_accepted}}
                        </span>

                    </div>
                </div>
                <!--end::New Users-->
            </div>
        </div>
    </div>
</div>
@endif

@endsection
