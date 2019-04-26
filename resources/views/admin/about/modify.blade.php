@extends('admin/layouts.master')
@section('title','Dashboard')
@section('pageTitle','Modify AboutUs')

@section('content')

<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                About Us
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
                    <a href="{{route('about/modify')}}" class="m-nav__link">
                        <span class="m-nav__link-text">
                            Modify AboutUs
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
                        Modify
                    </h3>
                </div>
            </div>
        </div>
        <!--begin::Form-->
    <form class="m-form m-form--fit m-form--label-align-right" role="form" action="{{route('about/update')}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field()}}
            <div class="m-portlet__body">
            <div class="row">
                <div class="form-group m-form__group col-md-6"style="padding-top:0px;">
                    <label>
                        Title
                    </label>
                <input type="text" class="form-control m-input" id="title" value="{{$about->title}}" name="title">
                </div>
            </div>
            <div class="row">
                <div class="form-group m-form__group col-md-6" style="padding-top:0px;">
                    <label>
                        Cover Photo
                    </label>
                <input type="file" class="form-control m-input" id="image" name="image" value="{{$about->image}}">
                </div>

            </div>
            <br>
            <div class="row">
                <div class="form-group m-form__group row">
                    <label class="col-form-label col-lg-1 col-sm-12">
                        Content
                    </label>
                </div>
                <div class="col-lg-11 col-sm-12"style="margin-left:25px;">
                <textarea name="body" id="editor1" >
                        {{$about->body}}
                    </textarea>
                </div>
            </div>

            </div>

            <div class="m-portlet__foot m-portlet__foot--fit">
                <div class="m-form__actions">
                        <button type="submit" class="btn btn-primary submit">
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

    CKEDITOR.replace( 'editor1' );
</script>
@endsection
