<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="justify-content: space-between">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        {{-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link ">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> --}}
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ">
        <!-- Navbar Search -->
        <!-- <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li> -->

        <!-- Messages Dropdown Menu -->
        {{-- <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
                <span class="badge badge-danger navbar-badge" id="messages-count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="messages-comp">
                
            </div>
        </li> --}}
        {{-- <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown" id="notfication-comp">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge  badge-warning navbar-badge" id="notifications-count"></span>
            </a>
           
        </li>  --}}

        <li class="nav-item">
            <a class="nav-link"href="{{ route('logout') }}"
                onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                <i class="fa   fa-sign-out"></i>
            </a>


            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li> --}}
        {{-- <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li> --}}
    </ul>
</nav>
