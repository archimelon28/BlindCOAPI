<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.html">Denta<span>Care</span></a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item active"><a href="index.html" class="nav-link">Home</a></li>
	          <li class="nav-item"><a href="about.html" class="nav-link">About</a></li>
	          <li class="nav-item"><a href="doctors.html" class="nav-link">Doctors</a></li>
            @if (Session::get('roles') == null)
            <li class="nav-item cta"><a href="" class="nav-link" data-toggle="modal" data-target="#Login"><span>Login</span></a></li>
            @elseif (Session::get('roles') == 1)
            <li class="nav-item cta"><a href=" {{route('profil',Session::get('idp'))}}" class="nav-link">Profil</a></li>
            <li class="nav-item cta"><a href="{{route('appointment',Session::get('idp'))}}" class="nav-link">Appointment</a></li>
            <li class="nav-item cta"><a href="{{route('logout')}}" class="nav-link"><span>Logout</span></a></li>
            @elseif (Session::get('roles') == 2)
            <li class="nav-item cta"><a href="{{route('profil',Session::get('idd'))}}" class="nav-link">Profil</a></li>
            <li class="nav-item cta"><a href="index.html" class="nav-link">Appointment</a></li>
            <li class="nav-item cta"><a href="{{route('logout')}}" class="nav-link"><span>Logout</span></a></li>
            @endif
	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->

    <section class="home-slider owl-carousel">
      <div class="slider-item bread-item" style="background-image: url('{{asset('assets/images/bg_1.jpg')}}');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container" data-scrollax-parent="true">
          <div class="row slider-text align-items-end">
            <div class="col-md-7 col-sm-12 ftco-animate mb-5">
              <p class="breadcrumbs" data-scrollax=" properties: { translateY: '70%', opacity: 1.6}"><span class="mr-2"><a href="index.html">Home</a></span> <span>About</span></p>
              <h1 class="mb-3" data-scrollax=" properties: { translateY: '70%', opacity: .9}">About Us</h1>
            </div>
          </div>
        </div>
      </div>
    </section>