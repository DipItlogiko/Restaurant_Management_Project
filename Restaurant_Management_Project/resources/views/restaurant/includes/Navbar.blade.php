<!-- ======= Header ======= -->
<header id="header" class="fixed-top d-flex align-items-center header-transparent">
  <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

    <div class="logo me-auto">
      <h1><a href="#">McDonald's</a></h1>
      
    </div>

    <nav id="navbar" class="navbar order-last order-lg-0">
      <ul>
        <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
        <li><a class="nav-link scrollto" href="#about">About</a></li>
        <li><a class="nav-link scrollto" href="#menu">Menu</a></li>
        <li><a class="nav-link scrollto" href="#specials">Specials</a></li>
        <li><a class="nav-link scrollto" href="#events">Events</a></li>
        <li><a class="nav-link scrollto" href="#chefs">Chefs</a></li>
        <li><a class="nav-link scrollto" href="#gallery">Gallery</a></li>
       
           <!--- <li><a href="{{-- route('signup')}}">SignUp</a></li>             
            <li><a href="{{ route('signin') --}}">SignIn</a></li>---->
            
            @if (Route::has('login'))
             
                @auth
                  <li class="dropdown"><a href="#"><span>{{ Auth::user()->name }}</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                      <a href="{{ route('dashboard') }}">Dashboard</a>      
                     
                    </ul>
                 @else

                <li class="dropdown"><a href="#"><span>SignUp/SignIn</span> <i class="bi bi-chevron-down"></i></a>
                  <ul>
                    <a href="{{ route('login') }}" >SignIn</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">SignUp</a>
                    @endif
                  </ul>    
                </li>  
                @endauth
 
        @endif
          
        </li>
        <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->

    <a href="#book-a-table" class="book-a-table-btn scrollto">Book a table</a>

  </div>
</header><!-- End Header -->


