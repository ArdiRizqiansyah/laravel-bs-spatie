<div class="sidebar col-lg-3 mx-lg-0">
    <div class="d-none d-sm-block">
        <div class="card secondary-color col-sm-12">
            <div class="bg-profile">
                <img src="{{ auth()->user()->getPhoto() }}" alt="avatar" class="avatar">
                <p class="bg-profile-text">{{ auth()->user()->name }}</p>
            </div>
            <div class="card-body p-4">
                <div class="sidebar-menu">
                    <a class="text-sidebar d-block p-2 m-1 {{ request()->routeIs('admin.user.*') ? 'active' : '' }}" href="#">
                        <i class="fas fa-users me-2"></i>
                        User
                    </a>
                </div>
                <div class="sidebar-menu">
                    <a class="text-sidebar d-block p-2 m-1" href="{{ route('logout') }}">
                        <i class="fas fa-sign-out-alt me-2"></i>
                        Log Out
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
