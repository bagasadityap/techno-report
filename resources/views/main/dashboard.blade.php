@extends('dashboard')

@section('title')
Dashboard
@endsection

@section('content')
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Dashboard</span>
      </div>
      {{-- <div class="search-box">
        <input type="text" placeholder="Search...">
        <i class='bx bx-search' ></i>
      </div>
      <div class="profile-details">
        <img src="images/profile.jpg" alt="">
        <span class="admin_name">Prem Shahi</span>
        <i class='bx bx-chevron-down' ></i>
      </div> --}}
      <div class="profile-details">
        <span class="admin_name">{{ Auth::user()->name }}</span>
        <i class='bx bx-chevron-down' ></i>
      </div>
    </nav>

    <div class="home-content">
      <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Laporan Hari Ini</div>
            <div class="number">1</div>
          </div>
          <i class='bx bx-calendar-alt cart green'></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Laporan Minggu Ini</div>
            <div class="number">5</div>
          </div>
          <i class='bx bx-calendar-event cart green2' ></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Laporan Bulan Ini</div>
            <div class="number">20</div>
          </div>
          <i class='bx bx-calendar cart green3' ></i>
        </div>
      </div>
      <hr style="text-align:left; margin-bottom:5px; border-color: rgba(0, 0, 0, 0.5);">
      <p style="padding-left: 30px; font-size: 25px; margin-bottom: 10px">Rekap Pelaporan Mingguan</p>
      <div class="overview-boxes ovb">
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Belum Ditanggapi</div>
            <div class="number">1</div>
          </div>
          <i class='bx bxs-calendar-x cart red'></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Dalam Penanganan</div>
            <div class="number">5</div>
          </div>
          <i class='bx bx-hourglass cart yellow' ></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Dalam Perencanaan</div>
            <div class="number">20</div>
          </div>
          <i class='bx bxs-hourglass-bottom cart' ></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Telah Diselesaikan</div>
            <div class="number">20</div>
          </div>
          <i class='bx bxs-calendar-check cart green' ></i>
        </div>
      </div>
      <hr style="text-align:left; margin-left:0; border-color: rgba(0, 0, 0, 0.5);">

  </section>
@endsection