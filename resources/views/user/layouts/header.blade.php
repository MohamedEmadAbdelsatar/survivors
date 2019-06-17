<!-- Navigation -->
    <nav class="navbar navbar-expand fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand" href="index.html"><img src="{{asset('default/assets/logo.png')}}" width="200px" height="60px"></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive" >
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{route('contactus')}}">Contact Us</a>
            </li>
            <li class="nav-item">
              @if(Auth::guest())
              <a class="nav-link" href="{{route('login')}}">Login</a>
              @else

              <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
              </div>
              @endif
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Header -->
    <header class="masthead" style="background-image: url('{{url('storage/'.$about->image)}}')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="site-heading">
              <h1>@yield('title')</h1>
              <span class="subheading">@yield('subHeading')</span>
            </div>
          </div>
        </div>
      </div>
    </header>
