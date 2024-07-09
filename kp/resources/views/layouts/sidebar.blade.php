<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
      <a href="index.html" class="app-brand-link">
        <img src="{{ asset('assets/img/logo.png') }}" alt="Messenger Academy Indonesia" style="width: 100%; height:100%;">
      </a>
  </div>

<div class="menu-inner-shadow"></div>

<ul class="menu-inner py-1">
  <!-- Dashboard -->
  {{-- <li class="{{ (request()->is('/')) ? 'menu-item active': 'menu-item'}}">
    <a href="{{ url('/') }}" class="menu-link">
      <i class="menu-icon bx bx-grid-alt"></i>
      <div data-i18n="Analytics">Dashboard</div>
    </a>
  </li> --}}


  @if (str_contains(Auth::user()->role, 'admin'))
  <li class="{{ (request()->is('pengajar*')) ? 'menu-item active': 'menu-item'}}">
    <a href="{{ url('pengajar') }}" class="menu-link">
      <i class="menu-icon tf-icons bx bx-user"></i>
      <div data-i18n="Analytics">Daftar Pengajar</div>
    </a>
  @endif

  
  @if (str_contains(Auth::user()->role, 'admin'))
  <li class="{{ (request()->is('peserta*')) ? 'menu-item active': 'menu-item'}}">
    <a href="{{ url('peserta') }}" class="menu-link">
      <i class="menu-icon tf-icons bx bxs-graduation"></i>
      <div data-i18n="Analytics">Daftar Peserta</div>
    </a>
  @endif

      
  @if (str_contains(Auth::user()->role, 'admin'))
  <li class="{{ (request()->is('orangtua*')) ? 'menu-item active': 'menu-item'}}">
    <a href="{{ route('orangtua.index') }}" class="menu-link">
      <i class='menu-icon tf-icon bx bxs-user-account'></i>
      <div data-i18n="Analytics">Daftar Orang Tua</div>
    </a>
  @endif
  @if (str_contains(Auth::user()->role, 'admin'))
  <li class="{{ (request()->is('pelatihan*')) ? 'menu-item active': 'menu-item'}}">
    <a href="{{ route('pelatihan.index') }}" class="menu-link">
      <i class='menu-icon fa-solid fa-chalkboard'></i>
      <div data-i18n="Analytics">Daftar Pelatihan</div>
    </a>
  @endif
  @if (str_contains(Auth::user()->role, 'admin') || str_contains(Auth::user()->role, 'pengajar'))
  <li class="{{ (request()->is('periode*')) ? 'menu-item active': 'menu-item'}}">
    <a href="{{ route('periode.index') }}" class="menu-link">
      <i class='menu-icon fa-regular fa-calendar-days'></i>
      <div data-i18n="Analytics">Periode</div>
    </a>
  @endif




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
