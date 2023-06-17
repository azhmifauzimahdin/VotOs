<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background: linear-gradient(to right, #1202f5, #5449fc,#3dabff);">
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
                    <a class="nav-link {{ Request::is('scan*') ? 'active' : ''}}" href="/scan">Scan QR Code</a>
                </li>
                @auth('pemilih')
                    <li class="nav-item dropdown mx-2">
                        <a class="nav-link dropdown-toggle {{ Request::is('*') ? 'active' : ''}}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ auth('pemilih')->user()->nama }}
                        </a>
                        <ul class="dropdown-menu border-0 py-0 overflow-hidden">
                            <li>
                                <form action="/logoutPemilih" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item py-2">
                                        <i class="nav-icon fa-solid fa-arrow-right-from-bracket mr-5"></i>
                                        Logout
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
                        <a href="/loginUser" class="btn btn-success py-1 px-3 rounded-pill border-0 my-2 my-md-0{{ Request::is('dashboard') ? 'active' : ''}}" style="background: #03C988">Login Admin/Panitia</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>