@extends('admin/layouts.master')
@section('title','contacts')
@section('pageTitle','Dashboard')
@section('content')

<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Contacts
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
                <a href="/contacts" class="m-nav__link">
                        <span class="m-nav__link-text">
                            contacts
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
                        Contacts
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
                    <th data-field="ID" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 110px;">Index</span></th>
                    <th data-field="Hospital_Name" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 160px;">Hospital Name</span></th>
                    <th data-field="Hospital_Address" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 260px;">Address</span></th>
                    <th data-field="Email" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 260px;">Email</span></th>
                    <th data-field="Phone" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 160px;">Phone</span></th>
                    <th data-field="Delete" class="m-datatable__cell m-datatable__cell--sort"><span style="width: 160px;">Delete</span></th>
                </thead>
                <tbody class="m-datatable__body" style="">
                @foreach($contacts as $contact)
                    <tr data-row="0" class="m-datatable__row" style="height: 64px;" id="{{$contact->id}}">
                        <td data-field="ID" class="m-datatable__cell"><span style="width: 110px;">{{$loop->index+1}}</span></td>
                        <td data-field="ShipName" class="m-datatable__cell"><span style="width: 160px;">{{$contact->name}}</span></td>
                        <td data-field="ShipAddress" class="m-datatable__cell"><span style="width: 260px;">{{$contact->address}}</span></td>
                        <td data-field="email" class="m-datatable__cell"><span style="width: 260px;">{{$contact->email}}</span></td>
                        <td data-field="phone" class="m-datatable__cell"><span style="width: 160px;">{{$contact->phone}}</span></td>
                        <td data-field="Delete" class="m-datatable__cell"><span style="width: 160px;">
                        <a class="del" id="{{$contact->id}}"><i class="la flaticon-circle"></i> Delete</a></span>
                        </td>
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
<script>
$(document).ready(function(){
    $('a.del').click(function(){
        var id = $(this).attr('id');
        var token = $('input[name="_token"]').val();
        $.ajax({
                    url:'contact/delete',
                    method:'post',
                    data:{
                        id:id,
                        _token:token,
                        action:'accept',
                    },
                    success:function(response){
                        $('tr#'+id).remove()
                    }
                });
    });
});
</script>
@endsection
