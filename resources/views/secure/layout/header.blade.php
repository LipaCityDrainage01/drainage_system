<header class="pc-header">
    <div class="header-wrapper"> <!-- [Mobile Media Block] start -->
        <div class="me-auto pc-mob-drp">
            <ul class="list-unstyled">
                <!-- ======= Menu collapse Icon ===== -->
                <li class="pc-h-item pc-sidebar-collapse">
                    <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
                        <i class="ti ti-menu-2"></i>
                    </a>
                </li>
                <li class="pc-h-item pc-sidebar-popup">
                    <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
                        <i class="ti ti-menu-2"></i>
                    </a>
                </li>
                <li class="dropdown pc-h-item">
                    <a
                        class="pc-head-link dropdown-toggle arrow-none m-0 trig-drp-search"
                        data-bs-toggle="dropdown"
                        href="#"
                        role="button"
                        aria-haspopup="false"
                        aria-expanded="false"
                    >
                        <svg class="pc-icon">
                            <use xlink:href="#custom-search-normal-1"></use>
                        </svg>
                    </a>
                    <div class="dropdown-menu pc-h-dropdown drp-search">
                        <form class="px-3 py-2">
                            <input type="search" class="form-control border-0 shadow-none" placeholder="Search here. . ." />
                        </form>
                    </div>
                </li>
            </ul>
        </div>
        <!-- [Mobile Media Block end] -->
        <div class="ms-auto">
            <ul class="list-unstyled">

                <!-- notification -->
                <li class="dropdown pc-h-item">
                    <a
                        class="pc-head-link dropdown-toggle arrow-none me-0"
                        data-bs-toggle="dropdown"
                        href="#"
                        role="button"
                        aria-haspopup="false"
                        aria-expanded="false"
                    >
                        <svg class="pc-icon">
                            <use xlink:href="#custom-notification"></use>
                        </svg>
                        <span class="badge bg-success pc-h-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
                        <div class="dropdown-header d-flex align-items-center justify-content-between">
                            <h5 class="m-0">Notifications</h5>
                            <a href="#!" class="btn btn-link btn-sm">Mark all read</a>
                        </div>
                        <div class="dropdown-body text-wrap header-notification-scroll position-relative" style="max-height: calc(100vh - 215px)">
                            <p class="text-span">Today</p>
                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <svg class="pc-icon text-primary">
                                                <use xlink:href="#custom-layer"></use>
                                            </svg>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <span class="float-end text-sm text-muted">2 min ago</span>
                                            <h5 class="text-body mb-2">UI/UX Design</h5>
                                            <p class="mb-0"
                                            >Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of
                                                type and scrambled it to make a type</p
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="text-span">Yesterday</p>
                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <svg class="pc-icon text-primary">
                                                <use xlink:href="#custom-document-text"></use>
                                            </svg>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <span class="float-end text-sm text-muted">2 hour ago</span>
                                            <h5 class="text-body mb-2">Forms</h5>
                                            <p class="mb-0"
                                            >Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of
                                                type and scrambled it to make a type</p
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="text-center py-2">
                            <a href="#!" class="link-danger">Clear all Notifications</a>
                        </div>
                    </div>
                </li>
                @if(auth()->user())
                    <li class="dropdown pc-h-item header-user-profile">
                        <a
                            class="pc-head-link dropdown-toggle arrow-none me-0"
                            data-bs-toggle="dropdown"
                            href="#"
                            role="button"
                            aria-haspopup="false"
                            data-bs-auto-close="outside"
                            aria-expanded="false"
                        >
                            <img src="{{ asset('admin') }}/images/user/avatar-2.jpg" alt="user-image" class="user-avtar" />
                        </a>
                        <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                            <div class="dropdown-header d-flex align-items-center justify-content-between">
                                <h5 class="m-0">Profile</h5>
                            </div>
                            <div class="dropdown-body">
                                <div class="profile-notification-scroll position-relative" style="max-height: calc(100vh - 225px)">
                                    <div class="d-flex mb-1">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('admin') }}/images/user/avatar-2.jpg" alt="user-image" class="user-avtar wid-35" />
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">{{ auth()->user()->name ?? "Admin" }} 🖖</h6>
                                            <span>{{ auth()->user()->email ?? "admin@admin.com" }}</span>
                                        </div>
                                    </div>
                                    <hr class="border-secondary border-opacity-50" />
                                    <p class="text-span">Manage</p>
                                    <a href="/profile" class="dropdown-item">
                                  <span>
                                    <svg class="pc-icon text-muted me-2">
                                      <use xlink:href="#custom-user"></use>
                                    </svg>
                                    <span>My Account</span>
                                  </span>
                                    </a>
                                    <hr class="border-secondary border-opacity-50" />
                                    <div class="d-grid mb-3">
                                        <a href="/logout" class="btn btn-iconic">
                                            <svg class="pc-icon me-2">
                                                <use xlink:href="#custom-logout-1-outline"></use></svg
                                            >Logout
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </li>
                @endif
            </ul>
        </div>
    </div>
</header>
