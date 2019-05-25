@extends('admin/layouts.master')
@section('title','Dashboard')
@section('pageTitle','Dashboard')

@section('content')

<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Hospitals
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
                    <a href="/hospital" class="m-nav__link">
                        <span class="m-nav__link-text">
                            Hospitals
                        </span>
                    </a>
                </li>
                <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                    <a href="{{route('hospital.show',$hospital->id)}}" class="m-nav__link">
                            <span class="m-nav__link-text">
                                Hospital Information
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
                        Hospital Information
                    </h3>
                </div>
            </div>
        </div>

    <input type="hidden" id="lat" value="{{$hospital->lat}}">
    <input type="hidden" id="lng" value="{{$hospital->lng}}">

            <div class="m-portlet__body col-md-12">
                    <div id="map" style="height:400px;width: 100%;padding-top:0px;margin-bottom:40px;"></div>
                    <div class="row" style="margin-bottom:20px;">
                        <div class="col-md-6"><p> Hospital Name: {{$hospital->name}}</p></div>
                        <div class="col-md-6"><p> Hospital Address: {{$hospital->address}}</p></div>
                    </div>
                    <div class="row">
                            <div class="col-md-6"><p> Hospital Phone: {{$hospital->phone}}</p></div>
                            <div class="col-md-6"><p> Hospital Mail: {{$hospital->email}}</p></div>
                    </div>
                    <hr>
                    <h4>Hospital Addmins</h4>
                    <table class="table table-striped m-table">
                            <thead>
                                <tr>
                                    <th>
                                        #
                                    </th>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Phone
                                    </th>
                                    <th>
                                        Mail
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <th scope="row">
                                        {{$loop->index+1}}
                                    </th>
                                    <td>
                                        {{$user->name}}
                                    </td>
                                    <td>
                                        {{$user->phone}}
                                    </td>
                                    <td>
                                        {{$user->email}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <hr>
                        <h4>Orders</h4>
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
                                            Admin
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
                                            @foreach ($users as $user)
                                            @if($user->id == $order->user_id) {{$user->name}} @endif
                                            @endforeach
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
            </div>
    </div>

@endsection
@section('scripts')

<script>
    var a = parseFloat(document.getElementById('lat').value);
    console.log(a)
    var b = parseFloat(document.getElementById('lng').value);
        // Initialize and add the map
        function initMap() {
          // The location of Uluru
          var uluru = {lat: a, lng: b};
          // The map, centered at Uluru
          var map = new google.maps.Map(
              document.getElementById('map'), {zoom: 15, center: uluru});
          // The marker, positioned at Uluru
          var marker = new google.maps.Marker({position: uluru, map: map});

        }

            </script>
            <!--Load the API from the specified URL
            * The async attribute allows the browser to render the page while the API loads
            * The key parameter will contain your own API key (which is not needed for this tutorial)
            * The callback parameter executes the initMap() function
            -->
            <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBrXPHNArrZmglifJOO-0KgaG0OH-7rDLM&callback=initMap">
            </script>
@endsection
