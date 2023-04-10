<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container px-sm-5">
        <a class="navbar-brand" href="/">Votos</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse ms-auto" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item mx-2">
                    <a class="nav-link {{ ($active === "home") ? 'active' : '' }}" href="/">Beranda</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link {{ ($active === "posts") ? 'active' : '' }}" href="/posts">Perolehan Suara</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link {{ ($active === "about") ? 'active' : '' }}" href="/about">Kandidat</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link {{ ($active === "categories") ? 'active' : '' }}" href="/categories">Voting</a>
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
                        <a href="/login" class="btn btn-outline-light py-1 px-4 rounded-pill {{ ($active === "login") ? 'active' : '' }}">Login Pemilih</a>
                    </li>
                    <li class="nav-item mx-2 d-flex align-items-center">
                        <a href="/login" class="btn btn-success py-1 px-4 rounded-pill {{ ($active === "as") ? 'active' : '' }}">Login Panitia</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>