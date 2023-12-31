<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> @yield('title') </title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,600,600i,700,700i|Satisfy|Comic+Neue:300,300i,400,400i,700,700i" rel="stylesheet">
   
    <!-- plugins:css -->
    <link rel="stylesheet" href="admin/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="admin/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="admin/assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="admin/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="admin/assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="admin/assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="admin/assets/css/style.css">
   
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/img/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
       
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
          <a class="sidebar-brand brand-logo brand-customize" href="{{ route('dashboard') }}"><h1 class="pt-lg-3 pl-lg-3" style="color: #ffb03b">McDonald's</h1></a>
          <a class="sidebar-brand brand-logo-mini" href="{{ route('dashboard') }}"><img class="img-x rounded-circle" src="assets/img/favicon.png" alt="logo" /></a>
        </div>
        <ul class="nav">
          <li class="nav-item profile">
            <div class="profile-desc">
              <div class="profile-pic">
                <div class="count-indicator">
                  <img class="img-xs rounded-circle " src="Users_images/{{ $authUser->image }}" alt="">
                  <span class="count bg-success"></span>
                </div>
                <div class="profile-name">
                  <h5 class="mb-0 font-weight-normal">{{ $authUser->name }}</h5>
                  <span style="color: #ffb03b">User</span>
                </div>
              </div>
              <a href="#" id="profile-dropdown" data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
              <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
                <a href="{{ route('profile.edit') }}" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-settings text-primary"></i>
                    </div>
                  </div>
                  <div class="preview-item-content" hre>
                   <p class="preview-subject ellipsis mb-1 text-small" >Account settings</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('user.password.edit') }}" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-onepassword  text-info"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('user.advance.settings') }}" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-delete text-danger"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject ellipsis mb-1 text-small">Delete Account</p>
                  </div>
                </a>
              </div>
            </div>
          </li>
          <li class="nav-item nav-category">
            <span class="nav-link">Navigation</span>
          </li>

          <li class="nav-item menu-items">
            <a class="nav-link" href="{{ url('/') }}">
              <span class="menu-icon">
                <i class="mdi mdi-home"></i>
              </span>
              <span class="menu-title">Home</span>
            </a>
          </li> 

          <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('dashboard') }}">
              <span class="menu-icon">
                <i class="mdi mdi-speedometer text-warning"></i>
              </span>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>  

          @if ($orderCount > '0')

            <li class="nav-item menu-items">
              <a class="nav-link" href="{{ route('order.history') }}">
                <span class="menu-icon">
                  <i class="mdi mdi-calendar-multiple-check text-success"></i>                                              
                </span>              
                <span class="menu-title">Order History</span>
              </a>
            </li>

          @else

            <li class="nav-item menu-items">
              <a class="nav-link" href="{{ route('order.history') }}">
                <span class="menu-icon">
                  <i class="mdi mdi-calendar-multiple-check text-danger"></i>                                              
                </span>              
                <span class="menu-title">Order History</span>
              </a>
            </li>
            
          @endif            
          
          <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#reservations" aria-expanded="false" aria-controls="auth">
              <span class="menu-icon">
                <i class="mdi mdi-table-edit"></i>
              </span>
              <span class="menu-title">Reservations</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="reservations">
              <ul class="nav flex-column sub-menu">

                <li class="nav-item"> <a class="nav-link" href="{{ url('/#book-a-table') }}">
                    <i class="mdi mdi-border-color text-success p-1"></i>
                    Make </a></li> 

                <li class="nav-item"> <a class="nav-link" href="{{ route('table.reservations') }}">
                    <i class="mdi mdi-view-list text-primary p-1"></i>
                    All Reservations </a></li>

              </ul>
            </div>
          </li>           
          
          <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#message" aria-expanded="false" aria-controls="auth">
              <span class="menu-icon">
                <i class="mdi mdi-email text-light"></i>
              </span>
              <span class="menu-title">Message</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="message">
              <ul class="nav flex-column sub-menu">

                <li class="nav-item"> <a class="nav-link" href="{{ url('/#contact') }}">
                    <i class="mdi mdi-border-color text-info p-1"></i>
                    Make </a></li> 

                <li class="nav-item"> <a class="nav-link" href="{{ route('all.messages') }}">
                    <i class="mdi mdi-view-list text-success p-1"></i>
                    All Messages </a></li>

              </ul>
            </div>
          </li>
           
        </ul>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar p-0 fixed-top d-flex flex-row">
          <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
            <a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/img/favicon.png" alt="logo" /></a>
          </div>
          <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>
             
            <ul class="navbar-nav navbar-nav-right">
               
              @if ($specificUserNotifications->isEmpty())

                <li class="nav-item dropdown border-left">
                  <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-bell"></i>
                    <span class="count bg-danger"></span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                    <h6 class="p-3 mb-0">Notificatons</h6>
                    <div class="dropdown-divider"></div>               
                       
                                           
                    <p class="text-muted preview-subject p-3 text-center">Empty!!!</p>         
                   
                    
                  </div>
                </li>

              @else 
              
                <li class="nav-item dropdown border-left">
                  <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-bell"></i>
                    <span class="count bg-success"></span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                    <h6 class="p-3 mb-0">Notificatons</h6>
                    <div class="dropdown-divider"></div>

                    @foreach ($specificUserNotifications as $notification)
                      <a href="{{ route('all.notifications') }}" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                          <img src="Users_images/{{ $notification->image }}" alt="image" class="rounded-circle profile-pic">
                        </div>
                        <div class="preview-item-content">
                          <p class="preview-subject ellipsis mb-1">New Food Has Arrived!!!</p>
                          <p class="text-muted mb-0">Admin</p>
                          <p class="text-muted mb-0"> {{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }} </p> <!--\Carbon\Carbon::parse($notification->created_at)->diffForHumans() ai ta amader messages table ar created_at column take 10 min ago 20min ago aivabe dekhabe jar jonno ami akta package use korechi check Readme.md-------->
                        </div>
                      </a>
                      <div class="dropdown-divider"></div>
                    @endforeach           

                    
                    <a href="{{ route('all.notifications') }}" class="text-light" style="text-decoration: none;"><p class="p-3 mb-0 text-center">All Notificatons</p></a>
                  </div>
                </li>

              @endif
              
        
                @if ( $count > "0")  <!--akhane ami if ar moddhe moddhe bole diyechi jodi $count ar value 0 ar theke boro hoy tahole amader nicher code ta execute hobe jei code tuku ami amader if ar moddhe likhe diyechi mane amader cart icon ar opore green light dekhabe and amader ai $count variable ta ashche RedirectUsersController.php ar index() method theke---->
                  <li class="nav-item dropdown">
                  <a class="nav-link count-indicator" href="{{ route('show.cart') }}">
                      <i class="mdi mdi-cart text-light"><span class="font text-success" style="font-size: 18px;">{{ $count }}</span></i>
                      <span class="count bg-success"></span>
                  </a>                                    
                  </li>
            
               @else <!--$count ar value jodi 0 ar theke boro na hoy tahole ai code ta execute hobe mane amader cart icon ar opore red light dekhabe--->
                  <li class="nav-item dropdown">
                  <a class="nav-link count-indicator"  href="{{ route('show.cart') }}">
                      <i class="mdi mdi-cart text-light"><span class="font text-danger" style="font-size: 18px;">{{ $count }}</span></i>
                      <span class="count bg-danger"></span>
                  </a>                                    
                  </li>
            
               @endif  
              

              <li class="nav-item dropdown">
                <a class="nav-link" id="profileDropdown" href="#" data-bs-toggle="dropdown">
                  <div class="navbar-profile">
                    <img class="img-xs rounded-circle" src="Users_images/{{ $authUser->image }}" alt="">
                    <p class="mb-0 d-none d-sm-block navbar-profile-name">{{ $authUser->name }} </p>
                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                  <h6 class="p-3 mb-0">Profile</h6>
                  <div class="dropdown-divider"></div>
                  <a href="{{ route('profile.edit') }}" class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-settings text-success"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Settings</p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-logout text-danger"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                        <form method="POST" action="{{ route('logout') }}">
                             @csrf 
                        
                            <button type="submit"> <p class="preview-subject mb-1 text-white">Log out</p></button>
                        </form>
                     
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <p class="p-3 mb-0 text-center"><a href="{{ route('user.advance.settings') }}" class="text-light" style="text-decoration: none;"> Advanced settings </a></p>
                </div>
              </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-format-line-spacing"></span>
            </button>
          </div>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          


          @yield('body')


           
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="admin/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="admin/assets/vendors/chart.js/Chart.min.js"></script>
    <script src="admin/assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="admin/assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="admin/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="admin/assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <script src="admin/assets/js/jquery.cookie.js" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="admin/assets/js/off-canvas.js"></script>
    <script src="admin/assets/js/hoverable-collapse.js"></script>
    <script src="admin/assets/js/misc.js"></script>
    <script src="admin/assets/js/settings.js"></script>
    <script src="admin/assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="admin/assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->



    <!--========== THIS LINKS FOR Sales Chart ============ -->

  
    <!-- Custom js for this page -->
    <script src="admin/assets/js/chart.js"></script>
    <!-- End custom js for this page -->


    <!--Additional JS File(amader create kora js file gulo aikhane ashbe)-->  

    @yield('custom_js')

  </body>
</html>