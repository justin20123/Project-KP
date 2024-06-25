<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="index.html" class="app-brand-link">
        <span class="app-brand-text demo menu-text fw-bolder ms-2">Welcome</span>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
      @auth
        <li class="{{ (request()->is('logout*')) ? 'menu-item active': 'menu-item'}}">
          <a  href="{{ route('logout') }}" class="menu-link"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              <i class="menu-icon tf-icons bx bx-log-out"></i>
              <div data-i18n="Analytics" style="color: red">Log Out</div>
          </a>
        </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
        </form>
      @else
        <li class="{{ (request()->is('login*')) ? 'menu-item active': 'menu-item'}}">
          <a href="{{ route('login') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-log-in"></i>
            <div data-i18n="Analytics" style="color: rgb(0, 160, 5)">Log In</div>
          </a>
        </li>
      @endauth
    </ul>
    
  </aside>
