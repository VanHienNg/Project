<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">

    @if (session('status'))
        <div class="alert alert-danger text-left" style="margin-top: 10px">
            {{ session('status') }}
        </div>
    @endif

    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
        @if(auth() -> check())
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline" id="user-login-name"
                style="font-size:20px; color:#5a5d6a">{{ auth()->user()->name }}</span>
            <img class="img-profile" style="height:40px;width:40px"
                src="{{ asset('template/img/user-icon.jpg')}}">
        </a>

        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="userDropdown">
            @if(auth()->user()->role == "admin")
            <a class="dropdown-item" href="/admin">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Admin
            </a>
            @endif
            @if(auth()->user()->role == "staff")
            <a class="dropdown-item" href="/post">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                User
            </a>
            @endif
            <a class="dropdown-item" href="/register">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Register
            </a>
            <a class="dropdown-item" href="/logout">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Logout
            </a>
        </div>
        @else
        <div class="row">
            <a class="nav-link dropdown-toggle col" href="/login" id="userDropdown" role="button">
                <span class="mr-2 d-none d-lg-inline" id="user-login-link"
                    style="font-size:20px; color:#5a5d6a">Login</span>
            </a>
            <a class="nav-link dropdown-toggle col" href="/register" id="userDropdown" role="button">
                <span class="mr-2 d-none d-lg-inline" id="user-register-link"
                    style="font-size:20px; color:#5a5d6a">Register</span>
            </a>
        </div>
        @endif
    </li>

</ul>