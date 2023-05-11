<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      {{-- <li class="nav-item pr-md-3">
        <img src="{{ asset('AdminLTE') }}/dist/img/user2-160x160.jpg" width="33" height="33" class="rounded-circle bg-info">
        <a href="#" class="text-dark">Azhmi Fauzi Mahdin - Administrator</a>
      </li> --}}
      <li class="nav-item">
        <form action="/logout" method="post">
          @csrf
          <button type="submit" class="dropdown-item"><i class="fa-solid fa-arrow-right-from-bracket" style="color: #000000;"></i> LOGOUT</button>
        </form>
      </li>
    </ul>
  </nav>