<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->
<head>
  <meta charset="utf-8" />
  <title>Login</title>
  <meta name="description" content="Latest updates and statistic charts">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!--begin::Web font -->
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
  <script>
    WebFont.load({
      google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
      active: function() {
        sessionStorage.fonts = true;
      }
    });
  </script>
  <!--end::Web font -->
  <!--begin::Base Styles -->
  <link href="/metronic/assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
  <link href="/metronic/assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />
  <!--end::Base Styles -->
  <link rel="shortcut icon" href="/metronic/assets/demo/default/media/img/logo/favicon.ico" />
</head>
<!-- end::Head -->
<!-- end::Body -->
<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
  <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-grid--tablet-and-mobile m-grid--hor-tablet-and-mobile 		m-login m-login--1 m-login--singin" id="m_login">
    <div class="m-grid__item m-grid__item--order-tablet-and-mobile-2 m-login__aside">
      <div class="m-stack m-stack--hor m-stack--desktop">
        <div class="m-stack__item m-stack__item--fluid">
          <div class="m-login__wrapper">
            <div class="m-login__logo">
              <a href="#">
                <img style="max-width:100%" src="/metronic/assets/app/media/img//logos/logo-2.png">
              </a>
            </div>
            <div class="m-login__signin">
              <div class="m-login__head">
                <h3 class="m-login__title">
                  Sign In
                </h3>
              </div>
              <form class="m-login__form m-form" method="POST" action="{{ route('admin.login.submit') }}">
                {{ csrf_field() }}
                <div class="form-group m-form__group {{ $errors->has('email') ? ' has-error' : '' }}">
                  <input class="form-control m-input" type="email" placeholder="Email" name="email" autocomplete="off">
                  @if ($errors->has('email'))
                    <span class="help-block form-control-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                  @endif
                </div>
                <div class="form-group m-form__group {{ $errors->has('password') ? ' has-error' : '' }}">
                  <input class="form-control m-input m-login__form-input--last" type="password" placeholder="Password" name="password">
                  @if ($errors->has('password'))
                    <span class="help-block form-control-feedback">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif
                </div>
                <div class="row m-login__form-sub">
                  <div class="col m--align-left">
                    <label class="m-checkbox m-checkbox--focus">
                      <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                      Remember me
                      <span></span>
                    </label>
                  </div>
                  <div class="col m--align-right">
                    {{--<a href="javascript:;" id="m_login_forget_password" class="m-link">--}}
                    {{--Forget Password ?--}}
                    {{--</a>--}}
                    <input hidden name="redirectTo" value="{{$redirectTo}}">

                  </div>
                </div>
                <div class="m-login__form-action">
                  <button id="m_login_signin_submit" type="submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
                    Sign In
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--center m-grid--hor m-grid__item--order-tablet-and-mobile-1	m-login__content" style="background-image: url(/metronic/assets/app/media/img//bg/bg-2.jpg)">
      <div class="m-grid__item m-grid__item--middle">

        <h3 class="m-login__welcome">
          Dashboard
        </h3>
      </div>
    </div>
  </div>
</div>
<!-- end:: Page -->
<!--begin::Base Scripts -->
<script src="/metronic/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
<script src="/metronic/assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
<!--end::Base Scripts -->
<!--begin::Page Snippets -->
<!--end::Page Snippets -->
</body>
<!-- end::Body -->
</html>
