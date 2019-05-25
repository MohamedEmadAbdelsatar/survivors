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
                    <a href="{{route('hospital.create')}}" class="m-nav__link">
                            <span class="m-nav__link-text">
                                Create Hospital
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
                        Create
                    </h3>
                </div>
            </div>
        </div>
        <!--begin::Form-->
    <form class="m-form m-form--fit m-form--label-align-right" role="form" action="{{route('hospital.store')}}" method="POST" >
            {{ csrf_field()}}
            <div class="m-portlet__body">
            <div id="map" style="height:400px;width: 100%;padding-top:0px;margin-bottom:20px;"></div>
            <div class="row">
                <div class="form-group m-form__group col-md-6">
                    <label>
                        Hospital Name
                    </label>
                    <input type="text" class="form-control m-input" id="name" placeholder="Enter Name" name="name">
                </div>
                <div class="form-group m-form__group col-md-6" style="padding-top:0px;">
                    <label>
                        Address
                    </label>
                    <input type="text" class="form-control m-input" id="address" placeholder="Enter Address" name="address">
                </div>
            </div>
            <div class="row">
                <div class="form-group m-form__group col-md-6">
                    <label>
                        Email Address
                    </label>
                    <input type="email" class="form-control m-input" id="email" placeholder="Enter Email" name="email">
                </div>
                <div class="form-group m-form__group col-md-6" style="padding-top:0px;">
                        <label>
                            Phone Number
                        </label>
                        <input type="tel" class="form-control m-input" id="phone" placeholder="Enter Phone" name="phone">
                    </div>
            </div>
            <h3> Coordinates</h3>
            <div class="row">
                    <div class="form-group m-form__group col-md-6">
                        <label>
                                Latitude
                        </label>
                        <input type="text" step="any" class="form-control m-input" id="lat" placeholder="Enter Latitude" name="lat">
                    </div>
                    <div class="form-group m-form__group col-md-6" style="padding-top:0px;">
                        <label>
                                Longitude
                        </label>
                        <input type="text" step="any" class="form-control m-input" id="lng" placeholder="Enter Longitude" name="lng">
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
@section('scripts')
<script>
        // Initialize and add the map
        function initMap() {
          // The location of Uluru
          var uluru = {lat: 30.08, lng: 31.241};
          // The map, centered at Uluru
          var map = new google.maps.Map(
              document.getElementById('map'), {zoom: 15, center: uluru});
          // The marker, positioned at Uluru
          var marker = new google.maps.Marker({position: uluru, map: map});
          var geocoder = new google.maps.Geocoder();
          google.maps.event.addListener(map, "click", function (e) {

            //lat and lng is available in e object
            var latLng = e.latLng;
            marker.setPosition(latLng)
            var lat = latLng.lat()
            var lng = latLng.lng()
            document.getElementById('lat').value= lat;
            document.getElementById('lng').value= lng;
            console.log(lat+','+lng)
            geocoder.geocode({
                'latLng': latLng
            }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    console.log(results[0].formatted_address)
                    document.getElementById('address').value= results[0].formatted_address;
                }
                }
            });

});
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
