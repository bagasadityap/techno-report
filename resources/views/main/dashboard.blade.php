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
            <div class="number">{{ $today }}</div>
          </div>
          <i class='bx bx-calendar-alt cart green'></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Laporan Minggu Ini</div>
            <div class="number">{{ $thisWeekSum }}</div>
          </div>
          <i class='bx bx-calendar-event cart green2' ></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Laporan Bulan Ini</div>
            <div class="number">{{ $thisMonth }}</div>
          </div>
          <i class='bx bx-calendar cart green3' ></i>
        </div>
      </div>
      <hr style="text-align:left; margin-bottom:5px; border-color: rgba(0, 0, 0, 0.5);">
      <p style="padding-left: 30px; font-size: 25px; margin-bottom: 10px">Rekap Pelaporan Mingguan</p>
      <div class="overview-boxes ovb">
        @foreach ($statuses as $stat)
          <div class="box">
              <div class="right-side">
                  <div class="box-topic">{{ $stat->name }}</div>
                  <?php 
                      $filteredStatus = $status->where('status_id', $stat->id)->first(); 
                  ?>
                  @if ($filteredStatus)
                      <div class="number">{{ $filteredStatus->c }}</div>
                  @else
                      <div class="number">0</div>
                  @endif
              </div>
              <i class='bx {{ $stat->icon }} cart {{ $stat->color }}'></i>
          </div>
      @endforeach
      </div>
      <hr style="text-align:left; margin-left:0; border-color: rgba(0, 0, 0, 0.5);">

  </section>
@endsection