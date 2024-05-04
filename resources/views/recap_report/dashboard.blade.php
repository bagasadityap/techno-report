@extends('dashboard')

@section('title')
Rekap Pelaporan
@endsection

@section('content')
<section class="home-section">
    <nav>
        <div class="sidebar-button">
            <i class='bx bx-menu sidebarBtn'></i>
            <span class="dashboard">Rekap Pelaporan</span>
        </div>
        <div class="profile-details">
            <span class="admin_name">{{ Auth::user()->name }}</span>
            <i class='bx bx-chevron-down'></i>
        </div>
    </nav>

    <div class="home-content">
        <a href="/rekap-laporan/download" class="btn btn-success text-white" style="margin: 0 0 15px 25px;">Download Rekap
            <i class='bx bxs-download text-white' style="margin-left: 3px"></i>
        </a>
        <div class="overview-bxs" style="margin-left: 10px">
            <div class="box">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Pelapor</th>
                            <th>Tanggal</th>
                            <th>Kategori</th>
                            <th>Kewenangan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reports as $index => $report)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $report->name }}</td>
                            <td>{{ $report->user->name }}</td>
                            <td>{{ $report->date }}</td>
                            <td>{{ $report->category->name }}</td>
                            <td>{{ $report->authority->name }}</td>
                            <td>
                                <span class="badge rounded-pill bg-{{ $report->status->class}} text-white" style="padding: 2px 10px; font-size: 14px;">
                                    {{ $report->status->name }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <hr style="text-align:left; margin-left:0; border-color: rgba(0, 0, 0, 0.5);">
</section>
@endsection