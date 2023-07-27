<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-votos">
    <div class="container px-3 px-md-0">
        <a class="navbar-brand" href="/">Votos</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse ms-auto" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item mx-2">
                    <a class="nav-link {{ Request::is('/') ? 'active' : ''}}" href="/">Beranda</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link {{ Request::is('perolehan-suara') ? 'active' : ''}}" href="/perolehan-suara">Perolehan Suara</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link {{ Request::is('kandidat*') ? 'active' : ''}}" href="/kandidat">Kandidat</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link {{ Request::is('voting*') ? 'active' : ''}}" href="/voting">Voting</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link {{ Request::is('scan*') ? 'active' : ''}}" href="/scan">Scan Surat Suara</a>
                </li>
                @auth('pemilih')
                    <li class="nav-item dropdown mx-2">
                        <a class="nav-link dropdown-toggle {{ Request::is('*') ? 'active' : ''}}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ auth('pemilih')->user()->nama }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 py-0 overflow-hidden dropdown-logout">
                            <li class="mb-2 mb-md-0">
                                <a href="ganti_password" class="button-logout dropdown-item py-0 py-md-2">
                                    <i class="icon-navbar nav-icon fa-solid fa-lock"></i>
                                    <span class="ms-md-1">Ganti Password</span>
                                </a>
                            </li>
                            <li>
                                <form action="/logoutPemilih" method="post">
                                    @csrf
                                    <button type="submit" class="button-logout dropdown-item py-0 py-md-2">
                                        <i class="icon-navbar nav-icon fa-solid fa-arrow-right-from-bracket"></i>
                                        <span class="ms-md-1">Logout</span>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item mx-2 d-flex align-items-center">
                        <a href="/loginPemilih" class="btn btn-outline-light py-1 px-3 rounded-pill my-2 my-md-0{{ Request::is('dashboard') ? 'active' : ''}}">Login Pemilih</a>
                    </li>
                    <li class="nav-item mx-2 d-flex align-items-center">
                        <a href="/loginUser" class="btn btn-success py-1 px-3 rounded-pill bg-v-success border-0 my-2 my-md-0{{ Request::is('dashboard') ? 'active' : ''}}">Login Admin/Panitia</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>