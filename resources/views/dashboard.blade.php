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
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
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
        @can('Dashboard')
        <li>
          <a href="/dashboard" class="{{$page == 'main' ? ' active' : ''}}">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        @endcan
        @can('Pelaporancrud')
        <li>
          <a href="/report" class="{{$page == 'report' ? ' active' : ''}}">
            <i class='bx bxs-comment-error' ></i>
            <span class="links_name">Pelaporan</span>
          </a>
        </li>
        @endcan
        @can('Rekap Laporan')
        <li>
          <a href="/rekap-laporan" class="{{$page == 'recap' ? ' active' : ''}}">
            <i class='bx bx-book-content' ></i>
            <span class="links_name">Rekap Laporan</span>
          </a>
        </li>
        @endcan
        @can('Data master')
        <li>
          <div class="dropdown">
            <a class="dropdown-toggle {{$page == 'data' ? ' active' : ''}}" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class='bx bx-data'></i>
              <span class="links_name">Data Master</span>
            </a>
            <div class="dropdown-menu" style="background: #081D45; opacity:0.9; width: 95%" aria-labelledby="dropdownMenuLink">
              @can('Kategoricrud')
              <a class="dropdown-item" href="/category">
                <i class='bx bx-folder' ></i>
                <span class="links_name">Category</span>
              </a>
              @endcan
              @can('Statuscrud')
              <a class="dropdown-item" href="/status">
                <i class='bx bxs-info-circle' ></i>
                <span class="links_name">Status</span>
              </a>
              @endcan
              @can('Kewenangancrud')
              <a class="dropdown-item" href="/authority">
                <i class='bx bx-pen' ></i>
                <span class="links_name">Authority</span>
              </a>
              @endcan
              @can('Regioncrud')
                <a class="dropdown-item" href="/region">
                  <i class='bx bx-globe' ></i>
                  <span class="links_name">Region</span>
                </a>
              @endcan
            </div>
          </div>
        </li>
        @endcan
        @can('Configuration')
        <li>
          <div class="dropdown">
            <a class="dropdown-toggle dropdown-bottom {{$page == 'configuration' ? ' active' : ''}}" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class='bx bxs-user-detail'></i>
              <span class="links_name">Configuration</span>
            </a>
            <div class="dropdown-menu" style="background: #081D45; opacity:0.9; width: 95%" aria-labelledby="dropdownMenuLink">
              @can('Usercrud')
              <a class="dropdown-item" href="/administrator">
                <i class='bx bx-user' ></i>
                <span class="links_name">Administrator</span>
              </a>
              @endcan
              @can('Group Usercrud')
              <a class="dropdown-item" href="/group-user">
                <i class='bx bxs-group' ></i>
                <span class="links_name">Group User</span>
              </a>
              @endcan
            </div>
          </div>
        </li>
        @endcan
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