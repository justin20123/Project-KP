<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
      <a href="index.html" class="app-brand-link">
        <img src="{{ asset('assets/img/logo.png') }}" alt="Messenger Academy Indonesia" style="width: 100%; height:100%;">
      </a>
  </div>

<div class="menu-inner-shadow"></div>

<ul class="menu-inner py-1">
  <!-- Dashboard -->
  <li class="{{ (request()->is('/')) ? 'menu-item active': 'menu-item'}}">
    <a href="{{ url('/') }}" class="menu-link">
      <i class="menu-icon bx bx-grid-alt"></i>
      <div data-i18n="Analytics">Dashboard</div>
    </a>
  </li>

  @if (str_contains(Auth::user()->role, 'superadmin') || str_contains(Auth::user()->role, 'admin'))
  <li class="{{ (request()->is('level*')) ? 'menu-item active': 'menu-item'}}">
    <a href="{{ url('level') }}" class="menu-link">
      <i class="menu-icon tf-icons bx bx-first-aid"></i>
      <div data-i18n="Analytics">Level Pelatihan</div>
    </a>
  </li>
  @endif

  @if (str_contains(Auth::user()->role, 'superadmin') || str_contains(Auth::user()->role, 'admin') || str_contains(Auth::user()->role, 'pengajar'))
  <li class="{{ (request()->is('pelatihan*')) ? 'menu-item active': 'menu-item'}}">
    <a href={{ url('pelatihan') }} class="menu-link">
      <i class="menu-icon tf-icons bx bx-book"></i>
      <div data-i18n="Analytics">Jenis Pelatihan</div>
    </a>
  </li>
  @endif

  @if (str_contains(Auth::user()->role, 'superadmin') || str_contains(Auth::user()->role, 'admin'))
  <li class="{{ (request()->is('admin*')) ? 'menu-item active': 'menu-item'}}">
    <a href="{{ url('admin') }}" class="menu-link">
      <i class="menu-icon tf-icons bx bx-male"></i>
      <div data-i18n="Analytics">Admin</div>
    </a>
  </li>
  @endif

  @if (str_contains(Auth::user()->role, 'superadmin') || str_contains(Auth::user()->role, 'admin'))
  <li class="{{ (request()->is('pengajar*')) ? 'menu-item active': 'menu-item'}}">
    <a href="{{ url('pengajar') }}" class="menu-link">
      <i class="menu-icon tf-icons bx bx-user"></i>
      <div data-i18n="Analytics">Daftar Pengajar</div>
    </a>
  @endif

  
  @if (str_contains(Auth::user()->role, 'superadmin') || str_contains(Auth::user()->role, 'admin'))
  <li class="{{ (request()->is('peserta*')) ? 'menu-item active': 'menu-item'}}">
    <a href="{{ url('peserta') }}" class="menu-link">
      <i class="menu-icon tf-icons bx bxs-graduation"></i>
      <div data-i18n="Analytics">Daftar Peserta</div>
    </a>
  @endif

      
  @if (str_contains(Auth::user()->role, 'superadmin') || str_contains(Auth::user()->role, 'admin'))
  <li class="{{ (request()->is('orangtua*')) ? 'menu-item active': 'menu-item'}}">
    <a href="{{ url('orangtua') }}" class="menu-link">
      <i class='menu-icon tf-icon bx bxs-user-account'></i>
      <div data-i18n="Analytics">Daftar Orang Tua</div>
    </a>
  @endif

  @if (str_contains(Auth::user()->role, 'peserta'))
  <li class="{{ (request()->is('absensi*')) ? 'menu-item active': 'menu-item'}}">
    <a href="{{ url('index/absenPeserta') }}" class="menu-link">
      <i class="menu-icon tf-icons bx bxs-notepad"></i>
      <div data-i18n="Analytics">Absensi</div>
    </a>
  @endif

  @if (str_contains(Auth::user()->role, 'pengajar'))
  <li class="{{ (request()->is('absensi*')) ? 'menu-item active': 'menu-item'}}">
    <a href="{{ url('index/bukaAbsen') }}" class="menu-link">
      <i class="menu-icon tf-icons bx bxs-notepad"></i>
      <div data-i18n="Analytics">Buka Absensi</div>
    </a>
  @endif

  <li class="{{ (request()->is('ubahpassword*')) ? 'menu-item active': 'menu-item'}}">
    <a href="{{ url('ubahpassword') }}" class="menu-link">
      <i class="menu-icon tf-icons bx bx-key"></i>
      <div data-i18n="Analytics">Ubah Password</div>
    </a>
  </li>

  <li class="menu-item">
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn menu-link btn-logout">
            <i class="menu-icon tf-icons bx bx-log-out"></i>
            <div>Logout</div>
        </button>
    </form>
</li>
</ul>
</aside>
