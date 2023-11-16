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
                  <span style="color: #ffb03b">Admin</span>
                </div>
              </div>
              <a href="#" id="profile-dropdown" data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
              <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
                <a href="{{ route('admin.edit') }}" class="dropdown-item preview-item">
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
                <a href="{{ route('password.edit') }}" class="dropdown-item preview-item">
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
                <a href="{{ route('admin.advance.settings') }}" class="dropdown-item preview-item">
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
                <i class="mdi mdi-speedometer text-secondary"></i>
              </span>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>          
           

          <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#tab-to-open-drop-down" aria-expanded="false" aria-controls="auth">
              <span class="menu-icon">
                <i class="mdi mdi-food text-warning"></i>
              </span>
              <span class="menu-title">FoodsMenu</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tab-to-open-drop-down">
              <ul class="nav flex-column sub-menu">

                <li class="nav-item"> <a class="nav-link" href="{{ route('admin.create.food') }}">
                    <i class=" mdi mdi-border-color text-info p-1"></i>
                     Create Food  </a></li>

                <li class="nav-item"> <a class="nav-link" href="{{ route('admin.show.foods') }}">
                    <i class=" mdi mdi-food-fork-drink text-success p-1"></i>
                    Show Foods </a></li>
                 
              </ul>
            </div>
          </li>


          <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#chefs" aria-expanded="false" aria-controls="auth">
              <span class="menu-icon">
                <i class="mdi mdi-chef-hat"></i>
              </span>
              <span class="menu-title">Chefs</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="chefs">
              <ul class="nav flex-column sub-menu">

                <li class="nav-item"> <a class="nav-link" href="{{ route('add.chefs') }}">
                    <i class="mdi mdi-account-plus text-info p-1"></i>
                    Add </a></li>

                <li class="nav-item"> <a class="nav-link" href="{{ route('show.all.chefs') }}">
                    <i class="mdi mdi-eye text-success p-1"></i>
                    Show </a></li>

              </ul>
            </div>
          </li>         

 

          <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#table" aria-expanded="false" aria-controls="auth">
              <span class="menu-icon">
                <i class="mdi mdi-chair-school"></i>
              </span>
              <span class="menu-title">Table</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="table">
              <ul class="nav flex-column sub-menu">

                <li class="nav-item"> <a class="nav-link" href="{{ route('admin.create.tables') }}">
                    <i class=" mdi mdi-transcribe text-info p-1"></i>
                    Create </a></li>

                <li class="nav-item"> <a class="nav-link" href="{{ route('admin.show.all.tables') }}">
                    <i class="mdi mdi-eye text-success p-1"></i>
                    Show </a></li>
                

                <li class="nav-item"> <a class="nav-link" href="{{ route('admin.make.reservation') }}">
                    <i class="mdi mdi-calendar-clock text-warning p-1"></i>
                    Make Reservation </a></li>

                <li class="nav-item"> <a class="nav-link" href="{{ route('admin.show.all.reserved.table') }}">
                    <i class="mdi mdi-timetable text-primary p-1"></i>
                    Reserved </a></li>
              </ul>
            </div>
          </li>

         
          
          <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <span class="menu-icon">
                <i class="mdi mdi-account-group-outline"></i>
              </span>
              <span class="menu-title">User Pages</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">

                <li class="nav-item"> <a class="nav-link" href="{{ route('admin.show.users') }}">
                    <i class=" mdi mdi-account-multiple-outline text-info p-1"></i>
                      Show Users </a></li>

                <li class="nav-item"> <a class="nav-link" href="{{ route('admin.create.user') }}">
                    <i class=" mdi mdi-account-plus text-success p-1"></i>
                    Create User </a></li>
                

                <li class="nav-item"> <a class="nav-link" href="{{ route('admin.delete.user') }}">
                    <i class=" mdi mdi-account-off text-danger p-1"></i>
                     Delete User </a></li>

                <li class="nav-item"> <a class="nav-link" href="{{ route('admin.users.trush') }}">
                    <i class=" mdi mdi-delete text-secondary p-1"></i>
                     Trush </a></li>
              </ul>
            </div>
          </li>


          <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('admin.show.orders') }}">
              <span class="menu-icon">
                <i class="mdi mdi-calendar-multiple-check text-success"></i>                                              
              </span>              
              <span class="menu-title">Orders</span>
            </a>
          </li>


          <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#worker" aria-expanded="false" aria-controls="auth">
              <span class="menu-icon">
                <i class="mdi mdi-worker"></i>
              </span>
              <span class="menu-title">Workers</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="worker">
              <ul class="nav flex-column sub-menu">

                <li class="nav-item"> <a class="nav-link" href="{{ route('add.worker') }}">
                    <i class="mdi mdi-account-plus text-success p-1"></i>
                    Add </a></li>

                <li class="nav-item"> <a class="nav-link" href="{{ route('show.workers') }}">
                    <i class="mdi mdi-eye text-primary p-1"></i>
                    Show </a></li>

              </ul>
            </div>
          </li>  


          <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#Expense" aria-expanded="false" aria-controls="auth">
              <span class="menu-icon">
                <i class="mdi mdi-cash-multiple"></i>
              </span>
              <span class="menu-title">Expenses</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="Expense">
              <ul class="nav flex-column sub-menu">

                <li class="nav-item"> <a class="nav-link" href="{{ route('daily.expense') }}">
                    <i class="mdi mdi-pen text-success p-1"></i>
                    Add </a></li> 

                <li class="nav-item"> <a class="nav-link" href="{{ route('expenses.list') }}">
                    <i class="mdi mdi-view-list text-primary p-1"></i>
                    List </a></li>

                <li class="nav-item"> <a class="nav-link" href="{{ route('monthly.expense') }}">
                  <i class="mdi mdi-calendar-text text-info p-1"></i>
                  Monthly Expense </a></li>

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
               
              
              <li class="nav-item dropdown border-left">
                <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="mdi mdi-email"></i>
                  <span class="count bg-success"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                  <h6 class="p-3 mb-0">Messages</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="assets/images/faces/face4.jpg" alt="image" class="rounded-circle profile-pic">
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">Mark send you a message</p>
                      <p class="text-muted mb-0"> 1 Minutes ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="assets/images/faces/face2.jpg" alt="image" class="rounded-circle profile-pic">
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">Cregh send you a message</p>
                      <p class="text-muted mb-0"> 15 Minutes ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <img src="assets/images/faces/face3.jpg" alt="image" class="rounded-circle profile-pic">
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject ellipsis mb-1">Profile picture updated</p>
                      <p class="text-muted mb-0"> 18 Minutes ago </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <p class="p-3 mb-0 text-center">4 new messages</p>
                </div>
              </li>
              <li class="nav-item dropdown border-left">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                  <i class="mdi mdi-bell"></i>
                  <span class="count bg-danger"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                  <h6 class="p-3 mb-0">Notifications</h6>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-calendar text-success"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Event today</p>
                      <p class="text-muted ellipsis mb-0"> Just a reminder that you have an event today </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-settings text-danger"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Settings</p>
                      <p class="text-muted ellipsis mb-0"> Update dashboard </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-dark rounded-circle">
                        <i class="mdi mdi-link-variant text-warning"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <p class="preview-subject mb-1">Launch Admin</p>
                      <p class="text-muted ellipsis mb-0"> New admin wow! </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  <p class="p-3 mb-0 text-center">See all notifications</p>
                </div>
              </li>
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
                  <a href="{{ route('admin.edit') }}" class="dropdown-item preview-item">
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
                  <p class="p-3 mb-0 text-center"><a href="{{ route('admin.advance.settings') }}" class="text-light" style="text-decoration: none;"> Advanced settings </a></p>
                </div>
              </li>
            </ul>            
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


    <!--Additional JS File(amader create kora js file gulo aikhane ashbe)-->  

    @yield('custom_js')

  </body>
</html>