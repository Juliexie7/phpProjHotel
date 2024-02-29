<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <!-- Container wrapper -->
  <div class="container">
    <!-- Navbar brand -->
    <a class="navbar-brand me-3 " href="{{ route('hotel') }}">
      <img
        src="{{ url('/images/logo.png') }}"
        height="40"
        alt="Hotel Logo"
        loading="lazy"
        style="margin-top: -1px;"
      />
    </a>

    <!-- Toggle button -->
    <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarButtonsExample"
      aria-controls="navbarButtonsExample"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>

    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarButtonsExample">
      <!-- Left links -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/') }}">Hotels</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Dining</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Meetings & Events</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Special Offers</a>
        </li>
      </ul>
      <!-- Left links -->

      <div class="d-flex align-items-center">
        <a class="text-reset me-2" href="#">
          <i class="fas fa-shopping-cart"></i>
        </a>
        <button type="button" class="btn btn-link px-3 me-2" onclick="window.location='{{ route("login") }}'">
          Login
        </button>
        <button type="button" class="btn btn-primary me-3" onclick="window.location='{{ route("register") }}'">
          Sign up
        </button>
      </div>
    </div>
    <!-- Collapsible wrapper -->
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->