<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="#" class="b-brand text-primary">
                <center>
{{--                    <img src="{{ asset('images/leggo_orange.png') }}" style="width: 50%; margin-top: 5px"/>--}}
                </center>
                <span class="badge bg-light-success rounded-pill ms-2 theme-version float-right">v1.0</span>
            </a>
        </div>
        <div class="navbar-content">
            @if(auth()->user())
            <div class="card pc-user-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <img src="{{ asset('admin') }}/images/user/avatar-1.jpg" alt="user-image"
                                 class="user-avtar wid-45 rounded-circle"/>
                        </div>
                        <div class="flex-grow-1 ms-3 me-2">
                            <h6 class="mb-0">{{ auth()->user()->name ?? "User" }}</h6>
                        </div>
                        <a class="btn btn-primary btn-icon btn-link-secondary avtar text-black" data-bs-toggle="collapse"
                           href="#pc_sidebar_userlink">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-sort-outline"></use>
                            </svg>
                        </a>
                    </div>
                    <div class="collapse pc-user-links" id="pc_sidebar_userlink">
                        <div class="pt-3">
                            <a href="/profile">
                                <i class="ti ti-lock"></i>
                                <span>Profile</span>
                            </a>
                            <a href="/logout">
                                <i class="ti ti-power"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <ul class="pc-navbar">
                <li class="pc-item pc-caption">
                    <label>Analytics</label>
                </li>
                <li class="pc-item">
                    <a href="/" class="pc-link" target="">
                         <span class="pc-micon">
                            <i class="material-icons-two-tone">dashboard</i>
                        </span>
                        <span class="pc-mtext">Dashboard</span></a>
                </li>
                <li class="pc-item">
                    <a href="/drainage" class="pc-link" target="">
                        <span class="pc-micon">
                            <i class="material-icons-two-tone"> filter_b_and_w</i>
                        </span>
                        <span class="pc-mtext">Drainage System</span></a>
                </li>
                <li class="pc-item">
                    <a href="/maintenance" class="pc-link" target="">
                       <span class="pc-micon">
                            <i class="material-icons-two-tone"> error</i>
                        </span>
                        <span class="pc-mtext">Maintenance Report</span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
