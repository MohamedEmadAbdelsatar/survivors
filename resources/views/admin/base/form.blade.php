@extends('Dashboard::layouts.master')
@php
$formTitleDefault = explode('.', Route::current()->action['as']);
array_shift($formTitleDefault);
$formTitleDefault = implode(' / ', $formTitleDefault);
@endphp
@section('formFooter')
    <button type="submit" class="btn btn-success" id="submitForm"
            onClick="this.form.submit(); this.disabled=true; this.value='Sending…'; ">Submit</button>
@endsection
@section('content')
    @yield('formBefore')
    <div class="m-portlet m-portlet--tab">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                <span class="m-portlet__head-icon m--hide">
                    <i class="la la-gear"></i>
                </span>
                    <h3 class="m-portlet__head-text">
                        @yield('formTitle', $formTitleDefault)
                    </h3>
                </div>
            </div>
        </div>

        <form role="form" method="POST" action="@yield('formAction')" class="m-form m-form--fit m-form--label-align-right" @yield('formEncType')>
            {{ csrf_field() }}
            <div style="padding: 30px">
                @yield('form')
            </div>
            <!-- /.box-body -->

            <div class="m-form__actions">
                @yield('formFooter')
            </div>

            <input name="_method" type="hidden" value="@yield("formMethod")">
        </form>
    </div>
    <!-- /.box -->
    @yield('formAfter')
@endsection

<!-- iCheck for checkboxes and radio inputs -->
@push('styles')
    <link rel="stylesheet" href="/assets/icheck/flat/_all.css">
@endpush

@push('scripts')
    <script src="/assets/icheck/icheck.js"></script>
    <script>
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass   : 'iradio_flat-green'
        })
    </script>
@endpush