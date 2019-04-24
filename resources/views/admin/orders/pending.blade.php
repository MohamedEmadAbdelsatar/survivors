@extends('admin/layouts.master')
@section('title','Dashboard')
@section('pageTitle','Dashboard')
@section('content')

<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Pending Orders
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
                <a href="/orders" class="m-nav__link">
                        <span class="m-nav__link-text">
                            Orders
                        </span>
                    </a>
                </li>
                <li class="m-nav__separator">
                    -
                </li>
                <li class="m-nav__item">
                <a href="{{route('pending_orders')}}" class="m-nav__link">
                        <span class="m-nav__link-text">
                            Pending Orders
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
                    Pending Orders
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
                <th data-field="ID" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 80px;">#</span></th>
                <th data-field="Hospital_Name" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 130px;">Hospital Name</span></th>
                <th data-field="Hospital_Address" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 110px;">User</span></th>
                <th data-field="Blood Type" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 110px;">Blood Type</span></th>
                <th data-field="Amount" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 100px;">Amount</span></th>
                <th data-field="Actions" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 160px;">Actions</span></th>
            </thead>
            {{csrf_field()}}
        <tbody class="m-datatable__body" style="">
            @foreach($orders as $order)
            <tr data-row="0" class="m-datatable__row" style="height: 64px;" id="{{$order->id}}">
                <td data-field="ID" class="m-datatable__cell"><span style="width: 80px;">{{$loop->index+1}}</span></td>
                <td data-field="ShipName" class="m-datatable__cell"><span style="width: 130px;">@foreach($hospitals as $hospital) @if($hospital->id == $order->hospital_id){{$hospital->name}}@endif @endforeach</span></td>
                <td data-field="ShipAddress" class="m-datatable__cell"><span style="width: 110px;">@foreach($users as $user) @if($user->id == $order->user_id){{$user->name}}@endif @endforeach</span></td>
                <td data-field="ShipAddress" class="m-datatable__cell"><span style="width: 110px;">@switch($order->blood_type)
                    @case(1) {{"O+"}} @break
                    @case(2) {{"O-"}} @break
                    @case(3) {{"A+"}} @break
                    @case(4) {{"A-"}} @break
                    @case(5) {{"B+"}} @break
                    @case(6) {{"B-"}} @break
                    @case(7) {{"AB+"}} @break
                    @case(8) {{"AB-"}} @break
                    @endswitch</span></td>
                <td data-field="ShipAddress" class="m-datatable__cell"><span style="width: 100px;">{{$order->amount}}</span></td>
                <td data-field="Actions" class="m-datatable__cell"><button type="button" class="btn btn-success accept">Accept</button> <button type="button" class="btn btn-danger refuse">Refuse</button></td>
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
<script sec="{{asset('default/assets/jquery-3.4.0.min.js')}}"></script>
<script>
    $(document).ready(function(){
        $('.accept').click(function(){
            var id = $(this).parent().parent().attr('id');
            var token = $('input[name="_token"]').val();
            $.ajax({
                url:'/pending_action',
                method:'post',
                data:{
                    id:id,
                    _token:token,
                    action:'accept'
                },
                success:function(response){
                    $('tr#'+id).remove()
                }
            });
        });
        $('.refuse').click(function(){
            var id = $(this).parent().parent().attr('id');
            var token = $('input[name="_token"]').val();
            $.ajax({
                url:'/pending_action',
                method:'post',
                data:{
                    id:id,
                    _token:token,
                    action:'refuse'
                },
                success:function(response){
                    $('tr#'+id).remove()
                }
            });
        });
    });
</script>
@endsection
