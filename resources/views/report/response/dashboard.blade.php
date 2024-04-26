@extends('dashboard')

@section('title')
Tanggapan
@endsection

@section('content')
<section class="home-section">
    <nav>
        <div class="sidebar-button">
            <i class='bx bx-menu sidebarBtn'></i>
            <span class="dashboard">Tanggapan</span>
        </div>
        <div class="profile-details">
            <span class="admin_name">{{ Auth::user()->name }}</span>
            <i class='bx bx-chevron-down'></i>
        </div>
    </nav>

    <div class="home-content">
        <a href="/report/add" class="btn btn-primary text-white" style="margin: 0 0 15px 25px;">Add Tanggapan
            <i class='bx bx-user-plus text-white' style="margin-left: 3px"></i>
        </a>
        <div class="overview-bxs" style="margin-left: 10px">
            <div class="box">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Dibuat oleh</th>
                            <th>Tanggal</th>
                            <th>Deskripsi</th>
                            <th></th>
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
                                {{-- <span class="badge rounded-pill {{ $report->status == 1 ? 'bg-success' : 'bg-danger' }} text-white" style="padding: 2px 10px; font-size: 14px;">
                                    {{ $report->status == 1 ? 'Active' : 'Inactive' }}
                                </span> --}}
                            </td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-info dropdown-toggle btn-sm" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-sm" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="/report/{{ $report->id }}/response">
                                          <i class='bx bx-comment-dots' style='color: green;'></i> Tanggapi
                                        </a>
                                        <button type="button" class="btn btn-danger dropdown-item" data-toggle="modal" data-target="#adminDetail_{{ $report->id }}">
                                          <i class='bx bx-info-circle' style='color: rgb(40, 185, 204);'></i> Detail
                                        </button>
                                        <a class="dropdown-item" href="/report/update/{{ $report->id }}">
                                            <i class='bx bx-edit' style='color: yellow;'></i> Update
                                        </a>
                                        <button type="button" class="btn btn-danger dropdown-item" data-toggle="modal" data-target="#deleteConfirmation_{{ $report->id }}">
                                          <i class='bx bx-trash' style='color: red;'></i> Delete
                                        </button>
                                      </div>
                                      <!-- Modal -->
                                      <div class="modal fade" id="adminDetail_{{ $report->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="myModalLabel">Detail Pelaporan</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                              <table class="table">
                                                  <tbody>
                                                      <tr>
                                                          <th>Last Updated:</th>
                                                          <td>{{ $report->updated_at }}</td>
                                                      </tr>
                                                      <tr>
                                                          <th>Judul:</th>
                                                          <td>{{ $report->name }}</td>
                                                      </tr>
                                                      <tr>
                                                          <th>Pelapor:</th>
                                                          <td>{{ $report->user->name }}</td>
                                                      </tr>
                                                      <tr>
                                                          <th>Tanggal:</th>
                                                          <td>{{ $report->date }}</td>
                                                      </tr>
                                                      <tr>
                                                          <th>Kategori:</th>
                                                          <td>{{ $report->category->name }}</td>
                                                      </tr>
                                                      <tr>
                                                          <th>Kewenangan:</th>
                                                          <td>{{ $report->authority->name }}</td>
                                                      </tr>
                                                      <tr>
                                                          <th>Status:</th>
                                                          <td>{{ $report->status->name }}</td>
                                                      </tr>
                                                      <tr>
                                                          <th>Gambar:</th>
                                                          <td>
                                                              <a href="{{ asset('storage/' . $report->photo) }}" data-lightbox="image-gallery" data-title="{{ $report->name }}">
                                                                <img src="{{ asset('storage/' . $report->photo) }}" alt="Photo" style="height: 100px"; width="auto";>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Detail:</th>
                                                    </tbody>
                                                </table>
                                                <div class="trix-content" style="margin-left: 10px">
                                                    {!! $report->detail !!}
                                                </div>                                                
                                          </div>                                          
                                            {{-- <div class="modal-footer">
                                              <button type="button" class="btn btn-default" id="deleteNo" data-dismiss="modal">Close</button>
                                            </div> --}}
                                          </div>
                                        </div>
                                      </div>
                                      <!-- End Modal -->
                                      <!-- Modal -->
                                      <div class="modal fade" id="deleteConfirmation_{{ $report->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="myModalLabel">Delete Data</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                              <h7><strong>Are you sure you want to delete this data?</strong></h7><br>
                                              <h8>Judul : {{ $report->name }}</h8><br>
                                              <h8>Pelapor : {{ $report->user->name }}</h8><br>
                                              <h8>Tanggal : {{ $report->date }}</h8>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-default" id="deleteNo" data-dismiss="modal">No</button>
                                              <a href="/report/delete/{{ $report->id }}" class="btn btn-primary" id="deleteOk">Yes</a>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <!-- End Modal -->
                                </div>
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