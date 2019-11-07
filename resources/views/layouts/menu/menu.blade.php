  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
          </li>
      </ul>
      <ul class="navbar-nav ml-auto">
          <li class="nav-item">
              <form action="{{ route('logout') }}" method="post">
              @csrf
              <button type="submit" class="nav-link" style="background: white; border:0px">
                  <i class="fas fa-sign-out-alt"></i>
              </button>
              </form>
          </li>
      </ul>
  </nav>