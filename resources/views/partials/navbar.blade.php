{{-- <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background: linear-gradient(to right, #0D6EFD, #0da5fd,#0de1fd);"> --}}
{{-- <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background: linear-gradient(to right, #291bf2, #5449fc,#6C63FF);"> --}}
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background: linear-gradient(to right, #1202f5, #5449fc,#3dabff);">
    <div class="container px-sm-5">
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
                @auth
                    <li class="nav-item dropdown mx-2">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Welcome back, {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/dashboard"><i class="bi bi-layout-text-sidebar-reverse"></i> My Dashboard</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="/logout" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item mx-2 d-flex align-items-center">
                        <a href="/login" class="btn btn-outline-light py-1 px-4 rounded-pill {{ Request::is('dashboard') ? 'active' : ''}}">Login Pemilih</a>
                    </li>
                    <li class="nav-item mx-2 d-flex align-items-center">
                        <a href="/login" class="btn btn-success py-1 px-4 rounded-pill border-0 {{ Request::is('dashboard') ? 'active' : ''}}" style="background: #38E54D">Login Panitia</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>