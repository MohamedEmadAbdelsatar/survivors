@extends('admin/layouts.master')
@section('title','hospital')
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
                        Hospital's Orders
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
                    Hospital's Orders
                </h3>
            </div>
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
            </div>
        </div>
        <!--end: Search Form -->
        <!--begin: Datatable -->
        <div class="m_datatable m-datatable m-datatable--default m-datatable--loaded" id="local_data" style="">
            <table class="m-datatable__table" style="display: block; min-height: 300px; overflow-x: auto;">
                <thead class="m-datatable__head"><tr class="m-datatable__row" style="height: 56px;">
                    <th data-field="ID" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 110px;">#</span></th>
                    <th data-field="Blood_Type" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 160px;">Blood Type</span></th>
                    <th data-field="Status" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 160px;">Status</span></th>
                    <th data-field="Ordered By" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 160px;">Ordered By</span></th>
                    <th data-field="Amount" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 160px;">Amount</span></th>
                    <th data-field="Actions" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 110px;">Actions</span></th>
                </thead>
                <tbody class="m-datatable__body" style="">
                @foreach($orders as $order)
                    <tr data-row="0" class="m-datatable__row" style="height: 64px;">
                        <td data-field="ID" class="m-datatable__cell"><span style="width: 110px;">{{$loop->index+1}}</span></td>
                        <td data-field="Blood_Type" class="m-datatable__cell"><span style="width: 160px;">@switch($order->blood_type)
                        @case(1) {{"O+"}} @break
                        @case(2) {{"O-"}} @break
                        @case(3) {{"A+"}} @break
                        @case(4) {{"A-"}} @break
                        @case(5) {{"B+"}} @break
                        @case(6) {{"B-"}} @break
                        @case(7) {{"AB+"}} @break
                        @case(8) {{"AB-"}} @break
                        @endswitch
                        </span></td>
                        <td data-field="Status" class="m-datatable__cell"><span style="width: 160px;">@switch($order->status)
                            @case(1) <span class="m-badge m-badge--brand m-badge--wide">Pending</span> @break
                            @case(2) <span class="m-badge  m-badge--success m-badge--wide">Accepted</span> @break
                            @case(3) <span class="m-badge  m-badge--danger m-badge--wide">Refused</span> @break
                            @endswitch</span></td>
                        <td data-field="Status" class="m-datatable__cell"><span style="width: 160px;">@foreach($admins as $admin) @if($admin->id == $order->user_id) {{$admin->name}}@endif @endforeach</span></td>
                        <td data-field="Amount" class="m-datatable__cell"><span style="width: 160px;">{{$order->amount}}</span></td>
                        <td data-field="Actions" class="m-datatable__cell"><span style="overflow: visible; width: 110px;"><div class="dropdown "><a href="#" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown"><i class="la la-ellipsis-h"></i></a><div class="dropdown-menu dropdown-menu-right">@if($order->status == 1)<a class="dropdown-item" href="{{route('orders.edit',$order->id)}}"><i class="la la-edit"></i> Edit</a>@endif<a class="dropdown-item" href="{{route('orders.show',$order->id)}}"><i class="la flaticon-laptop"></i>Show</a><form id="delete-form-{{$order->id}}" method="post" action="{{ route('orders.destroy',$order->id)}}" style="display: none;">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}

                          </form>
                          <a class="dropdown-item"
                          onclick="
                          if(confirm('are you sure You want to delete this User')){
                            event.preventDefault();
                            document.getElementById('delete-form-{{$order->id}}').submit();
                          }else{
                            event.preventDefault();
                          }"><i class="la flaticon-circle"></i>Delete</a></span></td>
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
