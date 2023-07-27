<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <form action="/logoutUser" method="post">
          @csrf
          <button type="submit" class="dropdown-item rounded-pill">
            <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
          </button>
        </form>
      </li>
    </ul>
  </nav>