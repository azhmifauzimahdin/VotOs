<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="/panitia" class="brand-link px-md-3">
    <span class="brand-text font-weight-light">Votos</span>
  </a>

  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('AdminLTE') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ auth()->user()->nama }}</a>
      </div>
    </div>

    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="/dashboard" class="nav-link {{ Request::is('dashboard') ? 'active' : ''}}">
            <i class="nav-icon fa-solid fa-house" style="color: #ffffff;"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/dashboard/pemilih" class="nav-link {{ Request::is('dashboard/pemilih*') ? 'active' : ''}}">
            <i class="nav-icon fa-solid fa-users" style="color: #ffffff;"></i>
            <p>
              Data Pemilih
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="pages/gallery.html" class="nav-link {{ Request::is('dashboard/kandidat*') ? 'active' : ''}}">
            <i class="nav-icon fa-solid fa-user" style="color: #ffffff;"></i>
            <p>
              Data Kandidat
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="pages/gallery.html" class="nav-link {{ Request::is('dashboard/voting*') ? 'active' : ''}}">
            <i class="nav-icon fa-solid fa-pen" style="color: #ffffff;"></i>
            <p>
              Data Voting
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="pages/gallery.html" class="nav-link {{ Request::is('dashboard/panitia*') ? 'active' : ''}}">
            <i class="nav-icon fa-solid fa-users-gear" style="color: #ffffff;"></i>
            <p>
              Data Panitia
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="pages/gallery.html" class="nav-link {{ Request::is('dashboard/rekapitulasi*') ? 'active' : ''}}">
            <i class="nav-icon fa-solid fa-file" style="color: #ffffff;"></i>
            <p>
              Rekapitulasi
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/dashboard/ganti_password" class="nav-link {{ Request::is('dashboard/ganti_password') ? 'active' : ''}}">
            <i class="nav-icon fa-solid fa-unlock" style="color: #ffffff;"></i>
            <p>
              Ganti Password
            </p>
          </a>
        </li>
        <form action="/logoutUser" method="POST" id="logoutform" class="nav-item" style="cursor: pointer">
          @csrf
          <a onclick="document.getElementById('logoutform').submit()" class="nav-link">
            <i class="nav-icon fa-solid fa-arrow-right-from-bracket" style="color: #ffffff;"></i>
            <p>
              Logout
            </p>
          </a>
        </form>
          {{-- <a href="pages/gallery.html" class="nav-link">
            <i class="nav-icon fa-solid fa-arrow-right-from-bracket" style="color: #ffffff;"></i>
            <p>
              Logout
            </p>
          </a> --}}
      </ul>
    </nav>

  </div>
</aside>