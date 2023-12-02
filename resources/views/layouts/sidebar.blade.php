<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text ml-2">{{ config('app.name') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{ trans('Dashboard') }}</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item d-none">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo"
           aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Kullanıcılar</span>
        </a>
        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-darker py-0 collapse-inner rounded">
                <a class="collapse-item" href="buttons.html">Yöneticiler</a>
                <a class="collapse-item" href="cards.html">Öğretmenler</a>
                <a class="collapse-item" href="cards.html">Veliler</a>
            </div>
        </div>
    </li>
    @if(session('user')['role_id'] >= \App\Models\User::ROLE_ADMIN)
        <li class="nav-item {{ str_contains(request()->path(), 'schools')? 'active' : '' }}">
            <a class="nav-link" href="{{ route('schools.index') }}">
                <i class="fas fa-fw fa-graduation-cap"></i>
                <span>{{ trans('Schools') }}</span></a>
        </li>
    @endif

    <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-object-group"></i>
            <span>{{ trans('Groups') }}</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-bookmark"></i>
            <span>Sınıflar</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-user-md"></i>
            <span>Yöneticiler</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-female"></i>
            <span>Öğretmenler</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-users"></i>
            <span>Veliler</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-child"></i>
            <span>Öğrenciler</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-bullhorn"></i>
            <span>Duyurular</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-bus"></i>
            <span>Servisler</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-newspaper"></i>
            <span>Gazeteler</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-pen-square"></i>
            <span>Notlar</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-envelope"></i>
            <span>Mesajlar</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-images"></i>
            <span>Resimler</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-utensils"></i>
            <span>Yemek Takvimi</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-file"></i>
            <span>Kayıtlar</span></a>
    </li>

    <!-- Heading -->
    <div class="sidebar-heading d-none">
        Addons
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
