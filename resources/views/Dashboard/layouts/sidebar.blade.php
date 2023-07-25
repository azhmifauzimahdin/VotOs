<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="/panitia" class="brand-link px-md-3">
    <span class="brand-text font-weight-light">Votos</span>
  </a>

  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image d-flex align-items-center">
        @if (auth()->user()->foto)
          <img src="{{ asset('storage/'. auth()->user()->foto) }}" class="img-circle elevation-2" style="aspect-ratio: 1/1" alt="User Image">
        @else
          <img src="{{ asset('storage/foto-user/defaultUser.png')}}" class="img-circle elevation-2" alt="User Image">
        @endif
      </div>
      <div class="info">
        <a href="#" class="d-inline" style="white-space: initial;">{{ auth()->user()->nama }}</a>
      </div>
    </div>

    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="/dashboard" class="nav-link {{ Request::is('dashboard') ? 'active' : ''}}">
            <i class="nav-icon fa-solid fa-house"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        @can('panitia')
          <li class="nav-item menu-open">
            <a href="#" class="nav-link {{ Request::is('dashboard/pemilih*') ? 'active' : ''}}">
              <i class="nav-icon fa-solid fa-users"></i>
              <p>
                Data Pemilih
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/dashboard/pemilih/siswa" class="nav-link {{ Request::is('dashboard/pemilih/siswa*') ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Siswa</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/dashboard/pemilih/gurukaryawan" class="nav-link {{ Request::is('dashboard/pemilih/gurukaryawan*') ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Guru & Karyawan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/dashboard/pemilih/kelas" class="nav-link {{ Request::is('dashboard/pemilih/kelas*') ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Kelas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/dashboard/pemilih/jabatan" class="nav-link {{ Request::is('dashboard/pemilih/jabatan*') ? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Data Jabatan
                  </p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="/dashboard/kandidat" class="nav-link {{ Request::is('dashboard/kandidat*') ? 'active' : ''}}">
              <i class="nav-icon fa-solid fa-user"></i>
              <p>
                Data Kandidat
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/dashboard/waktupemilu" class="nav-link {{ Request::is('dashboard/waktupemilu*') ? 'active' : ''}}">
              <i class="nav-icon fa-solid fa-calendar-days"></i>
              <p>
                Waktu Pemilu
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/dashboard/voting" class="nav-link {{ Request::is('dashboard/voting*') ? 'active' : ''}}">
              <i class="nav-icon fa-solid fa-pen"></i>
              <p>
                Data Voting
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/dashboard/hasilPemilu" class="nav-link {{ Request::is('dashboard/hasilPemilu*') ? 'active' : ''}}">
              <i class="nav-icon fa-solid fa-file"></i>
              <p>
                Hasil Pemilu
              </p>
            </a>
          </li>
        @endcan
        @can('admin')
          <li class="nav-item">
            <a href="/dashboard/user" class="nav-link {{ Request::is('dashboard/user*') ? 'active' : ''}}">
              <i class="nav-icon fa-solid fa-users-gear"></i>
              <p>
                Data Admin & Panitia
              </p>
            </a>
          </li>
        @endcan
        @can('panitia')
          <li class="nav-item">
            <a href="/dashboard/scan" class="nav-link {{ Request::is('dashboard/scan*') ? 'active' : ''}}">
              <i class=" nav-icon fa-solid fa-qrcode"></i>
              <p>
                Scan Surat Suara
              </p>
            </a>
          </li>
        @endcan
        <li class="nav-item">
          <a href="/dashboard/ganti_password" class="nav-link {{ Request::is('dashboard/ganti_password') ? 'active' : ''}}">
            <i class="nav-icon fa-solid fa-unlock"></i>
            <p>
              Ganti Password
            </p>
          </a>
        </li>
        <form action="/logoutUser" method="POST" id="logoutform" class="nav-item" style="cursor: pointer">
          @csrf
          <a onclick="document.getElementById('logoutform').submit()" class="nav-link">
            <i class="nav-icon fa-solid fa-arrow-right-from-bracket"></i>
            <p>
              Logout
            </p>
          </a>
        </form>
      </ul>
    </nav>

  </div>
</aside>