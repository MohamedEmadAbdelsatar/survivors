<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->
<head>
    <meta charset="utf-8"/>
    <title>@yield('title')</title>
    <meta name="description" content="Base form control examples">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]},
            active: function () {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <!--end::Web font -->
    <!--begin::Base Styles -->
    <link href="{{asset('default/assets/vendors/base/vendors.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('default/assets/demo/default/base/style.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <script src="{{asset('default/assets/ckeditor/ckeditor.js')}}"></script>
    <!--end::Base Styles -->
    <meta property="og:site_name" content="#" />
    <meta property="og:type" content="website" />
    <meta name="theme-color" content="‪#1a1a1a">
    <meta name="msapplication-TileColor" content="#1a1a1a">
    <meta name="author" content="Kamal">
    @yield('meta')


    @stack('styles')
    @yield('styles')
    <style>
        .pointer{
            cursor: pointer;
        }
        .grab { cursor: url(https://ssl.gstatic.com/ui/v1/icons/mail/images/2/openhand.cur), default !important; }

        .separateDiv
        {
            margin-bottom : 20px;
        }
    </style>
</head>
<!-- end::Head -->

<!-- end::Body -->
<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default" >
<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
    <!-- BEGIN: Header -->
    <header class="m-grid__item    m-header " data-minimize-mobile="hide" data-minimize-offset="200"
            data-minimize-mobile-offset="200" data-minimize="minimize">
        <div class="m-container m-container--fluid m-container--full-height">
            <div class="m-stack m-stack--ver m-stack--desktop">
                <!-- BEGIN: Brand -->
                <div class="m-stack__item m-brand  m-brand--skin-dark ">
                    <div class="m-stack m-stack--ver m-stack--general">
                        <div class="m-stack__item m-stack__item--middle m-brand__logo">
                            <a href="/home" class="m-brand__logo-wrapper" id="brand" style="font-size:23px;line-height:30px;text-decoration:none;">
                                <b>SURVIVORS</b>
                            </a>
                        </div>
                        <div class="m-stack__item m-stack__item--middle m-brand__tools">
                            <!-- BEGIN: Left Aside Minimize Toggle -->
                            <a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block">
                                <span></span>
                            </a>
                            <!-- END -->
                            <!-- BEGIN: Responsive Aside Left Menu Toggler -->
                            <a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                                <span></span>
                            </a>
                            <!-- END -->
                            <!-- BEGIN: Responsive Header Menu Toggler -->

                            <!-- END -->
                            <!-- BEGIN: Topbar Toggler -->
                            <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                                <i class="flaticon-more"></i>
                            </a>
                            <!-- BEGIN: Topbar Toggler -->
                        </div>
                    </div>
                </div>
                <!-- END: Brand -->
                <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
								<!-- BEGIN: Topbar -->
                    <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
                        <div class="m-stack__item m-topbar__nav-wrapper">
                            <ul class="m-topbar__nav m-nav m-nav--inline">
                                <li class="m-nav__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-center m-dropdown--mobile-full-width" data-dropdown-toggle="click" data-dropdown-persistent="true" aria-expanded="true">
                                    <a href="#" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon">
                                        <span class="m-nav__link-icon">
                                            <i class="flaticon-music-2"></i>
                                        </span>
                                    </a>
                                    <div class="m-dropdown__wrapper" style="width:300px;margin-left:-265px;">
                                        <span class="m-dropdown__arrow m-dropdown__arrow--right"></span>
                                        <div class="m-dropdown__inner">
                                            <div class="m-dropdown__header m--align-center" style="background: url({{asset('default/assets/app/media/img/misc/notification_bg.jpg')}}); background-size: cover;">
                                                <span class="m-dropdown__header-title">
                                                    {{count($notifications)}} New
                                                </span>
                                                <span class="m-dropdown__header-subtitle">
                                                    User Notifications
                                                </span>
                                            </div>
                                            <div class="m-dropdown__body">
                                                <div class="m-dropdown__content">
                                                    <div class="tab-content">
                                                        @if(count($notifications)==0)
                                                        <div class="tab-pane active" id="topbar_notifications_logs" role="tabpanel">
                                                            <div class="m-stack m-stack--ver m-stack--general" style="min-height: 180px;">
                                                                <div class="m-stack__item m-stack__item--center m-stack__item--middle">
                                                                    <span class="">
                                                                        All caught up!
                                                                        <br>
                                                                        No new logs.
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @else
                                                        @foreach($notifications as $notification)
                                                        <div class="m-list-timeline__item" style="height:40px;">
                                                            <span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>
                                                            <span class="m-list-timeline__text">

                                                            <a @if($notification->data['order_id']) href="/orders/{{$notification->data['order_id']}}" @endif>{{$notification->data['notification_body']}}</a>
                                                            </span>
                                                        </div>
                                                        @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" data-dropdown-toggle="click">
                                    <a href="#" class="m-nav__link m-dropdown__toggle">
                                        <span class="m-topbar__userpic">
                                            <img src="{{asset('default/assets/app/media/img/users/user4.jpg')}}" class="m--img-rounded m--marginless m--img-centered" alt=""/>
                                        </span>
                                        <span class="m-topbar__username m--hide">
                                            Nick
                                        </span>
                                    </a>
                                    <div class="m-dropdown__wrapper">
                                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                        <div class="m-dropdown__inner">
                                            <div class="m-dropdown__header m--align-center" style="background: url({{asset('default/assets/app/media/img/misc/user_profile_bg.jpg')}}); background-size: cover;">
                                                <div class="m-card-user m-card-user--skin-dark">
                                                    <div class="m-card-user__pic">
                                                        <img src="{{asset('default/assets/app/media/img/users/user4.jpg')}}" class="m--img-rounded m--marginless" alt=""/>
                                                    </div>
                                                    <div class="m-card-user__details">
                                                        <span class="m-card-user__name m--font-weight-500">
                                                            <b>{{ Auth::user()->name }}</b>
                                                        </span>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-dropdown__body">
                                                <div class="m-dropdown__content">
                                                    <ul class="m-nav m-nav--skin-light">
                                                            <li class="m-nav__item">
                                                            <a href="{{route('admins.edit',Auth::user()->id)}}" class="m-nav__link">
																		<i class="m-nav__link-icon flaticon-profile-1"></i>
																		<span class="m-nav__link-title">
																			<span class="m-nav__link-wrap">
																				<span class="m-nav__link-text">
                                                                                Edit Profile
																				</span>
																			</span>
																		</span>
																	</a>
																</li>
                                                        <li class="m-nav__section m--hide">
                                                            <span class="m-nav__section-text">
                                                                Section
                                                            </span>
                                                        </li>
                                                        <li class="m-nav__separator m-nav__separator--fit"></li>
                                                        <li class="m-nav__item">
                                                            <a class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder" href="{{ route('logout') }}"
                                                            onclick="event.preventDefault();
                                                                          document.getElementById('logout-form').submit();">
                                                             Logout
                                     </a>
                                                        </li>
                                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                            {{csrf_field()}}
                                                          </form>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- END: Topbar -->
                </div>
            </div>
        </div>
    </header>
    <!-- END: Header -->
    <!-- begin::Body -->
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
        <!-- BEGIN: Left Aside -->
        <div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
            <!-- BEGIN: Aside Menu -->
            <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark "
                 data-menu-vertical="true" data-menu-scrollable="false" data-menu-dropdown-timeout="500">
                <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
                    <li class="m-menu__item {{ (\Illuminate\Support\Facades\Route::currentRouteName() == 'home') ? 'm-menu__item--active' : ''}}" aria-haspopup="true">
                        <a href="{{route('home')}}"
                           class="m-menu__link">
                            <i class="m-menu__link-icon flaticon-line-graph"></i>
                            <span class="m-menu__link-title">
                                <span class="m-menu__link-wrap">
                                    <span class="m-menu__link-text"> Home </span>

                                </span>
                            </span>
                        </a>
                    </li>
                    <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
                            <a href="#" class="m-menu__link m-menu__toggle">
                                <i class="m-menu__link-icon flaticon-medical"></i>
                                <span class="m-menu__link-text">
                                    Hospitals
                                </span>
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="m-menu__submenu " style="">
                                <span class="m-menu__arrow"></span>
                                <ul class="m-menu__subnav">
                                    <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
                                        <span class="m-menu__link">
                                            <span class="m-menu__link-text">
                                                Hospitals
                                            </span>
                                        </span>
                                    </li>
                                    @if(Auth::user()->role_id == 1)
                                    <li class="m-menu__item " aria-haspopup="true">
                                        <a href="/hospital" class="m-menu__link ">
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="m-menu__link-text">
                                                All Hospitals
                                            </span>
                                        </a>
                                    </li>

                                    <li class="m-menu__item " aria-haspopup="true">
                                    <a href="{{route('hospital.create')}}" class="m-menu__link ">
                                            <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                <span></span>
                                            </i>
                                            <span class="m-menu__link-text">
                                                Create A Hospital
                                            </span>
                                        </a>
                                    </li>
                                    @endif
                                    @if(Auth::user()->role_id == 2)
                                    <li class="m-menu__item " aria-haspopup="true">
                                            <a href="{{route('blood/modify',Auth::user()->hospital_id)}}" class="m-menu__link ">
                                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="m-menu__link-text">
                                                        Edit Blood Balance
                                                    </span>
                                                </a>
                                            </li>
                                    @endif

                                </ul>
                            </div>
                        </li>

                        <li class="m-menu__item m-menu__item--submenu m-menu__item--open" aria-haspopup="true" data-menu-submenu-toggle="hover">
								<a href="#" class="m-menu__link m-menu__toggle">
									<i class="m-menu__link-icon flaticon-pie-chart"></i>
									<span class="m-menu__link-text">
										Orders
									</span>
									<i class="m-menu__ver-arrow la la-angle-right"></i>
								</a>
								<div class="m-menu__submenu" style="display: block;">
									<span class="m-menu__arrow"></span>
									<ul class="m-menu__subnav">
										<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
											<span class="m-menu__link">
												<span class="m-menu__link-text">
													Orders
												</span>
											</span>
                                        </li>
										<li class="m-menu__item " aria-haspopup="true">
                                        <a href="{{route('orders/pending')}}" class="m-menu__link ">
												<i class="m-menu__link-bullet m-menu__link-bullet--dot">
													<span></span>
												</i>
												<span class="m-menu__link-text">
													Pending Orders
												</span>
											</a>
                                        </li>
                                        <li class="m-menu__item " aria-haspopup="true">
                                            <a href="{{route('orders/accepted')}}" class="m-menu__link ">
                                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="m-menu__link-text">
                                                        Accepted Orders
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="m-menu__item " aria-haspopup="true">
                                                <a href="{{route('orders/refused')}}" class="m-menu__link ">
                                                        <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                            <span></span>
                                                        </i>
                                                        <span class="m-menu__link-text">
                                                            Refused Orders
                                                        </span>
                                                    </a>
                                                </li>
                                        @if(Auth::user()->role_id == 2)
                                        <li class="m-menu__item " aria-haspopup="true">
                                            <a href="{{route('hospital/orders')}}" class="m-menu__link ">
                                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="m-menu__link-text">
                                                        Hospital's Orders
                                                    </span>
                                                </a>
                                            </li>
                                            @endif
                                            @if(Auth::user()->role_id == 2)
                                        <li class="m-menu__item " aria-haspopup="true">
                                                <a href="{{route('orders.create')}}" class="m-menu__link ">
                                                        <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                            <span></span>
                                                        </i>
                                                        <span class="m-menu__link-text">
                                                            Create Order
                                                        </span>
                                                    </a>
                                        </li>
                                        @endif
									</ul>
								</div>
                            </li>

                            @if(Auth::user()->role_id == 1)
                            <li class="m-menu__item m-menu__item--submenu m-menu__item--open" aria-haspopup="true" data-menu-submenu-toggle="hover">
                                    <a href="#" class="m-menu__link m-menu__toggle">
                                        <i class="m-menu__link-icon flaticon-cogwheel-1"></i>
                                        <span class="m-menu__link-text">
                                            Admins
                                        </span>
                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                    </a>
                                    <div class="m-menu__submenu" style="display: block;">
                                        <span class="m-menu__arrow"></span>
                                        <ul class="m-menu__subnav">
                                            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
                                                <span class="m-menu__link">
                                                    <span class="m-menu__link-text">
                                                        Admins
                                                    </span>
                                                </span>
                                            </li>
                                            <li class="m-menu__item " aria-haspopup="true">
                                                <a href="/admins" class="m-menu__link ">
                                                        <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                            <span></span>
                                                        </i>
                                                        <span class="m-menu__link-text">
                                                            All Admins
                                                        </span>
                                                    </a>
                                                </li>
                                            <li class="m-menu__item " aria-haspopup="true">
                                            <a href="{{route('admins.create')}}" class="m-menu__link ">
                                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="m-menu__link-text">
                                                        Create Admins
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="m-menu__item " aria-haspopup="true">
                                        <a href="{{route('about/modify')}}" class="m-menu__link ">
                                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                    <span></span>
                                                </i>
                                                <span class="m-menu__link-text">
                                                    Modify About Us
                                                </span>
                                            </a>
                                        </li>
                                @endif

                </ul>
            </div>
            <!-- END: Aside Menu -->
        </div>
        <!-- END: Left Aside -->

        <div class="m-grid__item m-grid__item--fluid m-wrapper">

            <div class="">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        <h4>Done !</h4><?=session('success')?>
                    </div>
                @endif
                @if (session('failed'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        <h4>Failed !</h4><?=session('failed')?>
                    </div>
                @endif
                @if(count($errors)>0)
                <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                @foreach($errors->all() as $error)
                <h5><span class="la la-warning"></span> Failed ! {{$error}}</h5>
                @endforeach
                </div>
                @endif
                @yield('content')
            </div>
        </div>
    </div>
    <!-- begin::Footer -->
    <footer class="m-grid__item		m-footer ">
        <div class="m-container m-container--fluid m-container--full-height m-page__container">
            <div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
                <div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
				<span class="m-footer__copyright">
					2018 &copy;
					<a href="" target="_blank" class="m-link">
						Your Web Site
					</a>
				</span>
                </div>
                <div class="m-stack__item m-stack__item--right m-stack__item--middle m-stack__item--first">

                </div>
            </div>
        </div>
    </footer>
    <!-- end::Footer -->
</div>
<!--begin::Base Scripts -->

<script src="{{asset('default/assets/vendors/base/vendors.bundle.js')}}" type="text/javascript"></script>
<script src="{{asset('default/assets/demo/default/base/scripts.bundle.js')}}" type="text/javascript"></script>

<script>
    var tableHtml ;
</script>

@yield('scripts')
@stack('scripts')
</body>




</html>
