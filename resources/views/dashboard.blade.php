<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Techno Report | @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/subMenu.css') }}">      
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    @yield('css')
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bxs-error'></i>
      <span class="logo_name">Report App</span>
    </div class="content">
      <ul class="nav-links menu-items">
        <li>
          <a href="/dashboard" class="{{$page == 'main' ? ' active' : ''}}">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="/pelaporan" class="{{$page == 'report' ? ' active' : ''}}">
            <i class='bx bxs-comment-error' ></i>
            <span class="links_name">Pelaporan</span>
          </a>
        </li>
        <li>
          <a href="/rekap-laporan">
            <i class='bx bx-book-content' ></i>
            <span class="links_name">Rekap Laporan</span>
          </a>
        </li>
        <li>
          <a href="/data-master">
            <i class='bx bx-data' ></i>
            <span class="links_name">Data Master</span>
          </a>
        </li>
        <li>
          <a href="/administrator" class="{{$page == 'admin' ? ' active' : ''}}">
            <i class='bx bxs-user-detail' ></i>
            <span class="links_name">Administrator</span>
          </a>
        </li>
        {{-- <li>
          <div class="select-menu">
              <div class="select-btn">
                <i class='bx bx-cog' ></i>
                <span class="links_name">Settings</span>
                <i class="bx bx-chevron-down"></i>
              </div>
              <ul class="options">
                <li>
                  <a href="#">
                    <span class="links_name">Settings</span>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <i class='bx bx-data' ></i>
                    <span class="links_name">Data Master</span>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <i class='bx bx-data' ></i>
                    <span class="links_name">Data Master</span>
                  </a>
                </li>
              </ul>
          </div>
        </li> --}}
        <li>
          <li class="log_out">
            <a href="/logout">
              <i class='bx bx-log-out'></i>
              <span class="links_name">Log out</span>
            </a>
          </li>
        </li>
      </ul>
  </div>

  @yield('content')

 <script src="{{asset ('js/script.js')}}"></script>
 @yield('js')
</body>
</html>